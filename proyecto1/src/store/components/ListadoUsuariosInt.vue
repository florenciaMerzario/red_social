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
      <div>
        {{usuario.mensaje}}
      </div>
    </div>
    <div class="d-flex flex-column">

    <!--  <div class="m-1"><router-link :to="`/mensajes/${mensaje.id_mensaje}`">Ver Detalle</router-link></div>-->
    </div>
  </div>
</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";

export default {
  name: "ListadoUsuariosInt",
  props: ['usuario'],

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
  },
}

</script>

<style>
</style>

