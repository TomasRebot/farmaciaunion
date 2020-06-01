$(document).ready(() =>{
    axios.post(therapeuticActionGetURL).then((response) => {
        console.log(response)
        $('#drug_therapeutic_action_select').select2({
            data: response.data.map((therapeuticAction) =>{
                const obj =  {
                    "id": therapeuticAction.id,
                    "value": therapeuticAction.id,
                    "text": therapeuticAction.name,
                }
                return obj;
            }),
        });
    });

    $('#add_therapeutic_action').click((e) => {
        e.preventDefault()
        $('#new_therapeutic_action_wrapper').removeClass('hidden');
        $('#hide_add_button').removeClass('hidden');
        $('#add_therapeutic_action').addClass('hidden')
        $('#new_therapeutic_action_field').focus();

    })
    $('#hide_add_button').click((e) => {
        e.preventDefault()
        $('#new_therapeutic_action_wrapper').addClass('hidden');
        $('#hide_add_button').addClass('hidden');
        $('#add_therapeutic_action').removeClass('hidden')
    })
    $('#save_therapeutic_action').click((e) => {
        e.preventDefault()
        const params = {
            name: $('#new_therapeutic_action_field').val(),
            description: $('#new_therapeutic_action_field').val(),
            method:'PUT'
        }
        axios.post(therapeuticActionStoreURL, params).then((response) => {
            if(response.data.status === 200){
                const item =  response.data.therapeutic_action;
                var newOption = new Option(item.name, item.id, true, true);
                $('#drug_therapeutic_action_select').append(newOption).trigger('change');
                toastr.success('Se ha guardado la accion terapeutica')
                $('#hide_add_button').trigger('click');
            }else{
                toastr.error('No se puede crear dicha accion terapeutica')
            }
        })
        $('#new_therapeutic_action_field').val('')
    })
})
