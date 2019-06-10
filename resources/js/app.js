/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Vuetify from 'vuetify';
Vue.use(Vuetify);
import 'vuetify/dist/vuetify.min.css';

var VueCookie = require('vue-cookie');
// Tell Vue to use the plugin
Vue.use(VueCookie);


import login from './components/autch/LoginComponent.vue';
import registration from './components/autch/RegistrationComponent.vue';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes = [
    {path: '/login', component: login, name: 'login'},
    {path: '/registration', component: registration, name: 'registration'},
   ];
   //const router = new VueRouter({ routes });
 
   //const app = new Vue({ router }).$mount('#app');
   /*const app = new Vue({
    el: '#app',
});*/
const Foo = { template: '<div>foo</div>' }
const Bar = { template: '<div>bar</div>' }

// 2. Определяем несколько маршрутов
// Каждый маршрут должен указывать на компонент.
// "Компонентом" может быть как конструктор компонента, созданный
// через `Vue.extend()`, так и просто объект с опциями компонента.
// Мы поговорим о вложенных маршрутах позднее.
/*const routes = [
  { path: '/foo', component: Foo },
  { path: '/bar', component: Bar }
]*/

// 3. Создаём экземпляр маршрутизатора и передаём маршруты в опции `routes`
// Вы можете передавать и дополнительные опции, но пока не будем усложнять.
const router = new VueRouter({
  routes // сокращённая запись для `routes: routes`
})

// 4. Создаём и монтируем корневой экземпляр приложения.
// Убедитесь, что передали экземпляр маршрутизатора в опции
// `router`, чтобы позволить приложению знать о его наличии.
const app = new Vue({
  router
}).$mount('#app')

