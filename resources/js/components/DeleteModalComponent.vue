<template>
    <div class="modal inmodal fade" id="vue-delete-modal" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">{{this.modalQuestion}}</h4>
                    <h5 id="resultado" v-if="isDeleting"></h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-danger" v-if="this.isDeleting"  @click="onDelete" data-action="delete">Borrar</button>
                    <button type="button" class="btn btn-primary btn-info" v-if="isRestoring"  @click="onRestore" data-action="restore">Restaurar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name:'delete-modal-component',
        props:{
            showModal: Boolean,
            isRestoring: Boolean,
            isDeleting: Boolean,
            modalQuestion:String,
        },
        mounted(){
            this.triggerHidden();
        },
        watch: {
            showModal:(val) => {
                (val) ? $('#vue-delete-modal').modal('show') : $('#vue-delete-modal').modal('hide')
            },
        },
        data(){
            return {}
        },
        methods : {
            triggerHidden(){
                const self = this
                $('#vue-delete-modal').on('hidden.bs.modal', function(){
                    self.$emit('on-modal-close')
                });
            },
            onDelete(){
                this.$emit('on-delete-confirmation', true)
            },
            onRestore(){

                this.$emit('on-restore-confirmation', true)
            }
        }
    };
</script>
