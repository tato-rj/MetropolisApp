require('./bootstrap');
require('./helpers/cookie');
require('./datepicker/customize');
require('fullcalendar/dist/locale/pt-br.js');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': app.csrfToken
    }
});

// window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });
