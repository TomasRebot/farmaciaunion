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
    'resources/panel/css/animate.css',
    'resources/panel/css/style.css',
    'resources/panel/css/plugins/toastr/toastr.min.css',
    'resources/panel/css/plugins/select2/select2.css',
    'resources/panel/css/plugins/switchery/switchery.css',
    'resources/panel/css/plugins/summernote/summernote-bs4.css',
    'resources/panel/css/plugins/font-awesome/css/font-awesome.css',
    'resources/panel/css/plugins/datatables/dataTables.css',
    'resources/panel/css/animate.css',
    'resources/panel/css/table-css/footable.core.css',
], 'public/css/panel.css','./')

.scripts([
    'resources/panel/js/plugins/moment/moment.js',
    'resources/panel/js/jquery-3.1.1.min.js',
    'resources/panel/js/popper.min.js',
    'resources/panel/js/bootstrap.min.js',
    'resources/panel/js/plugins/jquery-ui/jquery-ui.min',
    'resources/panel/js/plugins/metisMenu/jquery.metisMenu.js',
    'resources/panel/js/plugins/slimscroll/jquery.slimscroll.min.js',
    'resources/panel/js/plugins/table-js/clipboard.min.js',
    'resources/panel/js/inspinia.js',
    'resources/panel/js/plugins/pace/pace.min.js',
    'resources/panel/js/plugins/toastr/toastr.min.js',
    'resources/panel/js/plugins/summernote/summernote-bs4.js',
    'resources/panel/js/plugins/select2/select2.js',
    'resources/panel/js/plugins/switchery/switchery.js',
    'resources/panel/js/plugins/validate/jquery.validate.min.js',
    'resources/panel/js/plugins/table-js/clipboard.min.js',
    'resources/panel/js/plugins/table-js/footable.all.min.js',
    'resources/panel/js/panel/miscellaneous.js',
    'resources/panel/js/panel/MtzValidator.js',

], 'public/js/panel.js','./');


mix.js('resources/js/app.js', 'public/js');

mix.js('resources/panel/js/panel/product_form.js', 'public/js/pages/products.js');
mix.js('resources/panel/js/panel/drug_therapeutic_action.js', 'public/js/pages/drug_therapeutic_actions.js');
