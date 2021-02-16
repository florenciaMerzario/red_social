<template>
    <form
            action="#"
            method="post"
            @submit.prevent="login(usuario)"
    >
        <div class="form-group">
            <label for="email">Email</label>
            <input
                    type="text"
                    id="email"
                    class="form-control"
                    v-model="credenciales.email"

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
                    type="text"
                    id="password"
                    class="form-control"
                    v-model.number="credenciales.password"
                    :aria-describedby="errores.password != null ? 'password-error' : ''"
            >
            <div
                    id="password-error"
                    class="alert alert-danger"
                    v-if="errores.password != null"
            >
                {{ errores.password[0] }}
            </div>
        </div>
        <button class="btn btn-primary btn-block">
            Ingresar
        </button>
    </form>
</template>

<script>

    import store from "../store";
    import usuariosService from './../Services/usuarios';
    import authService from "../Services/auth";

    export default {
        name: "FormLogin",
        components: {},

        props: {},
        data: function () {
            return {
                store,
                credenciales: {
                    email: null,
                    password: '',
                    nombre: null,
                },
                errores: {
                    email: null,
                    password: null,
                    nombre: null,
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
            login: function(usuario) {
                usuariosService
                    .login(usuario.id_usuario, usuario)
                    .then(response => {
                        if(response.success) {
                            this.errores = {
                                nombre: null,
                                email: null,
                                password: null,
                            };
                             this.store.setStatus({
                                 titulo: "Éxito",
                                 mensaje: "Login exitoso.",
                                 tipo: "success",
                            });
                            this.$router.push('/usuarios')
                        } else {
                            if(typeof response.errores == 'object') {
                                this.errores = response.errores;
                            }
                            this.status.titulo = "Error";
                            this.status.mensaje = "Ocurrió un error al tratar ingresar.";
                            this.status.tipo = "danger";
                        }
                    });
            }
        },

    }
</script>

<style>

</style>
