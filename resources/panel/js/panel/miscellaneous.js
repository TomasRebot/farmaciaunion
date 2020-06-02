const summernoteBaseMediumConfig = {
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
}
const summernoteBaseMinimunConfig = {
    height:100,
}




$(document).ready(()=> {
    $('#bussines_description_global_config').summernote(summernoteBaseMediumConfig);
    $('#schedule_time_global_config').summernote(summernoteBaseMediumConfig);
    $('#google_analitycs_global_config').summernote(summernoteBaseMinimunConfig);
    $('.footable').footable()
});
