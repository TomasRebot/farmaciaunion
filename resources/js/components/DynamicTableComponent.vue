<template>
    <div>
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :search-options="{ enabled: true, placeholder: 'Buscar', }"
            :pagination-options="pagination"
            :select-options="selectOptions"
            mode="remote"
            @on-selected-rows-change="onSelectionChanged"
            @on-page-change="onPageChange"
            @on-sort-change="onSortChange"
            @on-column-filter="onColumnFilter"
            @on-per-page-change="onPerPageChange"
            @on-search="onSearchChange"
            :totalRows="totalRecords"
            :isLoading.sync="isLoading">
            <div slot="table-actions">
                <div class="btn-group">
                    <button type="button"
                            style="min-width:300px!important;"
                            class="btn btn-primary btn-block dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                        Acciones
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg-right">
                        <button type="button"
                                v-if="apiResource.createUrl !== null"
                                class="btn btn-secondary accion"
                                style="min-width:300px!important"
                                @click='onCreate'

                        >Nuevo
                        </button>
                        <button type="button"
                                v-if="apiResource.deleteUrl !== null"
                                class="btn btn-secondary accion"
                                style="min-width:300px!important"
                                @click='onDelete'
                        >{{apiResource.deleteLabel}}
                        </button>
                        <button type="button"
                                v-if="apiResource.restoreUrl !== null && apiResource.restoreUrl !== undefined"
                                class="btn btn-secondary accion"
                                style="min-width:300px!important"
                                @click='onRestore'
                        >{{apiResource.restoreLabel}}
                        </button>
                        <button type="button"
                                v-if="apiResource.editUrl !== null && apiResource.editUrl !== undefined"
                                class="btn btn-secondary accion"
                                style="min-width:300px!important"
                                @click='onEdit'
                        >Editar
                        </button>
                        <button type="button"
                                v-if="apiResource.externalUrl !== null && apiResource.externalUrl !== undefined"
                                class="btn btn-secondary accion"
                                style="min-width:300px!important"
                                @click='onExternalUrlClicked'
                        >{{apiResource.externalLabel}}
                        </button>
                    </div>
                </div>
            </div>

            <div slot="emptystate" class="vgt-center-align vgt-text-disabled">
                {{apiResource.emptyTableLabel}}
            </div>
            <div slot="table-row" slot-scope="props">
                    <span v-if="props.column.field == 'state'">
                        <span v-if="props.row.state === '0'" class="bg-danger p-xs b-r-sm">Inactivo</span>
                        <span v-if="props.row.state === '1'" class="bg-primary p-xs b-r-sm">Activo</span>
                    </span>
                    <span v-else-if="props.column.field == 'icon'">
                        <i v-bind:class="props.formattedRow[props.column.field]" aria-hidden="true"></i>
                    </span>
                    <span v-else>
                      {{props.formattedRow[props.column.field]}}
                    </span>

            </div>
        </vue-good-table>
        <delete-modal-component
            :showModal="showModal"
            :isDeleting="isDeleting"
            :isRestoring="isRestoring"
            :modalQuestion="modalQuestion"
            @on-delete-confirmation="onDeleteConfirmation"
            @on-restore-confirmation="onRestoreConfirmation"
            @on-modal-close="onModalClose">
        </delete-modal-component>
    </div>
</template>

