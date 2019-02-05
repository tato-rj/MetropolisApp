const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
	.js('resources/js/pagseguro.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')

	.js('resources/admin/js/admin.js', 'public/js')
	.sass('resources/admin/scss/admin.scss', 'public/css')
	
	.scripts([
	   	'public/js/app.js',
	   	'resources/js/datepicker/localize.js'
   	], 'public/js/app.js')
   	.copy('resources/sass/vendor/primer.css', 'public/css/primer.css')
   	.copyDirectory('resources/images/', 'public/images')
   	.copyDirectory('resources/admin/js/vendors/', 'public/admin-page/vendors')
   	.version();
