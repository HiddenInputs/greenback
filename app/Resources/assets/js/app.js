window.Vue = require('vue');
window.Chart = require('chart.js');
window.$ = window.jQuery = require('jquery');
// Vue.component('home', require('./components/Home.vue'));
// Vue.component('landing', require('./components/Landing.vue'));
// Vue.component('login', require('./components/Login.vue'));
// Vue.component('register', require('./components/Register.vue'));
// Vue.component('payment', require('./components/Payment.vue'));
// Vue.component('statistics', require('./components/Statistics.vue'));
// Vue.component('transactions', require('./components/Transactions.vue'));

const app = new Vue({
    el: '#app',
});

(function makeMenuActive() {
    const location = window.location.pathname.replace(/\//g, '');
    $('[data-nav]').removeClass('active');
    $(`[data-nav="${location}"]`).addClass('active');
})();

$(document).ready(function() {
    $('#fos_user_registration_form_country').dropdown();
    $('#fos_user_registration_form_currency').dropdown();
});
