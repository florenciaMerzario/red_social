<template>

    <form class="w-50"
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
            <input
                    type="text"
                    id="email"
                    placeholder="Email"
                    class="form-control"
                    v-model="datos.email"
            >
        </div>

        <div class="form-group">
            <input
                    type="password"
                    id="password"
                    placeholder="Password"
                    class="form-control bg-dark bg-transparent"
                    v-model="datos.password"
            >
            <button class="btn btn-primary btn-block my-3">
                Login
            </button>
          <router-link to="/usuarios/nuevo">Si aún no está registrado ->Registrate</router-link>
        </div>
    </form>

</template>
<script>

    import BaseNotificacion from "./MensajeAviso";
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
                imagen:'',
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
                      console.log(res)
                      if (res !== false){
                          this.status = {
                              titulo: 'Exito',
                                  mensaje: 'Iniciaste sesion ok',
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
            },
         }
    }
</script>

<style >

</style>