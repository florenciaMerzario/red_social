<template>
  <div>
    <div class="d-flex flex-column my-3">
      <h1>AMIGOS</h1>

      <BaseNotificacion
          :titulo="status.titulo"
          :mensaje="status.mensaje"
          :tipo="status.tipo"
          v-if="status.mensaje != null"
      />
    </div>
    <div v-if="!tieneAmigos">
      <router-link :to="`/listadoUsuarios/`">Volver</router-link>
  </div>
    <AmigosCont
        :amigos="amigos"
        :mensajePrivado="this.mensajePrivado"
    />
  </div>
</template>

<script>
import {API, PATH_IMGS} from "./../constants";
import amigosService from "@/Services/amigos";
import AmigosCont from "@/components/AmigosCont";
import authService from "@/Services/auth";
import store from "@/store";
import BaseNotificacion from "@/components/MensajeAviso";
export default {
  name: "ListadoAmigos",
  components: {
    AmigosCont, BaseNotificacion
  },

  data: function() {
    return {
      estaCargando: true,
      amigos: [],
      tieneAmigos: null,

      amigo:{
        id_usuario:null,
        id_amigo:null,
        email:null,
        imagen:null,
        nombre:null,
      },
      mensajePrivado:{
        detalle:null,
      },
      status: {
        titulo: null,
        mensaje: null,
        tipo: 'info'
      },

      store
    }
  },

  computed: {
  },
  methods: {
  },

  mounted: function() {
    authService
    const usuarioUser1 = localStorage.getItem('user');
    const usuarioUser2 = JSON.parse(usuarioUser1)
    const id = usuarioUser2.id_usuario //usuario logueado

    amigosService
        .getByPk(id) //usuario logueado
        .then(response => {
          this.amigos = response;
          if (this.amigos == false){
            this.status = {
              titulo: 'Aviso',
              tipo: 'danger',
              mensaje: 'La operación no puede llevarse a cabo porque no tenés amigos!',
            }
            this.tieneAmigos = false
            //this.$router.push({
          //    name: "ListadoUsuarios",
          //  });
          }
        });
  }
}
</script>

<style>
</style>
