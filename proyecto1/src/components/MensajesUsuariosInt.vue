<template>
  <div class="d-flex border-bottom border-top">

    <div class="d-flex flex-column">
      <div class="m-1 strong">{{ mensaje.fecha }}</div>
      <div class="m-1">{{ mensaje.mensaje }}</div>
      <router-link :to="`/comentarios/nuevo/${mensaje.id_mensaje}`">Agregar Comentario</router-link>
    </div>
  </div>
</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";

export default {
  name: "MensajesUsuariosInt",
  props: ['mensaje'],

  data: function () {
    return {
      store,
      usuario:{
        nombre:'',
        email:'',
        password:'',
        imagen:'',
        alt:'',
      }

    }
  },
  computed: {
    imagenPath() {
      return `${PATH_IMGS}/${this.mensaje.imagen}`;
    },
    tieneImagen() {
      return this.mensaje.imagen !== null && this.mensaje.imagen !== '';
    },
  },
  methods: {
  }
}
</script>
<style>
</style>

