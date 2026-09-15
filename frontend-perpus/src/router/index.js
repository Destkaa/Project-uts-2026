import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue'
import DetailFilm from '../views/DetailFilm.vue'
import Dashboard from '../views/admin/Dashboard.vue'
import BukuAdminView from '../views/admin/BukuAdminView.vue'
import KategoriAdminView from '../views/admin/KategoriAdminView.vue'
import LoginView from '../views/LoginView.vue'
import RegisterView from '../views/RegisterView.vue'
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
        path: '/register',
        name: 'register',
        component: RegisterView
    },
    {
        path: '/admin/Dashboard',
        name: 'admin-dashboard',
        component: Dashboard
    },
    {
        path: '/admin/Buku',
        name: 'admin-buku',
        component: BukuAdminView
    },
    {
        path: '/admin/Kategori',
        name: 'admin-kategori',
        component: KategoriAdminView
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router