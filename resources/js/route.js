/**
 * rootes app
 */
import VueRouter from 'vue-router';

import login from './components/autch/LoginComponent.vue';
import registration from './components/autch/RegistrationComponent.vue';
import confirmEmail from './components/autch/EmailConfirmComponent.vue';
//import user-panel from './components/autch/UserPanelComponent.vue';
import index from './components/IndexComponent.vue';
import dashboard from './components/dashboardComponent.vue';

let routes = [
    {
        path: '/',
        component: index,
        //component:require('./components/IndexComponent.vue'),
        name: 'index',
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
    },
    {
        path: '/register/confirm/:id',
        component: confirmEmail,
        name: 'confirmEmail'
    },
    {
        path: '/dashboard',
        component: dashboard,
        //component:require('./components/autch/RegistrationComponent.vue')
        name: 'dashboard',
        meta: { middlewareAuth: true }
    }
];

const router = new VueRouter({
    routes
});

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.middlewareAuth)) {                
        if (!auth.check()) {
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            });

            return;
        }
    }

    next();
})

export default router;