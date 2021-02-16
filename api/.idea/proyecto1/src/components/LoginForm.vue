<template>
    <form
            action="#"
            method="post"
            @submit.prevent="login(datos)"
    >
        <BaseNotificacion
                :titulo="status.titulo"
                :mensaje="status.mensaje"
                :tipo="status.tipo"
                v-if="status.mensaje != null"
        />
        <div class="form-group">
                <label for="email">Email</label>
            <input
                    type="text"
                    id="email"
                    class="form-control"
                    v-model="datos.email"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input
                    type="text"
                    id="password"
                    class="form-control"
                    v-model="datos.password"
            >

            <button class="btn btn-primary btn-block my-3">
             <span>Login</span>
            </button>
        </div>
    </form>
</template>
<script>

    import BaseNotificacion from "./BaseNotificacion";
    import store from "../store";
    import authService from "../Services/auth";
    export default {

        name: "LoginForm",
        components: {BaseNotificacion},
        props: {},
        data: () => ({
            datos: {
                email: '',
                password: '',
            },
            status: {
                titulo: null,
                mensaje: null,
                tipo: 'info'
            },
            store
        }),
        computed: {},

        methods: {
            login: function (datos) {
                    authService
                    .login(datos)
                    .then(res =>{
                      if (res !== false){
                          this.status = {
                              titulo: 'Exito',
                                  mensaje: 'iniciaste sesion ok',
                                  tipo: 'success',
                          }
                          this.store.auth = {
                              id_usuario: res.id_usuario,
                              email: res.email,
                              nombre: res.nombre,
                          }
                          localStorage.setItem('user', JSON.stringify(this.store.auth));
                          this.$router.push('/mensajes')
                      }else {
                          this.status = {
                              titulo: 'Error',
                              mensaje: 'no iniciaste sesion',
                              tipo: 'danger'
                          }
                      }

                    })
            }
        }
    }
</script>

<style >

</style>