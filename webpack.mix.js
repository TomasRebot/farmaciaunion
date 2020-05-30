const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 |   mix.js('resources/js/app.js', 'public/js')
 |      .sass('resources/sass/app.scss', 'public/css');
 */

mix.styles([
    'resources/panel/css/bootstrap.min.css',
    'resources/panel/css/plugins/datatables/dataTables.css',
    'resources/panel/css/animate.css',
    'resources/panel/css/table-css/footable.core.css',
    'resources/panel/css/style.css',
    'resources/panel/css/plugins/toastr/toastr.min.css',
    'resources/panel/css/plugins/daterangepicker/dateranger.css',
    'resources/panel/css/plugins/select2/select2.css',
    'resources/panel/css/plugins/steps/jquery.steps.css',
    'resources/panel/css/plugins/touchspin/jquery.bootstrap-touchspin.css',
    'resources/panel/css/plugins/switchery/switchery.css',
    'resources/panel/css/plugins/timepicker/jquery.timepicker.css',
    'resources/panel/css/plugins/datepicker/datepicker3.css',
    'resources/panel/css/plugins/font-awesome/css/font-awesome.css',
    'resources/template/css/plugins/iCheck/custom.css'
], 'public/css/panel.css','./')

.scripts([
    'resources/panel/js/plugins/moment/moment.js',
    'resources/panel/js/jquery-3.1.1.min.js',
    'resources/panel/js/popper.min.js',
    'resources/panel/js/bootstrap.min.js',
    'resources/panel/js/plugins/jquery-ui/jquery-ui.min',
    'resources/panel/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/panel/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/panel/js/plugins/table-js/footable.all.min.js',
    'resources/panel/js/plugins/table-js/clipboard.min.js',
    'resources/panel/js/inspinia.js',
    'resources/panel/js/plugins/pace/pace.min.js',
    'resources/panel/js/plugins/iCheck/icheck.min.js',
    'resources/panel/js/plugins/table-js/common-table.js',
    'resources/panel/js/plugins/toastr/toastr.min.js',
    'resources/panel/js/plugins/datepicker/bootstrap-datepicker.js',
    'resources/panel/js/plugins/summernote/summernote-bs4.js',
    'resources/panel/js/plugins/chartJs/Chart.min.js',
    'resources/panel/js/plugins/daterangepicker/daterangepicker.js',
    'resources/panel/js/plugins/select2/select2.js',
    'resources/panel/js/plugins/steps/jquery.steps.js',
    'resources/panel/js/plugins/touchspin/jquery.bootstrap-touchspin.js',
    'resources/panel/js/plugins/switchery/switchery.js',
    'resources/panel/js/plugins/timepicker/jquery.timepicker.js',
    'resources/panel/js/plugins/iCheck/icheck.min.js',
    'resources/panel/js/plugins/validate/jquery.validate.min.js',
    'resources/panel/js/panel/MtzValidator.js',
], 'public/js/panel.js','./');

mix.scripts([
    'resources/panel/js/panel/bulk-delete.js'
],'public/js/tables/bulk-delete.js', './');

mix.js('resources/js/app.js', 'public/js');
