<template>
  <div class="m-5">
    <div class="d-flex justify-content-center">
      <h1 class="text-dark">Detalle de Mensajes: {{ usuario.nombre }}</h1>

      <div class="d-flex ">
        <div
            v-if="tieneImagen"
            class="img-msg-gd d-inline-block"
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

    <div>
      <div class="bg-light rounded-sm p-5">

        <MensajesUsuariosCont
            :mensajesPrivados="this.mensajesPrivados"
            :usuario="this.usuario"
        />
        <div class="m-3">
          <router-link :to="`/listadoUsuarios/`">Volver</router-link></div>

      </div>

    </div>

  </div>
</template>
<script>
import mensajesUsuario from "../Services/mensajesUsuario";
import comentariosService from "../Services/comentarios";
import ComentarioCont from "../components/ComentarioCont";
import usuariosService from "../Services/usuarios";
import MensajesUsuariosCont from "@/components/MensajesUsuarioCont";
import mensajePrivadoService from "@/Services/msgP";
import {PATH_IMGS} from "@/constants";

export default {
  name: "Comentarios",
  components: {
    MensajesUsuariosCont
  },
  props: {},
  data: function () {
    return {
      mensajesPrivados: [],
      mensajePrivado: {
        detalle_mensaje: '',
        id_usuario: '',
        id_mensaje:'',
      },
      comentario:{
        id_usuario: '',
        detalle_comentario: '',
        id_mensaje: '',
        fecha: '',
        id_comentario: '',

      },
      usuario:{
        nombre:null,
        id_usuario:null,
        imagen:null,
      },

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

  mounted() {
    const id = this.$route.params.id;

    usuariosService
        .getByPk(id)
        .then(dito => {
          this.usuario = dito;
        });

    mensajePrivadoService
        .getByPk(id)
        .then(data => {
          this.mensajesPrivados = data;

          /* comentariosService
               .getByPk(170)
               .then(data => {
                 this.comentario = data;
               });*/
        });
  },
}



</script>

<style>

</style>
