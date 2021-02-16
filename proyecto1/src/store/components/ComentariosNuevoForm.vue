<template>


  <form
            action="#"
            method="post"
            @submit.prevent="grabar(comentario)"
    >
        <div class="form-group">
            <label for="comentario">Comentario</label>
          <textarea
              type="text"
              id="comentario"
              class="form-control"
              v-model="comentario.detalle_comentario"
              :disabled="estaCargando"
              :aria-describedby="errores.detalle_comentario != null ? 'detalle_comentario-error' : null"
          >

            </textarea>
          <div
              id="detalle_comentario-error"
              class="alert alert-danger"
              v-if="errores.detalle_comentario != null"
          >
            {{ errores.detalle_comentario[0] }}
          </div>

        </div>
        <button class="btn btn-primary btn-block">
          Grabar
        </button>

    <div class="m-1"><router-link :to="`/mensajes/${this.id_mensaje}`">Volver</router-link></div>
  </form>

</template>

<script>
    import store from "../store";
    import comentariosService from './../Services/comentarios';
    import usuariosService from "@/Services/usuarios";
    export default {
        name: "ComentariosNuevoForm",
        components: {},
        props: {},
        data: function () {
            return {
                estaCargando: false,
                store,
                user:'',
                id_mensaje:'',
                comentario: {
                    id_comentario: null,
                    detalle_comentario: null,
                    id_mensaje: null,
                    id_usuario: null,
                    fecha: null,
                    user:null,
                },
                errores: {
                    id_comentario: null,
                    detalle_comentario: null,
                    id_mensaje: null,
                    id_usuario: null,
                    fecha: null,
                    user:null
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

            grabar: function(comentario) {

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
                    ...comentario,
                    id_mensaje: this.$route.params.id,
                     id_usuario: id_usuario

            }
                comentariosService
                    .create(data)
                    .then(response => {
                        this.estaCargando = false;

                        if(response.success) {
                            this.comentario = {
                                id_comentario: null,
                                detalle_comentario: null,
                                id_usuario: null,
                                id_mensaje: null,
                                fecha: null,
                                user:null,
                            };

                            this.errores = {
                                id_comentario: null,
                                detalle_comentario: null,
                                id_usuario: null,
                                id_mensaje: null,
                                fecha: null
                            };
                            this.store.setStatus({

                                titulo: "Éxito",
                                comentario: "El comentario se creó exitosamente.",
                                tipo: "success",

                            });

                            const id = this.$route.params.id;

                            this.$router.push({
                                name: "MensajesVer",
                                params:{
                                    id: id,
                                }
                            });

                        } else if (response.errores){

                            this.errores = response.errores;
                            this.status.titulo = "Error";
                            this.status.mensaje = "Ocurrió un error al tratar de grabar el mensaje.";
                            this.status.tipo = "danger";
                          }

                      else
                       {
                            this.status = {
                              titulo: 'malas noticias !!!!!',
                              mensaje: 'La operación no puede llevarse a cabo , no podes comentar tu propio mensaje !!',
                              tipo: 'danger',
                            }

                          /*this.$router.push({
                            name: "Mensajes",
                            params:{}
                          });*/
                            this.store.setStatus({
                              titulo: "Malas noticias",
                              mensaje: 'La operación no puede llevarse a cabo , no podes comentar tu propio mensaje !!',
                              tipo: "danger",

                               });
                            }
                  })
            },
        },
      mounted: function () {
        this.id_mensaje = this.$route.params.id
      },
    }

</script>

<style>

</style>
