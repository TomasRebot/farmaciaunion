$(document).ready(function() {
    // Init FooTable
    jQuery(function($){
        $('.table').footable({
            "empty": "No ha registros"
        });
    });
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });
    $('input[type=checkbox].todo').on('ifChanged',function() {
        if($(this).is(':checked')) {
            $('input[type=checkbox]').iCheck('check');
        } else {
            $('input[type=checkbox]').iCheck('uncheck');
        }
    });
});
