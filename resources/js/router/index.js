import { createRouter, createWebHistory } from "vue-router";

import Home from '../components/Home';
import Login from '../components/Login';
import CompanyCreate from '../components/CompanyCreate';
import CompanyEdit from '../components/CompanyEdit';
import CompanyView from '../components/CompanyView';
import EmployeeCreate from '../components/EmployeeCreate';
import EmployeeEdit from '../components/EmployeeEdit';

const routes = [
    {
        path: '/',
        name: 'home.index',
        component: Home,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        beforeEnter(to, from, next) {
            if (localStorage.getItem("btoken") !== null) {
                next('/');
            }
            next();
        }
    },
    {
        path: '/company/create',
        name: 'company.create',
        component: CompanyCreate,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/company/edit/:id',
        name: 'company.edit',
        component: CompanyEdit,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/company/view/:id',
        name: 'company.view',
        component: CompanyView,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/employee/create/:id',
        name: 'employee.create',
        component: EmployeeCreate,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/employee/edit/:id',
        name: 'employee.edit',
        component: EmployeeEdit,
        props: true,
        meta: {
            requiresAuth: true
        }
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to, from, next) => {

    if(to.meta.requiresAuth) {
        if (localStorage.getItem("btoken") === null) {
            next('/login');
        }
        next();
    }else {
        next();
    }

    
})

export default router;