import { createRouter, createWebHistory } from "vue-router";

import LayoutDefault from '@/Layouts/AppLayoutDefault.vue'
import LayoutLogin from '@/Layouts/AppLoginLayout.vue'

import Login from '../Pages/Auth/Login.vue'
import Principal from '../Pages/Principal.vue'
import Sistema from '../Pages/Sistema/Inicio.vue'
import Panderos from '@/Pages/Panderos/Inicio.vue'

const routes = [
    {
        path: '/',name: 'Login', component: Login,
        meta: { layout: LayoutLogin}
    },
    {
        path: '/principal', name:'Principal', component: Principal ,
        meta:{ layout: LayoutDefault, icono:'fas fa-tachometer-alt fa-fw'}
    },
    {
        path: '/sistema', name:'Sistema', component: Sistema ,
        meta:{ layout: LayoutDefault, icono: 'fab fa-windows fa-fw'}
    },

    {
        path: '/panderos', name:'Panderos', component: Panderos ,
        meta:{ layout: LayoutDefault, icono: 'fas fa-money-bills fa-fw'}
    },

    // {
    //     path: '/configuracion', name:'Configuracion', component: Configuracion,
    //     meta:{ layout: LayoutDefault, icono: 'fas fa-gears fa-fw'}
    // },
    // {
    //     path: '/profile', name:'Profile', component: Profile ,
    //     meta:{ layout: 'AppLayoutDefault'}
    // },
    // {
    //     path: '/organizacion', name:'Organizacion', component: Organizacion ,
    //     meta:{ layout: 'AppLayoutDefault'}
    // }
]

export default createRouter({
    history: createWebHistory(),
    routes
})