<script>
    import DeleteModalComponent from "./DeleteModalComponent";

    export default {
        name:'dynamic-table',
        props:{
            apiResource:Object,
        },
        components: {
            'delete-modal-component': DeleteModalComponent
        },
        mounted(){
            this.getResource()
        },
        data(){
            return {
                showModal: false,
                modalQuestion:'',
                isDeleting:'',
                isRestoring:'',
                totalRecords: "",
                currentPage:'',
                selectedItems:[],
                serverParams: {
                    resolver:this.apiResource.resolver,
                    columnFilters: {},
                    sort: { field: '', type: ''},
                    first_page_url: "",
                    from: "",
                    last_page:"",
                    last_page_url: "",
                    next_page_url: "",
                    path: "",
                    per_page: this.apiResource.perPage,
                    prev_page_url: null,
                    to: "",
                    total: "",
                },
                isLoading: false,
                columns: [],
                rows: [],
                pagination:{
                    enabled: true,
                    perPage: 10,
                    position: 'bottom',
                    perPageDropdown: [10, 100, 200],
                    nextLabel: 'Siguiente',
                    prevLabel: 'Anterior',
                    rowsPerPageLabel: this.apiResource.perPageLabel,
                    ofLabel: 'de',
                    pageLabel: 'pagina',
                    allLabel: 'Todos',
                },
                selectOptions:{
                    enabled: true,
                    selectionText: 'filas seleccionadas',
                    clearSelectionText: 'limpiar',
                    disableSelectInfo: false, // disable the select info panel on top
                },
            };
        },
        methods : {
            onCreate(){
                window.location.href = this.apiResource.createUrl;
            },
            onDelete(){
                if(this.selectedItems.length > 0){
                    this.modalQuestion = this.apiResource.deleteModalQuestion
                    this.isDeleting = true;
                    this.showModal = true;
                    this.isRestoring = false;
                }else{
                    toastr.error('Debe seleccionar al menos un registro');
                }
            },
            onRestore(){
                if(this.selectedItems.length > 0){
                    this.modalQuestion = this.apiResource.restoreModalQuestion
                    this.isRestoring = true;
                    this.isDeleting = false;

                    this.showModal = true;
                }else{
                    toastr.error('Debe seleccionar al menos un registro');
                }
            },
            onExternalUrlClicked(){
                if(this.selectedItems.length === 1){
                    const row = this.rows.find(row => row.id === this.selectedItems[0]);
                    window.location.href = this.apiResource.externalUrl.replace(this.apiResource.resource, row.id);
                }else{
                    toastr.error('Debe seleccionar un solo registro');
                }
            },
            onDeleteConfirmation(params){
                this.showModal = false;
                const apiParams = {model : this.apiResource.resource, ids : this.selectedItems};
                const url = this.apiResource.deleteUrl;

                axios.post(url, apiParams).then((response) => {
                    if( !response.data.error){
                        toastr.success('se han eliminado los registros seleccionados');
                        this.rows = this.rows.filter( row => !this.selectedItems.includes(row.id) );
                        this.getResource();
                    }else{
                        toastr.error('En este momento no es posible eliminado estos registros')
                    }
                });
            },
            onRestoreConfirmation(params){
                this.showModal = false;
                const apiParams = {model : this.apiResource.resource, ids : this.selectedItems, restore:true};
                const url = this.apiResource.restoreUrl;
                axios.post(url, apiParams).then((response) => {
                    if( !response.data.error){
                        toastr.success('se han restaurado los registros seleccionados');
                        this.rows = this.rows.filter( row => !this.selectedItems.includes(row.id) );
                        this.getResource();
                    }else{
                        toastr.error('En este momento no es posible restaurar estos registros')
                    }
                });
            },
            onModalClose(){
              this.showModal = false;
            },
            onSelectionChanged(params){
                this.selectedItems = params.selectedRows.map(item => item.id);
            },
            onEdit(params){
                (this.selectedItems.length !== 1)
                ? toastr.error('Debe seleccionar un solo elemento para editar')
                : window.location.href = this.apiResource.editUrl.replace(this.apiResource.resource, this.selectedItems[0]);
            },
            onPageChange(params){
                //per_page is sent for backend paginator
                this.updateParams({per_page: params.currentPerPage , currentPage: params.currentPage});
                this.getResource(this.serverParams.path+'?page='+params.currentPage)
            },
            onSortChange(params){
                this.updateParams({ sort: { field: params[0].field, type: params[0].type }});
                this.getResource();
            },
            onSearchChange(params){
                if(params.searchTerm.length > 2 || params.searchTerm === ''){
                    this.updateParams({columnFilters: this.apiResource.filters, search_query:params.searchTerm});
                    this.getResource();
                };
            },
            onColumnFilter(){
                //TODO IMPLEMENTS THIS METHOD IF IS NEEDED
            },
            onPerPageChange(params){
                this.updateParams({per_page: params.currentPerPage});
                this.getResource()
            },
            updateParams(newProps) {
                this.serverParams = Object.assign({}, this.serverParams, newProps);
            },
            getResource(url = this.apiResource.url){
                axios.post(url, this.serverParams ).then((response) =>  {
                    const server = response.data;
                    this.rows = server.paginator.data;
                    this.columns = server.columns;
                    this.totalRecords = server.paginator.total;
                    this.serverParams.first_page_url = server.paginator.first_page_url;
                    this.serverParams.from = server.paginator.from;
                    this.serverParams.last_page = server.paginator.last_page;
                    this.serverParams.last_page_url = server.paginator.last_page_url;
                    this.serverParams.next_page_url = server.paginator.next_page_url;
                    this.serverParams.path = server.paginator.path;
                    this.serverParams.per_page = server.paginator.per_page;
                    this.serverParams.prev_page_url = server.paginator.prev_page_url;
                    this.serverParams.currentPage = server.paginator.current_page;
                    console.log(server);
                });
            }
        }
    };
</script>
