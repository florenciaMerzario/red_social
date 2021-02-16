<template>
  <form
      action="#"
      method="POST"
      @submit.prevent="grabar(mensajePrivado)"
  >
    <div class="py-3"><router-link :to="`/listadoAmigos`">Volver</router-link></div>

    <div class="form-group">
      <label for="mensajePrivado">Mensaje Privado</label>
      <textarea
          type="text"
          id="mensajePrivado"
          class="form-control"
          v-model="mensajePrivado.mensaje"
          :disabled="estaCargando"
          :aria-describedby="errores.mensaje != null ? 'nombre-error' : ''"
      ></textarea>
      <div
          id="mensaje-error"
          class="alert alert-danger"
          v-if="errores.mensaje != null"
      >
        {{ errores.mensaje[0] }}
    </div>

    <button class="btn btn-primary btn-block">
      Grabar
    </button>
    </div>
  </form>
</template>

<script>
import store from "../store";
import mensajePrivadoService from "@/Services/msgP";
import {API} from "../constants";

export default {
  name: "MensajePrivadoNuevoForm",
  components: {},
  props: {},
  data: function () {
    return {
      estaCargando: false,
      store,
      user:null,

      mensajePrivado: {
        mensaje:null,
      },

      errores : {
        mensaje_error: null,
      },

      status: {
        titulo: null,
        mensaje: null,
        tipo: 'info'
      }
    }
  },
  computed: {},
  methods: {
    grabar: function(mensajePrivado) {

      if(this.estaCargando) {
        return null;
      }
      this.estaCargando = true;
      let
          user='',
          id_usuario= '',
          user1= '';

      user =localStorage.getItem('user');
      user1= JSON.parse(user);
      id_usuario= user1.id_usuario

      const data = {
        ...mensajePrivado,
        id_amigo: this.$route.params.id,
        id_usuario: id_usuario

      }
      mensajePrivadoService
          .create(data)
          .then(response => {

            this.estaCargando = false;

            if(response.success) {
              this.mensajePrivado = {
                detalle: null,
              };
              this.errores = {
                mensaje_error: null
              };
              this.store.setStatus({

                titulo: "Éxito",
                mensaje: "El Mensaje fué Enviado Exitosamente.",
                tipo: "success",

              });

              const id = this.$route.params.id;   //envio el amigo

              this.$router.push({
                name: "MensajesPrivadosUsuarioVer",
                params:{
                  id: id,
                }
              });

            } else {
              this.errores = response.errores;
              this.status.titulo = "Error";
              this.status.mensaje = "Ocurrió un error al tratar de grabar el mensaje.";
              this.status.tipo = "danger";
            }
          });
    }
  },

}
</script>

<style>

</style>
