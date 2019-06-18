/**
 * rootes app
 */
import VueRouter from 'vue-router';

import login from './components/autch/LoginComponent.vue';
import registration from './components/autch/RegistrationComponent.vue';
//import user-panel from './components/autch/UserPanelComponent.vue';
import index from './components/IndexComponent.vue';

let routes = [
    {
        path: '/',
        component: index,
        //component:require('./components/IndexComponent.vue'),
        //name: 'index',
    },
    {
        path: '/login',
        component: login,
        //component:require('./components/autch/LoginComponent.vue')
        name: 'login'
    },
    {
        path: '/registration',
        component: registration,
        //component:require('./components/autch/RegistrationComponent.vue')
        name: 'registration'
    }
];

export default new VueRouter({
    routes
});