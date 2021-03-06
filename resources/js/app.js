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
//vuex
import store from './store'
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
Vue.component('main-component', require('./components/MainComponent.vue').default);
Vue.component('company-layout-component', require('./layouts/CompanyLayoutComponent.vue').default);
Vue.component('default-layout-component', require('./layouts/DefaultLayoutComponent.vue').default);
Vue.component('auth-layout-component', require('./layouts/AuthLayoutComponent.vue').default);
Vue.component('user-panel', require('./components/autch/UserPanelComponent.vue').default);
Vue.component('footer-panel', require('./components/FooterComponent.vue').default);
Vue.component('companies-component', require('./components/dashboard/CompaniesComponent.vue').default);
Vue.component('menu-company-component', require('./components/dashboard/MenuCompanyComponent.vue').default);

const app = new Vue({
  vuetify: new Vuetify(),
  router,
  store
}).$mount('#app')

