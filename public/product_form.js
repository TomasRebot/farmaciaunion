$(document).ready(() => {
    const brandsSelect = $('#brands_select');
    const categorySelect = $('#category_select');
    const providerSelect = $('#provider_select');
    const laboratorySelect = $('#laboratory_select');
    const description  = $('#input-description');
    const drugSelect  = $('#drug_select');
    const therapeuticActionSelect  = $('#therapeutic_action_select');
    const isEditting = ($('#id').val() !== undefined)


    description.summernote({
        height:150,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen']],
        ],
    });
    let params =(isEditting) ? { product: $('#id').val() } : {};

    axios.post(productSuportDataUrl, params).then((response) => {
        const data = response.data;
        console.log(data);
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
            data: data.providers.map((provider) =>{
                const obj =  {
                    "id": provider.id,
                    "value": provider.id,
                    "text": provider.name,
                }
                return obj;
            }),
        });
        therapeuticActionSelect.select2({
            data: data.therapeutic_actions.map((therapeutic_action) =>{
                const obj =  {
                    "id": therapeutic_action.id,
                    "value": therapeutic_action.id,
                    "text": therapeutic_action.name,
                }
                return obj;
            }),
        });
        brandsSelect.select2({
            data: data.brands.map((brand) =>{
                const obj =  {
                    "id": brand.id,
                    "value": brand.id,
                    "text": brand.name,
                }
                return obj;
            }),
        });;
        laboratorySelect.select2({
            data: data.laboratories.map((laboratorie) =>{
                const obj =  {
                    "id": laboratorie.id,
                    "value": laboratorie.id,
                    "text": laboratorie.name,
                }
                return obj;
            }),
        });
        categorySelect.select2({
            data: data.categories.map((category) =>{
                const obj =  {
                    "id": category.id,
                    "value": category.id,
                    "text": category.name,
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



