<template>
  <div class="d-flex border-bottom border-top">
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
        <div v-else class="m-1">{{ usuario.nombre}}</div>
      </div>
    </div>
    <div class="d-flex flex-column padding-top-1">
      <!--   <div class="m-1 strong">{{ usuario.fecha }}</div>-->
      <!--  <div class="m-1">{{ usuario.usuario }}</div>  -->

      <div
          v-if="!bandera"
          class="img-msg"
      >
      </div>
        <div
            v-if="validar()">
          <button type="button" class="btn btn-primary" >Sos Vos</button>
        </div>
        <div
            v-else-if="esAmigo">
            <span v-if="store.auth.id !== null">
                            <template v-if="!confirmandoEliminar">
                                <button
                                    class="btn btn-danger"
                                    type="button"
                                    @click="eliminarConfirmar"
                                >Eliminar</button>
                            </template>
                            <template v-else>
                                <button
                                    class="btn btn-danger"
                                    type="button"
                                    @click="eliminar"
                                >Confirmar</button>
                                <button
                                    class="btn btn-secondary"
                                    type="button"
                                    @click="eliminarCancelar"
                                >Cancelar</button>
                            </template>
                        </span>
     </div>
     <div v-else> <!-- no es amigo -->
            <button type="button"
                    class="btn btn-primary"
                    @click="grabar"
                    >Agregar Amigo</button>
     </div>
          </div>
      </div>
</template>

<script>
import store from "../store";
import {PATH_IMGS} from "@/constants";
import usuariosService from "@/Services/usuarios";
import authService from "@/Services/auth";
import amigosService from "@/Services/amigos";

export default {
  name: "UsuarioInt",
  props: ['usuario'],

  data: function () {
    return {
      store,
      bandera: false,
      confirmandoEliminar: false,
      esAmigo: false,
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

    validar: function () {
      authService
      const usuarioUser1 = localStorage.getItem('user');
      const usuarioUser2 = JSON.parse(usuarioUser1)
      const id_usuario = usuarioUser2.id_usuario
      const id_amigo = this.usuario.id_usuario

        if (id_amigo == id_usuario) {
          return true
      }
    },
    grabar: function () { //en este caso refiere al amigo que es un usuario tb
      authService
      const usuarioUser1 = localStorage.getItem('user');
      const usuarioUser2 = JSON.parse(usuarioUser1)
      const id_usuario = usuarioUser2.id_usuario
      const id_amigo = this.usuario.id_usuario
      if (id_usuario !== id_amigo) {
        amigosService
              .getByUserFriend(id_usuario, id_amigo)
            .then(res => {
              if (res.success) {
                this.status = {
                  titulo: 'malas noticias !!!!!',
                  mensaje: 'La operación no puede llevarse a cabo ya tenés este amigo!!',
                  tipo: 'danger',
                }
                this.store.setStatus({
                  titulo: "Malas noticias",
                  mensaje: 'La operación no puede llevarse a cabo ya tenés este amigo!!',
                  tipo: "danger",
                });

              } else {
                amigosService
                    .create(id_usuario, id_amigo)
                    .then(res => {
                      this.estaCargando = false;
                      this.status = {
                        titulo: 'Felicitaciones!!',
                        mensaje: 'Ya Tenés un nuevo Amigo !!',
                        tipo: 'success',
                      }
                      this.store.setStatus({
                        titulo: "Éxito",
                        mensaje: "Ya tenés un nuevo Amigo!.",
                        tipo: "success",
                      });
                      this.esAmigo = true
                      console.log('es amigo')
                      console.log(this.esAmigo)
                    })
                this.bandera = true

              }
            })
      }
    },

    eliminar: function () { //en este caso refiero al amigo que es un usuario tb
      authService
      const usuarioUser1 = localStorage.getItem('user');
      const usuarioUser2 = JSON.parse(usuarioUser1)
      const id_usuario = usuarioUser2.id_usuario
      const id_amigo = this.usuario.id_usuario

      amigosService
          .delete(id_usuario, id_amigo)
          .then(res => {
            this.estaCargando = false;
            if (res) {
              this.status = {
                titulo: 'Éxito!!',
                mensaje: 'Amigo Eliminado!!',
                tipo: 'success',
              }

              this.store.setStatus({
                titulo: "Éxito",
                mensaje: "Amigo Eliminado!.",
                tipo: "success",
              });
              this.bandera = false
              this.confirmandoEliminar = true
              this.esAmigo = false

            }
          })
    },

    eliminarConfirmar() {
      this.confirmandoEliminar = true;
    },

    eliminarCancelar() {
      this.confirmandoEliminar = false;
    },


  },
  mounted() {
    usuariosService
        .getAll()
        .then(data => {
          this.usuarios = data;
        });

    authService
    const usuarioUser1 = localStorage.getItem('user');
    const usuarioUser2 = JSON.parse(usuarioUser1)
    const id_usuario = usuarioUser2.id_usuario

    const id_amigo = this.usuario.id_usuario

    amigosService
        .getByUserFriend(id_usuario, id_amigo)
        .then(res => {
          if (res.success) {
            this.esAmigo = true
            console.log('ya soy amigo')
            console.log(this.esAmigo)
          } else {
            this.esAmigo = false
            console.log('soy amigo')
            console.log(this.esAmigo)
          }

        })

  }
}

</script>

<style>
</style>

