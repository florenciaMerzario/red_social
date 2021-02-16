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
    <div class="d-flex flex-column">
      <div class="m-1 strong">{{ usuario.fecha }}</div>
      <!--  <div class="m-1">{{ usuario.usuario }}</div>  -->
      <div
          v-if="!bandera"
          class="img-msg"
      >

        <div
            v-if="validar()">
          <button type="button" class="btn btn-primary" >Sos Vos</button>

        </div>
        <div
            v-else-if="!esAmigo">
          <button type="button" class="btn btn-primary" @click="grabar" >Agregar Amigo</button>
        </div>

        <div
            v-else>
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

          <!--<button type="button" class="btn btn-danger" @click="eliminar" >Eliminar Amigo</button>
   -->     </div>

      </div>
    </div>
    <!--    <div class="m-1"><router-link :to="`/agregarAmigo/${usuario.id_usuario}`">Agregar Amigo</router-link></div>-->
    <!-- el usuario en este caso refiere al amigo-->
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
  props: ['usuarios', 'usuario'],

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
    grabar: function () { //en este caso refiero al amigo que es un usuario tb
      authService
      const usuarioUser1 = localStorage.getItem('user');
      const usuarioUser2 = JSON.parse(usuarioUser1)
      const id_usuario = usuarioUser2.id_usuario
      const id_amigo = this.usuario.id_usuario
      if (id_usuario !== id_amigo) {
        amigosService
            .getByUserFriend(id_usuario, id_amigo)
            .then(res => {

              console.log('estoy en byuser RES=')
              console.log(res.success)
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
                console.log('getfri')

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
                      this.bandera = true

                    })
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
              console.log(res)
              console.log('soy res')
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
            }
          })
    },

    eliminarConfirmar() {
      this.confirmandoEliminar = true;
    },

    eliminarCancelar() {
      this.confirmandoEliminar = false;
    }
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
          } else {
            this.esAmigo = false
          }
        })
  }
}

</script>

<style>
</style>

