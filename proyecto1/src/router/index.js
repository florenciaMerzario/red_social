import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import UsuariosNuevo from '../components/UsuariosNuevo.vue'
import ComentariosNuevoForm from "../components/ComentariosNuevoForm";
import MensajesNuevo from "../components/MensajesNuevo";
import UsuariosEditar from "../views/UsuariosEditar";
import MensajesLayout from "@/views/MensajesLayout";
import MensajesVer from "../views/MensajesVer";
import Mensajes from "../views/Mensajes";
import Login from "../views/Login";
import authService from "../Services/auth";
import ListadoUsuarios from "@/views/ListadoUsuarios";
import MensajesUsuarioVer from "@/views/MensajesUsuarioVer";
import ListadoAmigos from "@/views/ListadoAmigos";
import MensajePrivadoNuevoForm from "@/components/MensajePrivadoNuevoForm";
import MensajePrivadoNuevo from "@/components/MensajePrivadoNuevo";
import MensajesPrivadosUsuarioVer from "@/views/MensajesPrivadosUsuarioVer";
import MensajesPrivadosVer from "@/views/MensajesPrivadosVer";

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
    path: '/mensajes',
    name: 'MensajesLayout',
    component: MensajesLayout,
    children: [
      {
        path: '',
        name: 'Mensajes',
        component: Mensajes
      },
      {
        path: 'nuevo',
        name: 'MensajesNuevo',
        component: MensajesNuevo,
        meta: {
          requiresAuth: true
        }
      },
      {
        path: ':id',
        name: 'MensajesVer',
        component: MensajesVer
      },

    ]
  },

  {
    path: '/login/',
    name: 'Login',
    component: Login
  },
  {
    path: '/usuariosEditar/:id',
    name: 'UsuariosEditar',
    component: UsuariosEditar,
    meta: {
      requiresAuth: true
    }
    },
  {
    path: '/comentarios/nuevo/:id',
    name: 'ComentariosNuevoForm',
    component: ComentariosNuevoForm,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/listadoUsuarios',
    name: 'ListadoUsuarios',
    component: ListadoUsuarios,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/listadoAmigos',
    name: 'ListadoAmigos',
    component: ListadoAmigos,
    meta: {
      requiresAuth: true
    }
  },

  {
    path: '/mensajesUsuarioVer/:id',
    name: 'MensajesUsuarioVer',
    component: MensajesUsuarioVer,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/mensajePrivado/nuevo/:id',
    name: 'MensajePrivadoNuevo',
    component: MensajePrivadoNuevo,
    meta: {
      requiresAuth: true
    }
  },
  {
    path: '/mensajesPrivadosUsuarioVer/:id',
    name: 'MensajesPrivadosUsuarioVer',
    component: MensajesPrivadosUsuarioVer,
    meta: {
      requiresAuth: true
    }

  },

  {
    path: '/mensajesPrivadosVer/:id',
    name: 'MensajesPrivadosVer',
    component: MensajesPrivadosVer,
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
//si alguna ruta tiene meta de autenticacion

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

