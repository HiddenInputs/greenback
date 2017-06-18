window.Vue = require('vue');
window.Chart = require('chart.js');

Vue.component('home', require('./components/Home.vue'));
Vue.component('landing', require('./components/Landing.vue'));
Vue.component('login', require('./components/Login.vue'));
Vue.component('register', require('./components/Register.vue'));
Vue.component('payment', require('./components/Payment.vue'));
Vue.component('statistics', require('./components/Statistics.vue'));
Vue.component('transactions', require('./components/Transactions.vue'));

const app = new Vue({
    el: '#app',
});
