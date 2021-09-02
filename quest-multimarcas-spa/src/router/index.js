import Vue from 'vue'
import Router from 'vue-router'
import Login from '@/templates/Login'
import BuscarCarros from '@/templates/BuscarCarros'
import BuscarAnuncios from '@/templates/BuscarAnuncios'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/buscarCarros',
      name: 'BuscarCarros',
      component: BuscarCarros
    },
    {
      path: '/buscarAnuncios',
      name: 'BuscarAnuncios',
      component: BuscarAnuncios
    }
  ]
})
