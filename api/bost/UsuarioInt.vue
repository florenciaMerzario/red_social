<template>
  <div class="d-flex border-bottom border-top">
    <div class="d-flex flex-column jus contDivImg">
      <div class="d-flex divImagen">
        <div
            v-if="tieneImagen"
            class="img-msg"
        >
          <div class="m-1">{{usuario.nombre}}</div>

          <img
              :src="imagenPath"
              :alt="usuario.nombre"
          >
        </div>
        <div
            v-else class="m-1 imagenMensajes img-thumbnail">{{usuario.nombre}}</div>

      </div>
    </div>
    <div class="d-flex flex-column">
      <div class="m-1 strong">{{ usuario.fecha }}</div>
      <div class="m-1">{{ usuario.usuario }}</div>
      <div class="m-1"><router-link :to="`/usuarios/${usuario.id_usuario}`">Ver Mensajes</router-link></div>
      <button @click="grabar">Agregar Amigo</button>
  <!--    <div class="m-1"><router-link :to="`/agregarAmigo/${usuario.id_usuario}`">Agregar Amigo</router-link></div>-->
<!-- el usuario en este caso refiere al amigo-->
    </div>
  </div>

</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";
import authService from "@/Services/auth";
import usuariosService from "@/Services/usuarios";
import amigosService from "@/Services/amigos";


export default {
  name: "UsuarioInt",
  props: ['usuario', 'amigo'],

  data: function () {
    return {
      store,
    }
  },
  computed: {
    imagenPath() {
      return `${PATH_IMGS}/${this.usuario.imagen}`;
    },
    tieneImagen() {
      return this.usuario.imagen !== null && this.usuario.imagen !== '';
    },
  },
  methods: {
    cargarImagen: function () {

      const imagen = this.$refs.imagen.files[0];
      const reader = new FileReader();

      reader.addEventListener('load', () => {
        console.log(reader.result);
        this.usuario.imagen = reader.result;

      });
      reader.readAsDataURL(imagen);
    },
    grabar: function () { //en este caso refiero al amigo que es un usuario tb
      authService
      const usuarioUser1 = localStorage.getItem('user');

      const usuarioUser2 = JSON.parse(usuarioUser1)
      const id_usuario = usuarioUser2.id_usuario

      const id_amigo = this.usuario.id_usuario

      usuariosService
          .getAll()
          .then(data => {
            this.usuarios = data;
          });
      amigosService
          .create(id_usuario, id_amigo)
          .then(res => {
            this.estaCargando = false;
            if(res.amigo) {
              this.status = {
                titulo: 'Felicitaciones!!',
                mensaje: 'Ya Tenés un nuevo Amigo !!',
                tipo: 'success',
              }

              this.store.setStatus({
                titulo: "Éxito",
                mensaje: "Ya tenés un nuevo Amigo!.",
                tipo: "success",
              });
              this.$router.push('/listadoUsuarios ')
            }
          });

    },

    mounted() {
      usuariosService
          .getAll()
          .then(data => {
            this.usuarios = data;
          });
    }
  }

}

</script>

<style>
</style>

