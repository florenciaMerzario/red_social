import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Usuarios from '../views/Usuarios.vue'
import UsuariosNuevo from '../components/UsuariosNuevo.vue'
import ComentariosNuevoForm from "../components/ComentariosNuevoForm";
import MensajesNuevo from "../components/MensajesNuevo";
import LoginForm from "../components/LoginForm";

import MensajesNuevoForm from "../components/MensajesNuevoForm";
import UsuariosEditar from "../views/UsuariosEditar";
import Mensajes from '../views/Mensajes';
import MensajesVer from "../views/MensajesVer";
import Login from "../views/Login";
import authService from "../Services/auth";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },

  {
    path: '/usuarios/nuevo',
    name: 'UsuariosNuevo',
    component: UsuariosNuevo,

  },

  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },

  {
    path: '/mensajes',
    name: 'Mensajes',
    component: Mensajes
  },


  {
    path: '/mensajes/nuevo/',
    name: 'MensajesNuevo',
    component: MensajesNuevo,

    meta: {
      requiresAuth: true
     }
    },

  {
    path: '/mensajes/:id',
    name: 'MensajesVer',
    component: MensajesVer
  },

  {
    path: '/login/',
    name: 'Login',
    component: Login
  },
  {
    path: '/usuariosEditar/:id',
    name: 'UsuariosEditar',
    component: UsuariosEditar
    },
  {
    path: '/comentarios/nuevo/:id',
    name: 'ComentariosNuevoForm',
    component: ComentariosNuevoForm,

    meta: {
      requiresAuth: true
    }
  },

]

const router = new VueRouter({
  routes
});

// Agregamos la verificación de acceso entre rutas.
router.beforeEach((to, from, next) => {

  if(to.matched.some(item => item.meta.requiresAuth)) {

    if(!authService.isLogged()) {
      // Pateamos al usuario al login.
      next({
        path: '/login'
      });
    } else {
      next();
    }
  } else {
    next();
  }
});

export default router

