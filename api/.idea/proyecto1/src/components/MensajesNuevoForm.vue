<template>
    <form
            action="#"
            method="post"
            @submit.prevent="grabar(mensaje)"
    >

        <div class="form-group">
            <label for="mensaje">Mensaje</label>
            <input
                    type="text"
                    id="mensaje"
                    class="form-control"
                    v-model="mensaje.detalle_mensaje"
                    :disabled="estaCargando"
                    :aria-describedby="errores.detalle_mensaje != null ? 'detalle_mensaje-error' : null"
            >
            <div
                    id="detalle_mensaje-error"
                    class="alert alert-danger"
                    v-if="errores.detalle_mensaje != null"
            >
                {{ errores.detalle_mensaje[0] }}
            </div>

        </div>
        <button class="btn btn-primary btn-block">
            <span>Grabar</span>
        </button>
    </form>
</template>

<script>
    import store from "../store";
    import mensajesService from './../Services/mensajes';
    import usuariosService from "../Services/usuarios";

    export default {
        name: "mensajesNuevoForm",
        components: {},
        props: {},
        data: function () {
            return {
                estaCargando: false,
                store,
                user:null,
                mensaje: {
                    id_mensaje: null,
                    id_usuario: null,
                    detalle_mensaje: null,
                    fecha:null,

                },

                errores: {
                    id_mensaje: null,
                    id_usuario: null,
                    detalle_mensaje: null,
                    fecha:null
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
            grabar: function(mensaje) {

                if(this.estaCargando) {
                    return null;
                }
                this.estaCargando = true;

                let
                    user=null,
                    id_usuario= null,
                    user1= null;

                user =localStorage.getItem('user');
                user1= JSON.parse(user);
                id_usuario= user1.id_usuario

                const data = {
                    ...mensaje,
                    id_usuario: id_usuario

                }
                mensajesService
                    .create(data)
                    .then(response => {
                        this.estaCargando = false;
                        if(response.success) {
                            this.mensaje = {
                                id_mensaje: null,
                                detalle_mensaje: null,
                                id_usuario: null,

                            };
                            this.errores = {
                                id_mensaje: null,
                                detalle_mensaje: null,
                                id_usuario: null,
                                fecha: null
                            };
                            this.store.setStatus({

                                titulo: "Éxito",
                                mensaje: "El mensaje se creó exitosamente.",
                                tipo: "success",

                            });

                            const id = this.$route.params.id;

                            this.$router.push({
                                name: "Mensajes",

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
