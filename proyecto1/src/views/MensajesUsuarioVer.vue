<template>
  <div>
    <div class="d-flex flex-column my-3">
      <h1>Mensajes de {{usuario.nombre}}</h1>
    </div>
    <BaseNotificacion
        :titulo="status.titulo"
        :mensaje="status.mensaje"
        :tipo="status.tipo"
        v-if="status.mensaje != null"
    />

    <router-link :to="`/listadoAmigos`">Volver</router-link>

    <div
         v-if="!hayMensajes">

    </div>

    <div v-else>
    <MensajeCont
        :mensajes="mensajes"
        :usuario="this.usuario"
    />
    </div>
  </div>
</template>

<script>
import {API, PATH_IMGS} from "./../constants";
import MensajeCont from "../components/MensajeCont";
import amigosMensajesService from "@/Services/amigosMensajes";
import usuariosService from "@/Services/usuarios";
import mensajesService from "@/Services/mensajes";
import BaseNotificacion from "@/components/MensajeAviso";

export default {
  name: "MensajesUsuarioVer",
  components: {
    MensajeCont, BaseNotificacion
  },

  data: function() {
    return {
      estaCargando: true,
      mensajes: [],
      hayMensajes:null,

      usuario:{
        nombre:null,
        id_usuario:null,
        email:null,
        password:null,
        imagen:null,
      },
      status: {
        titulo: null,
        mensaje: null,
        tipo: 'info'
      }
    }
  },

  computed: {},
  methods:{
    refrescarMensajes(){
      this.estaCargando = true;
      const id_amigo = this.$route.params.id; //amigo

      amigosMensajesService
          .getByPk(id_amigo)
          .then(response => {
            this.estaCargando = false;
            this.mensajes = response;

          });
      usuariosService
          .getByPk(id_amigo)
          .then(response => {
            this.estaCargando = false;
            this.usuario = response;
          });
    }
  },

  mounted: function() {
    this.estaCargando = true;
    const id_amigo = this.$route.params.id; //amigo
    amigosMensajesService
        .getByPk(id_amigo)
        .then(response => {

          this.estaCargando = false;
          this.mensajes = response;

          /*  if (!this.mensajes){
            this.hayMensajes = false

          }else{
            this.hayMensajes = true
          }
*/
          if (!this.mensajes) {
            this.hayMensajes = false
            this.status = {
              titulo: 'Aviso',
              tipo: 'danger',
              mensaje: 'La operación no puede llevarse a cabo porque no hay posteos!',
            }

            this.status = {
              titulo: 'Aviso',
              tipo: 'danger',
              mensaje: 'La operación no puede llevarse a cabo porque no hay posteos!',
            }
          }else{
            this.hayMensajes = true
          }
        })
    usuariosService
        .getByPk(id_amigo)
        .then(response => {
          this.estaCargando = false;
          this.usuario = response;
        })
  }
}
</script>

<style>
</style>


