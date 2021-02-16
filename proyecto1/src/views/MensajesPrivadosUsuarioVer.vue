<template>
  <div class="m-5">

    <div class="d-flex justify-content-center ">
      <!--<h1 class="text-dark">Detalle de Mensajes Privados de: {{ usuario.nombre }}</h1>-->
      <h3 class="text-dark w-75 px3">Mensajes Privados Con: {{ amigo.nombre }}</h3>
      <div class="d-flex ">
        <div
            v-if="tieneImagen"
            class="img-msg-gd d-inline-block"
        >
          <img
              :src="imagenPath"
              :alt="this.amigo.nombre"
          >
        </div>
        <div
            v-else class="m-1">''</div>
      </div>

    </div>

    <BaseNotificacion
        :titulo="status.titulo"
        :mensaje="status.mensaje"
        :tipo="status.tipo"
        v-if="status.mensaje != null"
    />

    <div class="m-3">
      <router-link :to="`/listadoAmigos/`">Volver</router-link>
    </div>
    <div>

        <div v-if="!hayMensajes">

        </div>
        <div v-else>
            <MensajePrivadoUsuarioCont
                :mensajesPrivados="this.mensajesPrivados"
                :amigo="this.usuario"
                :usuario="this.amigo"
            />
        </div>
    </div>
  </div>
</template>
<script>
import mensajePrivadoService from "@/Services/msgP";
import usuariosService from "../Services/usuarios";
import MensajePrivadoUsuarioCont from "@/components/MensajePrivadoUsuarioCont";
import {PATH_IMGS} from "@/constants";
import authService from "@/Services/auth";
import BaseNotificacion from "@/components/MensajeAviso";

export default {
  name: "MensajesPrivadosUsuarioVer",
  components: {
    MensajePrivadoUsuarioCont, BaseNotificacion
  },
  props: {},
  data: function () {
    return {
      mensajesPrivados: [],
      mensajePrivado: {
        id_usuario: null,
        id_amigo: null,
        mensaje: null,

      },
      usuario:{
        nombre:null,
        id_usuario:null,
        imagen:null,
      },

      amigo:{
        nombre:null,
        imagen:null
      },
      status: {
        titulo: null,
        mensaje: null,
        tipo: 'info'
      },
      hayMensajes: true
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
  },

  mounted() {
    const id = this.$route.params.id; //amigo
    authService
    const usuarioUser1 = localStorage.getItem('user');
    const usuarioUser2 = JSON.parse(usuarioUser1)
    const usuariosLogueado = usuarioUser2.id_usuario

    usuariosService
        .getByPk(usuariosLogueado)
        .then(dito => {
          this.usuario = dito;
        });

    mensajePrivadoService
        .getByPk(usuariosLogueado, id)
        .then(data => {
          this.mensajesPrivados = data;
          console.log(this.mensajesPrivados)
        /*  if (!data){
            this.hayMensajes = false
          }
*/
          if (!this.mensajesPrivados) {
            this.hayMensajes = false
            this.status = {
              titulo: 'Aviso',
              tipo: 'danger',
              mensaje: 'La operación no puede llevarse a cabo porque no hay mensajes privados con este amigo!',
            }

            this.status = {
              titulo: 'Aviso',
              tipo: 'danger',
              mensaje: 'La operación no puede llevarse a cabo porque no hay mensajes privados con este amigo!',
            }
          }else{
            this.hayMensajes = true
          }

        });

    usuariosService
        .getByPk(id) //amigo
        .then(data => {
          this.amigo = data;
        });
  },
}

</script>

<style>

</style>
