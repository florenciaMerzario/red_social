<template>
  <div id="app">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Acuario</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Abrir/cerrar menú de navegación">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link class="nav-link" to="/">Home</router-link>
          </li>

          <li class="nav-item">
            <router-link class="nav-link" to="/mensajes">Mensajes</router-link>
          </li>

          <li class="nav-item"
            v-if="store.auth.id_usuario === null">
            <router-link class="nav-link" to="/login">Iniciar Sesión</router-link>
          </li>
          <li
                  class="nav-item"
                  v-else
          >
            <button class="btn btn-link nav-link" @click="logout">{{ store.auth.email }} (Cerrar Sesión)</button>
          </li>

          <li class="nav-item"
              v-if="store.auth.id_usuario === null">
          </li>
          <li
                  class="nav-item"
                  v-else
          >
            <button class="btn btn-link nav-link"><router-link :to="`/usuariosEditar/${store.auth.id_usuario}`">Editar Usuario</router-link></button>

          </li>

        </ul>
      </div>
    </nav>
    <div class="container pt-3">

      <BaseNotificacion
              :titulo="store.status.titulo"
              :mensaje="store.status.mensaje"
              :tipo="store.status.tipo"
              v-if="store.status.mensaje != null"
              @close="closeNotificacion"
      />

      <router-view/>
    </div>
    <footer id="footer">
      <p>Copyright &copy; 2020</p>
    </footer>
  </div>
</template>
<script>
  import BaseNotificacion from "./components/BaseNotificacion";
  import store from "./store";
import authService from "./Services/auth";

  export default {
    name: "App",
    components: {BaseNotificacion},

    data: function () {
      return {
        store
      };
    },

    mounted: function() {
      if(localStorage.getItem('user') !== null) {
        this.store.auth = JSON.parse(localStorage.getItem('user'));
        authService.logUser(this.store.auth);
      }
    },
    methods: {
      closeNotificacion() {
        //   this.store.status = {
        //             titulo: null,
        //             mensaje: null,
        //             tipo: null
        //   } ES LO MISMO QUE
        // }
        this.store.clearStatus();
      },
      logout() {
        authService
                .logout()
                .then(res => {
                  // Deslogueamos al usuario.
                  this.store.auth = {
                    id_usuario: null,
                    email: null,
                    nombre: null,
                  };
                  // Lo borro de localStorage.
                  localStorage.removeItem('user');
                });
      }
    }
  }

</script>
<style lang="scss">

</style>
