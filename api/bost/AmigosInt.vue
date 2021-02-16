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
      <div class="m-1 strong">{{ usuario.id_usario }}</div>

      <div class="m-1"><router-link :to="`/mensajes/${mensaje.id_mensaje}`">Mensaje Privado</router-link></div>
    </div>
  </div>
</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";

export default {
  name: "AmigosInt",
  props: ['amigo'],

  data: function () {
    return {
      store,
      usuario: {
        nombre: '',
        email: '',
        password: '',
        imagen: '',
        alt: '',
      },
    }
  },
  computed: {
    imagenPath() {
      return `${PATH_IMGS}/${this.usuario.imagen}`;
    },
    tieneImagen() {
      return this.mensaje.imagen !== null && this.mensaje.imagen !== '';
    },
  },
  methods: {
    cargarImagen: function () {

      const imagen = this.$refs.imagen.files[0];
      const reader = new FileReader();

      reader.addEventListener('load', () => {
        console.log(reader.result);
        this.mensaje.imagen = reader.result;

      });

      reader.readAsDataURL(imagen);
    },
  }
}

</script>

<style>
</style>

