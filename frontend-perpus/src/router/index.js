import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import DetailFilm from '../views/DetailFilm.vue'
import Dashboard from '../views/admin/Dashboard.vue'
import LoginView from '../views/LoginView.vue'
const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView
    },
    {
        path: '/film/:id',
        name: 'detail-film',
        component: DetailFilm
    },
    {
        path: '/login',
        name: 'login',
        component: LoginView
    },
    {
        path: '/admin/Dashboard',
        name: 'admin-dashboard',
        component: Dashboard
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router