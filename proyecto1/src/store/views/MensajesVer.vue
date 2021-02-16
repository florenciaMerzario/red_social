<template>
<div class="m-5">


        <h1 class="text-dark">Detalle de Posteo Nro:{{ mensaje.id_mensaje }}</h1>
      <div class="d-flex ">
        <div
            v-if="tieneImagen"
            class="img-msg-gd d-inline-block"
        >    <h6 class="py-3">Usuario: {{usuario.nombre}}</h6>
          <img class="p-3"
              :src="imagenPath"
              :alt="usuario.nombre"
          >
        </div>

        <div
            v-else class="m-1">''</div>
      </div>

  <div
      v-if="this.usuariosLogueado !== this.mensaje.id_usuario"
      class="img-msg-gd d-inline-block"
  >
    <router-link :to="`/comentarios/nuevo/${mensaje.id_mensaje}`">Agregar Comentario</router-link>
  </div>
  <div class="my-2">
    <router-link :to="`/mensajes/`">Volver</router-link>
  </div>
      <div>
        <div class="bg-light rounded p-5">
          <h6 class="p-3">Fecha: {{mensaje.fecha}}</h6>
          <h6 class="p-3 card-text gris-celeste p-5 rounded" >Mensaje: {{mensaje.mensaje}}
          </h6>

          <ComentarioCont
              :comentarios="comentarios"
              :amigo="amigo"
          />
        </div>

      </div>
    </div>
</template>
<script>
    import mensajesService from "../Services/mensajes";
    import comentariosService from "../Services/comentarios";
    import ComentarioCont from "../components/ComentarioCont";
    import usuariosService from "../Services/usuarios";
    import {PATH_IMGS} from "@/constants";
    import authService from "@/Services/auth";

    export default {
        name: "Comentarios",
        components: {
            ComentarioCont
        },
        props: {},
        data: function () {
            return {
              usuariosLogueado:'',
              comentarios:[],
                mensaje: {
                    id_comentario: '',
                    id_mensaje: '',
                    id_usuario: '',
                    detalle_mensaje: '',
                    fecha: '',
                },
                id_usuario: '',
                comentario:{
                    id_usuario: '',
                    detalle_comentario: '',
                    id_mensaje: '',
                    fecha: '',
                    id_comentario: '',
                    nombre:'',
                    imagen:''

                },
                usuario:{
                    nombre:null,
                    id_usuario:null,
                    imagen:null,
                },
                amigo:{
                  nombre:null,
                  id_usuario:null,
                  imagen:null
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
            console.log(reader.result);
            this.usuario.imagen = reader.result;

          });

          reader.readAsDataURL(imagen);
        },
      },
        mounted() {
            const id = this.$route.params.id;

            mensajesService
                .getByPk(id)
                .then(data => {
                  this.mensaje = data;

                  comentariosService
                      .getByPk(this.mensaje.id_mensaje)
                      .then(response => {

                        this.estaCargando = false;
                        this.comentarios = response;

                        console.log(' comentario')
                        console.log(this.comentarios)

                     usuariosService
                        .getByPk(this.mensaje.id_usuario)
                        .then(data => {
                          this.usuario = data;

                        usuariosService
                            .getByPk(this.comentarios.id_usuario)
                            .then(res => {
                              this.amigo = res;

                            });
                          });
                      });
                })
                authService
                const usuarioUser1 = localStorage.getItem('user');
                const usuarioUser2 = JSON.parse(usuarioUser1)
                 this.usuariosLogueado = usuarioUser2.id_usuario
        },
    }

</script>

<style>

</style>
