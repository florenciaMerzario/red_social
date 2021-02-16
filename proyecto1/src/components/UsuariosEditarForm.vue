<template>
    <form
            action="#"
            method="post"
            @submit.prevent="grabar(usuario)"
    >
        <BaseNotificacion
                :titulo="status.titulo"
                :mensaje="status.mensaje"
                :tipo="status.tipo"
                v-if="status.mensaje != null"
        />

     
        <div class="form-group">
          <label for="imagen">Cambiar Imagen</label>
          <input
              type="file"
              id="imagen"
              class="form-control"
              ref="imagen"
              @change="cargarImagen"
          >

      </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input
                    type="text"
                    id="nombre"
                    class="form-control"
                    v-model="usuario.nombre"
                    :disabled="estaCargando"
                    :aria-describedby="errores.nombre != null ? 'nombre-error' : ''"
            >
            <div
                    id="nombre-error"
                    class="alert alert-danger"
                    v-if="errores.nombre != null"
            >
                {{ errores.nombre[0] }}
            </div>
        </div>

      <!--  <div class="form-group">
            <label for="email">Email</label>
            <input
                    type="text"
                    id="email"
                    class="form-control"
                    v-model="usuario.email"
                    :disabled="estaCargando"
                    :aria-describedby="errores.email != null ? 'email-error' : ''"
            >
            <div
                    id="email-error"
                    class="alert alert-danger"
                    v-if="errores.email != null"
            >
                {{ errores.email[0] }}
            </div>
        </div>
        -->
        <button class="btn btn-primary btn-block my-3">
            Grabar
        </button>
    </form>
</template>

<script>
    import BaseNotificacion from "./MensajeAviso";
    import store from "../store";
    import usuariosService from './../Services/usuarios';
    import {PATH_IMGS} from "@/constants";
    import authService from "@/Services/auth";

    export default {
      name: "UsuariosEditarForm",
      components: {BaseNotificacion},
      props: {},
      data: function () {
        return {
          store,
          estaCargando: false,
          varImgPath: false,
          usuarios: [],
          imagenEditada:null,
          usuario: {
            id_usuario: null,
            nombre: null,
            password: null,
            imagen: null,
            imagen1: true,
            alt: null,
          },
          errores: {
            id_usuario: null,
            nombre: null,
            password: null,
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
       if (!this.varImgPath) {
            return `${PATH_IMGS}/${this.usuario.imagen}`
         } else {
           return `${PATH_IMGS}/${this.usuario.imagen1}`
         }
        },

        tieneImagen() {
          return this.usuario.imagen !== null && this.usuario.imagen !== '';
        },
      },
      methods: {
        grabar: function (usuario) {
          if (this.estaCargando) {
            return null;
          }
          if (this.imagenEditada){
            usuario.imagen1 = true
          }else{
            usuario.imagen1 = false;
          }
          this.estaCargando = true;
          usuariosService
              .edit(usuario.id_usuario, usuario)
              .then(response => {

                this.estaCargando = false;

                if (response.success) {
                  this.errores = {
                    id_usuario: null,
                    nombre: null,
                    password: null,
                    imagen1:null,
                    imagen:null,
                  };


                  this.store.setStatus({

                    titulo: "Éxito",
                    mensaje: "El usuario se editó exitosamente.",
                    tipo: "success",

                  });

                  this.$router.push('/mensajes')
                } else {
                  if (typeof response.errores == 'object') {
                    this.errores = response.errores;
                  }
                  this.status.titulo = "Error";
                  this.status.mensaje = "Ocurrió un error al tratar de editar el usuario.";
                  this.status.tipo = "danger";
                }
              });
        },

        cargarImagen: function () {
          this.imagenEditada = true
          const imagen = this.$refs.imagen.files[0];
          const reader = new FileReader(); //este se encarga de leer y decodificar la img

          reader.addEventListener('load', () => {
            this.usuario.imagen = reader.result;
            console.log(imagen)
          });

          reader.readAsDataURL(imagen);
        },

      },
        mounted() {
          authService
          const usuarioUser1 = localStorage.getItem('user');
          const usuarioUser2 = JSON.parse(usuarioUser1)
          const id = usuarioUser2.id_usuario
              console.log(id)
            usuariosService
                .getByPk(id)
                .then(data => {this.usuario = data;

                });
        }
    }
</script>

<style>

</style>
