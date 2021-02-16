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

   <!--     <div class="form-group">
            <label for="id_usuario">ID</label>
            <input
                    type="text"
                    id="id_usuario"
                    class="form-control"
                    v-model="usuario.id_usuario"
                    :disabled="estaCargando"
                    :aria-describedby="errores.id_usuario != null ? 'id_usuario-error' : ''"
            >
            <div
                    id="id_usuario-error"
                    class="alert alert-danger"
                    v-if="errores.id_usuario != null"
            >
                {{ errores.id_usuario[0] }}
            </div>
        </div>
-->
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

        <button class="btn btn-primary btn-block">
            <BaseLoader v-if="estaCargando"/>
            <span       v-else>Grabar</span>
        </button>

    </form>
</template>

<script>
    import BaseLoader from "./BaseLoader";
    import BaseNotificacion from "./BaseNotificacion";
    import store from "../store";
    import usuariosService from './../Services/usuarios';

    export default {
        name: "UsuariosEditarForm",
        components: {BaseNotificacion, BaseLoader},
        props: {},
        data: function () {
            return {
                store,
                estaCargando: false,
                usuarios: [],
                usuario: {
                    id_usuario: null,
                    nombre: null,
                    password: null,
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
        computed: {},
        methods: {
            grabar: function(usuario) {

                if(this.estaCargando) {
                    return null;
                }

                this.estaCargando = true;

                usuariosService
                    .edit(usuario.id_usuario, usuario)
                    .then(response => {
                        this.estaCargando = false;
                        if(response.success) {
                            this.errores = {
                                id_usuario: null,
                                nombre: null,
                                password: null,
                            };


                            this.store.setStatus({

                                titulo: "Éxito",
                                mensaje: "El usuario se editó exitosamente.",
                                tipo: "success",

                            });
                            this.$router.push('/mensajes')
                        } else {
                            if(typeof response.errores == 'object') {
                                this.errores = response.errores;
                            }
                            this.status.titulo = "Error";
                            this.status.mensaje = "Ocurrió un error al tratar de editar el usuario.";
                            this.status.tipo = "danger";
                        }
                    });
            }
        },
        mounted() {
            const id = this.$route.params.id;

            usuariosService
                .getByPk(id)
                .then(data => {
                    this.usuario = data;
                });

        }
    }
</script>

<style>

</style>
