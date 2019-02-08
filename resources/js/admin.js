require('./bootstrap');
require('./helpers/cookie');
require('./helpers/string');
require('./helpers/extensions');
require('./cropper/SimpleCropper');
require('./datepicker/CustomDatePicker');
require('jquery-countdown');
require('fullcalendar/dist/locale/pt-br.js');
require('inputmask/dist/jquery.inputmask.bundle.js');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': app.csrfToken
    }
});
