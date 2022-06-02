/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//CONTABILIDAD
Vue.component('egreso', require('./components/Egreso.vue').default);
Vue.component('ingreso', require('./components/Ingreso.vue').default);
Vue.component('emisionderecibo', require('./components/Emisionderecibo.vue').default);
Vue.component('formapago', require('./components/Formapago.vue').default);
Vue.component('tipocliente', require('./components/Tipocliente.vue').default);

//MANTEMIENTO
Vue.component('tipoutensilio', require('./components/Tipoutensilio.vue').default);
Vue.component('utensilio', require('./components/Utensilio.vue').default);

//TOUR
Vue.component('empresa', require('./components/Empresa.vue').default);
Vue.component('tour', require('./components/Tour.vue').default);

//HABITACION
Vue.component('tipohabitacion', require('./components/Tipohabitacion.vue').default);
Vue.component('habitacion', require('./components/Habitacion.vue').default);

//DISPENSA
Vue.component('categoriadispensa', require('./components/Categoriadispensa.vue').default);
Vue.component('dispensa', require('./components/Dispensa.vue').default);

//CLIENTE
Vue.component('cliente', require('./components/Cliente.vue').default);

//RESERVACIÓN
Vue.component('reservacion', require('./components/Reservacion.vue').default);

//HOSPEDAJE
Vue.component('hospedaje', require('./components/Hospedaje.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data:{
        menu: 0
    }
});
