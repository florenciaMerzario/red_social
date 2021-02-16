<template>
  <div class="d-flex border-bottom border-top">
    <div class="d-flex flex-column jus contDivImg">
      <div class="d-flex divImagen">
        <div
            v-if="tieneImagen"
            class="img-msg"
        >
          <div class="m-1">{{amigo.nombre}}</div>

          <img
              :src="imagenPath"
              :alt="amigo.nombre"
          >
        </div>

        <div
            v-else class="m-1 imagenMensajes img-thumbnail">{{amigo.nombre}}</div>
      </div>
    </div>
  <div>

    <!--  <h3 class="m-3">Comentarios</h3>-->
    <ul class="list-group border-primary px-5 mt-3 mb-3">
      <div class="bg-light">
        <li class="list-group-item"><span>Email:  </span>{{amigo.email}}</li>
        <div class="m-1 boton lg"><router-link :to="`/mensajesUsuarioVer/${amigo.id_amigo}`">Ver Post</router-link></div>
        <div class="m-1 boton lg green"><router-link :to="`/mensajePrivado/nuevo/${amigo.id_amigo}`">Enviar Mensaje Privado</router-link></div>
        <div class="m-1 boton lg"><router-link :to="`/mensajesPrivadosUsuarioVer/${amigo.id_amigo}`">Ver Mensajes Privados</router-link></div>

      </div>
    </ul>
  </div>
  </div>
</template>

<script>
import store from "../store";
import amigosService from "@/Services/amigos";
import {PATH_IMGS} from "@/constants";

export default {
  name: "AmigosInt",
  props: ['amigo'],
  data: function () {
    return {
      store
    }
  },
  computed: {
    imagenPath() {
      return `${PATH_IMGS}/${this.amigo.imagen}`;
    },
    tieneImagen() {
      return this.amigo.imagen !== null && this.amigo.imagen !== '';
    },
  },
  methods: {
    cargarImagen: function () {

      const imagen = this.$refs.imagen.files[0];
      const reader = new FileReader();

      reader.addEventListener('load', () => {
        console.log(reader.result);
        this.amigo.imagen = reader.result;

      });

      reader.readAsDataURL(imagen);
    },
  }
}

</script>

<style>

</style>
