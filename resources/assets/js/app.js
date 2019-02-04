/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*

 window.Vue = require('vue');*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
require('./bootstrap');
import Vue from "vue";
import router from "./router";
import App from "./App.vue";
import VueResource from "vue-resource";
import {store} from './store';
import './utils/interceptors';
import lang from './vue-translations.js';






Vue.config.productionTip = false;
Vue.use(VueResource);
Vue.filter('trans', (...args) => {
    return lang.get(...args);
});
/* eslint-disable no-new */
new Vue({
    el: '#app',
    store,
    router,
    template: '<App/>',
    components: {App}
});


Vue.component('validation-errors',require('./components/Message/Error.vue'));
Vue.component('validation-success',require('./components/Message/Success.vue'));