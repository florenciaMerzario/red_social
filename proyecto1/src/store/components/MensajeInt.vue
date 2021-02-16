<template>
    <div class="d-flex">
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
                    v-else class="m-1 imagenMensajes img-thumbnail">{{mensaje.nombre}}</div>
                  </div>
              </div>
          <div class="d-flex flex-column">
                    <div class="m-1 strong bg-light">Usuario: {{ mensaje.nombre }}</div>
                    <div class="m-1">{{ mensaje.fecha }}</div>
                    <div class="m-1">{{ mensaje.mensaje }}</div>
                    <div class="m-1">
                      <router-link
                          v-if="store.auth.id_usuario !== null"
                        :to="`/mensajes/${mensaje.id_mensaje}`">Ver Detalle</router-link></div>
          </div>
      </div>
</template>

<script>
    import store from "../store";
    import {PATH_IMGS} from "@/constants";

    export default {
      name: "MensajeInt",
      props: ['mensaje'],

      data: function () {
        return {
          usuario:{
            nombre:'',
            email:'',
            password:'',
            imagen:'',
            alt:'',
          },
          store
        }
      },
      computed: {
        imagenPath() {
            return `${PATH_IMGS}/${this.mensaje.imagen}`;
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

