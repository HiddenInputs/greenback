window.Vue = require('vue');
window.Chart = require('chart.js');
window.notie = require('notie');
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
// Vue.component('home', require('./components/Home.vue'));
// Vue.component('landing', require('./components/Landing.vue'));
// Vue.component('login', require('./components/Login.vue'));
// Vue.component('register', require('./components/Register.vue'));
// Vue.component('payment', require('./components/Payment.vue'));
// Vue.component('statistics', require('./components/Statistics.vue'));
// Vue.component('transactions', require('./components/Transactions.vue'));

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="_csrf_token"]').getAttribute('value');

(function makeMenuActive() {
    const location = window.location.pathname.replace(/\//g, '');
    $('[data-nav]').removeClass('active');
    $(`[data-nav="${location}"]`).addClass('active');
})();

$(document).ready(function() {
    $('#fos_user_registration_form_country').dropdown();
    $('#fos_user_registration_form_currency').dropdown();
    $('.edit-category').modal();
});

window.notieInput = function notieInput(text, value, confirm, cancel) {
    notie.input({
        text: text,
        submitText: 'Submit',
        cancelText: 'Cancel',
        cancelCallback: cancel,
        submitCallback: confirm,
        value: value,
        type: 'text',
        placeholder: ''
    })
};

window.editCategory = function editCategory(id, name) {
    notieInput('Edit category name', name, function (input) {
        var params = new URLSearchParams();
        params.append('category[name]', input);
        params.append('category[_token]', document.querySelector('#category__token').value);
        axios.post('/category/' + id + '/edit', params).then(response => {
            document.querySelector(`[data-type="category-name"][data-id="${id}"]`).innerText = response.data.name;
        });
    }, function () {});
};