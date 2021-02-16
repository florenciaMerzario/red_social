<template>

  <div class="m-5">
    <div class="m-3">
      <h1 class="text-dark">Tus Mensajes Privados </h1>
      <BaseNotificacion
          :titulo="status.titulo"
          :mensaje="status.mensaje"
          :tipo="status.tipo"
          v-if="status.mensaje != null"
      />
      <router-link :to="`/listadoUsuarios`">Volver</router-link>
    </div>
    <div class="d-flex justify-content-center">
      <!--<h1 class="text-dark">Detalle de Mensajes Privados de: {{ usuario.nombre }}</h1>-->

  </div>
    <div>
      <div class="white rounded-sm p-5">
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
import amigosService from "@/Services/amigos";
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
        imagen: null,
        nombre: null

      },
      usuario: {
        nombre: null,
        id_usuario: null,
        imagen: null,
      },

      amigo: {
        nombre: null,
        imagen: null,
      },
      status: {
        titulo: null,
        mensaje: null,
        tipo: 'info'
      }
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

        this.usuario.imagen = reader.result;

      });

      reader.readAsDataURL(imagen);
    },
  },

  mounted() {
    const id = this.$route.params.id; //amigo

    usuariosService
        .getByPk(this.usuario.id_usuario)
        .then(dito => {
          this.usuario = dito;
        });

    authService
    const usuarioUser1 = localStorage.getItem('user');
    const usuarioUser2 = JSON.parse(usuarioUser1)
    const usuariosLogueado = usuarioUser2.id_usuario

    usuariosService
        .getByPk(usuariosLogueado)
        .then(data => {
          this.usuario = data;
        });

    mensajePrivadoService
        .getByUser(usuariosLogueado)
        .then(data => {
          this.mensajesPrivados = data;

      if (!this.mensajesPrivados) {
        this.status = {
          titulo: 'Aviso',
          tipo: 'danger',
          mensaje: 'La operación no puede llevarse a cabo porque no tenés mensajes privados!',
        }

        this.status = {
          titulo: 'Aviso',
          tipo: 'danger',
          mensaje: 'La operación no puede llevarse a cabo porque no tenés mensajes privados!',
        }
        this.tieneAmigos = false

      } else {
        amigosService
            .getByPk(id)
            .then(data => {
              this.amigo = data;
            });
           }
        })
    }
}

</script>

<style>

</style>
