<template>
  <div class="d-flex border-bottom border-top flex-column">
    <div class="d-flex flex-column justify-content-center">
        <div class="m-1 strong bg-peces text-dark padding border sombra">
          <span>Fecha:</span> {{mensajePrivado.fecha}}
        </div>
        <div class="m-1 border w-545px"> <span class="strong">Enviado por: </span>
          {{usuario.nombre}}
          <span class="m-5 p-5 bg-light mensajeFlotante">{{mensajePrivado.mensaje}}</span>
          <div
              v-if="tieneImagen"
              class="img-msg-gd w-25"
          >
            <img
                :src="imagenPath"
                :alt="usuario.nombre"
            >
          </div>

          <div
              v-else class="m-1">''</div>
        </div>

    </div>

      <div class="m-1  border"> <span class="strong">Para: </span>
{{usuarioRecibe.nombre}}

        <div
            v-if="tieneImagen1"
            class="img-msg-gd w-25"
        >
          <img
              :src="imagenPath1"
              :alt="usuarioRecibe.nombre"
          >
        </div>

        <div
            v-else class="m-1">''</div>
      </div>
           <!-- <router-link :to="`/comentarios/nuevo/${mensajePrivado.id_mensaje}`">Agregar Comentario</router-link>
--></div>
</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";
import usuariosService from "@/Services/usuarios";
import authService from "@/Services/auth";
import mensajePrivadoService from "@/Services/msgP";

export default {
  name: "MensajePrivadoUsuarioInt",
  props: ['mensajePrivado'],

  data: function () {
    return {
      store,
      usuario:{
        nombre:'',
        email:'',
        password:'',
        imagen:'',
        alt:'',
        id_usuario:'',
      },
      usuarioRecibe:{
        nombre:'',
        email:'',
        password:'',
        imagen:'',
        alt:'',
        id_usuario:'',
      }
    }
  },
  computed: {
    imagenPath() {
      return `${PATH_IMGS}/${this.usuario.imagen}`;
    },
    imagenPath1() {
      return `${PATH_IMGS}/${this.usuarioRecibe.imagen}`;
    },
    tieneImagen() {
      return this.usuario.imagen !== null && this.usuario.imagen !== '';
    },

    tieneImagen1() {
      return this.usuarioRecibe.imagen !== null && this.usuarioRecibe.imagen !== '';
    },
  },
  methods: {
  },

  mounted() {

    usuariosService
        .getByPk(this.mensajePrivado.id_usuarioEnvia)
        .then(data => {

          this.usuario = data;
        });
    usuariosService
         .getByPk(this.mensajePrivado.id_usuarioRecibe)
          .then(data => {
            this.usuarioRecibe = data;
          });
  },
}
</script>
<style>
</style>

