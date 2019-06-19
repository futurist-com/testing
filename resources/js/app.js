/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);
//
window.Event = new Vue;
//include vuetify
import Vuetify from 'vuetify';
Vue.use(Vuetify);
import 'vuetify/dist/vuetify.min.css';
//include vue-coockie 
//@todo disable return
var VueCookie = require('vue-cookie');
Vue.use(VueCookie);
//get autch
import Api from './api.js';
window.api= new Api();
import Auth from './auth.js';
window.auth= new Auth();
//get route faile
import router from './route.js';
//get component vue
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('user-panel', require('./components/autch/UserPanelComponent.vue').default);
const app = new Vue({
  router
}).$mount('#app')

