<template>
  <div>
    <div class="d-flex flex-column my-3">
      <h1>Mensajes de {{usuario.nombre}}</h1>
      <router-link :to="`/listadoAmigos`">Volver</router-link>
    </div>
      <div class="bg-peces" v-if="!respuesta">
          No tenes mensajes aun con este Amigo
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

export default {
  name: "MensajesUsuarioVer",
  components: {
    MensajeCont
  },

  data: function() {
    return {
      estaCargando: true,
      mensajes: [],

      usuario:{
        nombre:null,
        id_usuario:null,
        email:null,
        password:null,
        imagen:null,
      },
      respuesta: true,
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
          if (!response){
            this.respuesta = false
          }
        });
      usuariosService
          .getByPk(id_amigo)
          .then(response => {
            this.estaCargando = false;
            this.usuario = response;
          });
  }
}
</script>

<style>
</style>
