let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.styles([
    "resources/assets/css/jquery.fileupload.css",
    "resources/assets/css/jquery.fileupload-noscript.css",
    "resources/assets/css/jquery.fileupload-ui.css",
    "resources/assets/css/jquery.fileupload-ui-noscript.css",
    "resources/assets/css/bootstrap-select2/select2.css",
    "resources/assets/css/jquery-ui-demo.css",
    "resources/assets/css/jquery-ui-demo-ie8.css",
    "resources/assets/css/style.css",

], 'public/css/fileUploadPlugin.css');

mix.js([
    "resources/assets/js/cors/jquery.postmessage-transport.js",
    "resources/assets/js/cors/jquery.xdr-transport.js",
    "resources/assets/js/vendor/jquery.ui.widget.js",
    "resources/assets/js/app.js",
    "resources/assets/js/bootstrap.js",
    "resources/assets/js/jquery.fileupload.js",
    "resources/assets/js/jquery.fileupload-angular.js",
    "resources/assets/js/jquery.fileupload-audio.js",
    "resources/assets/js/jquery.fileupload-image.js",
    "resources/assets/js/jquery.fileupload-jquery-ui.js",
    "resources/assets/js/jquery.fileupload-process.js",
    "resources/assets/js/jquery.fileupload-ui.js",
    "resources/assets/js/jquery.fileupload-validate.js",
    "resources/assets/js/jquery.fileupload-video.js",
    "resources/assets/js/jquery.iframe-transport.js",
    "resources/assets/js/main.js",
], 'public/js/fileUploadPlugin.js');
