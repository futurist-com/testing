/**
 * rootes app
 */
import VueRouter from 'vue-router';

import login from './components/autch/LoginComponent.vue';
import registration from './components/autch/RegistrationComponent.vue';
import confirmEmail from './components/autch/EmailConfirmComponent.vue';
import forgetPass from './components/autch/ForgePasswordComponent.vue';
import resetPassword from './components/autch/ResetPasswordComponent.vue';
//import user-panel from './components/autch/UserPanelComponent.vue';
import index from './components/IndexComponent.vue';
import dashboard from './components/dashboardComponent.vue';
import addCompany from './components/dashboard/addCompanyComponent.vue';
import company from './components/dashboard/CompanyComponent.vue';
import updateCompany from './components/dashboard/updateCompanyComponent.vue';


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
        path: '/register/forget-password',
        component: resetPassword,
        name: 'forgetPassword'
    },
    {
        path: '/register/reset-password/:token',
        component:resetPassword ,
        name: 'resetPassword'
    },
    {
        path: '/dashboard',
        component: dashboard,
        //component:require('./components/autch/RegistrationComponent.vue')
        name: 'dashboard',
        meta: { middlewareAuth: true }
    },
    {
        path: '/add-company',
        component: addCompany,
        name: 'add-company',
        meta: { middlewareAuth: true }
    },
    {
        path: '/company/:id',
        component: company,
        name: 'company',
        meta: { middlewareAuth: true }
    },
    {
        path: '/update/company/:id',
        component: updateCompany,
        name: 'updateCompany',
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