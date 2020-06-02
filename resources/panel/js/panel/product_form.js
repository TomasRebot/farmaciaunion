$(document).ready(() => {
    const brandsSelect = $('#brands_select');
    const categorySelect = $('#category_select');
    const providerSelect = $('#provider_select');
    const laboratorySelect = $('#laboratory_select');
    const description  = $('#input-description');
    const drugSelect  = $('#drug_select');
    const therapeuticActionSelect  = $('#therapeutic_action_select');
    const isEditting = ($('#id').val() !== undefined)

    const ajaxLoader = $('#product_ajax_select_loading');
    const productSelects = $('#product_ajax_select_container');
    description.summernote(summernoteBaseMediumConfig);
    let params =(isEditting) ? { product: $('#id').val() } : {};





    drugSelect.select2();
    providerSelect.select2();
    therapeuticActionSelect.select2();
    brandsSelect.select2();
    laboratorySelect.select2();
    categorySelect.select2();
    axios.post(productSuportDataUrl, params).then((response) => {
        const data = response.data;
        productSelects.removeClass('opacity-0');
        ajaxLoader.addClass('hidden');


        drugSelect.trigger({
            type: 'select2:select',
            params: {
                data: data.drugs.map((drug) =>{
                    const obj =  {
                        "id": drug.id,
                        "value": drug.id,
                        "text": drug.name,
                    }
                    return obj;
                })
            }
        });
        drugSelect.select2({
            data: data.drugs.map((drug) =>{
                const obj =  {
                    "id": drug.id,
                    "value": drug.id,
                    "text": drug.name,
                }
                return obj;
            }),
        });
        providerSelect.select2({
            data: data.providers.map((item) =>{
                const obj =  {
                    "id": item.id,
                    "value": item.id,
                    "text": item.name,
                }
                return obj;
            }),
        });
        therapeuticActionSelect.select2({
            data: data.therapeutic_actions.map((item) =>{
                const obj =  {
                    "id": item.id,
                    "value": item.id,
                    "text": item.name,
                }
                return obj;
            }),
        });
        brandsSelect.select2({
            data: data.brands.map((item) =>{
                const obj =  {
                    "id": item.id,
                    "value": item.id,
                    "text": item.name,
                }
                return obj;
            }),
        });
        laboratorySelect.select2({
            data: data.laboratories.map((item) =>{
                const obj =  {
                    "id": item.id,
                    "value": item.id,
                    "text": item.name,
                }
                return obj;
            }),
        });
        categorySelect.select2({
            data: data.categories.map((item) =>{
                const obj =  {
                    "id": item.id,
                    "value": item.id,
                    "text": item.name,
                }
                return obj;
            }),
        });
        if(data.product !== []){
            brandsSelect.val(data.product.brand);
            brandsSelect.trigger('change');
            categorySelect.val(data.product.category);
            categorySelect.trigger('change');
            providerSelect.val(data.product.provider);
            providerSelect.trigger('change');
            laboratorySelect.val(data.product.laboratory);
            laboratorySelect.trigger('change');
            drugSelect.val(data.product.drug);
            drugSelect.trigger('change');
            therapeuticActionSelect.val(data.product.therapeutic_action);
            therapeuticActionSelect.trigger('change');
        }

    });

})



