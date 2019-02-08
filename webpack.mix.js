const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
	.js('resources/js/admin.js', 'public/js')
	.js('resources/js/pagseguro.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.sass('resources/sass/admin.scss', 'public/css')	
	.scripts([
	   	'public/js/app.js',
	   	'resources/js/datepicker/localize.js'
   	], 'public/js/app.js')
	.scripts([
	   	'public/js/admin.js',
	   	'resources/js/datepicker/localize.js'
   	], 'public/js/admin.js')
   	.copyDirectory('resources/sass/vendor', 'public/css')
   	.copyDirectory('resources/js/vendor', 'public/js/vendor')
   	.copyDirectory('resources/images/', 'public/images')
   	.version();
