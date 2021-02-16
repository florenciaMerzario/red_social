<template>

    <form
            action="#"
            method="post"
            @submit.prevent="grabar(usuario)"
    >
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
        <div class="form-group">
            <label for="email">Email</label>
            <input
                    type="text"
                    id="email"
                    class="form-control"
                    v-model.number="usuario.email"
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
               <div class="form-group">
            <label for="password">Password</label>
            <input
                    type="password"
                    id="password"
                    class="form-control"
                    v-model.number="usuario.password"
                    :disabled="estaCargando"
                    :aria-describedby="errores.password != null ? 'password-error' : ''"
            >
            <div
                    id="password-error"
                    class="alert alert-danger"
                    v-if="errores.password != null"
            >
                {{ errores.password[0] }}
            </div>

                 <div class="form-group">
                   <label for="imagen">Imagen</label>
                   <input
                       type="file"
                       id="imagen"
                       class="form-control"
                       ref="imagen"
                       @change="cargarImagen"
                   >
                   <!-- El "ref" va a estar disponible con el nodo de DOM en la propiedad especial del componente $refs . -->
                 </div>

               </div>
      <button class="btn btn-primary btn-block">
        Grabar
        </button>
    </form>

</template>

<script>

    import store from "../store";
    import usuariosService from './../Services/usuarios';
    import authService from "../Services/auth";


    export default {
        name: "UsuariosNuevoForm",
        components: {},
        props: {},
        data: function () {
            return {
                estaCargando: false,
                store,
                usuario: {
                    nombre: null,
                    email: null,
                    password: null,
                    imagen: null,

                },
              mensaje: {
                nombre: null,
                email: null,
                password: null,
              },
                errores: {
                    nombre: null,
                    email: null,
                    password: null,
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
          cargarImagen: function() {

            const imagen = this.$refs.imagen.files[0];
            const reader = new FileReader();
            reader.addEventListener('load', () => {
              this.usuario.imagen = reader.result;
            });
            reader.readAsDataURL(imagen);
            console.log(imagen)

          },

            grabar: function (usuario) {
                authService;
                usuariosService
                    .create(usuario)
                    .then(res => {
                        this.estaCargando = false;

                      if(res.success) {
                            this.status = {
                                titulo: 'Bienvenido',
                                mensaje: 'Registro Correcto!!',
                                tipo: 'success',
                            }
                            authService
                                .login(usuario)
                                .then(res => {
                                    if (res !== false) {
                                        this.status = {
                                            titulo: 'Exito',
                                            mensaje: 'iniciaste sesion ok',
                                            tipo: 'success',
                                        },

                                            this.store.auth = {
                                                id_usuario: res.id_usuario,
                                                email: res.email,
                                                nombre: res.nombre,
                                            },
                                            localStorage.setItem('user', JSON.stringify(this.store.auth));
                                    } else {
                                        this.status = {
                                            titulo: 'Error',
                                            mensaje: 'No se inició la sesión',
                                            tipo: 'danger'
                                        }
                                    }

                                    this.usuario = {
                                        nombre: null,
                                        email: null,
                                        password: null,
                                        imagen: null
                                    };
                                    this.errores = {
                                        nombre: null,
                                        email: null,
                                        password: null,
                                    };
                                    this.store.setStatus({

                                        titulo: "Éxito",
                                        mensaje: "Registro exitoso.",
                                        tipo: "success",
                                    });

                                    this.$router.push('/mensajes')


                                })
                        }else {
                        this.errores = res.errores;
                        this.status.titulo = "Error";
                        this.status.mensaje = "Ocurrió un error al tratar de grabar el mensaje.";
                        this.status.tipo = "danger";
                      }
                    })
            },

            mounted() {
                usuariosService
                    .getAll()
                    .then(data => {
                        this.usuarios = data;
                    });
            }
        }
    }
</script>

<style>

</style>
