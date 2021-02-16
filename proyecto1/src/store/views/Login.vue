
<template>
    <div>
        <div class="d-flex flex-column">
            <h1 class="d-none">Iniciar Sesión: </h1>
        </div>

      <p class="strong">Iniciar Sesión</p>
      <div class="d-flex">
        <LoginForm/>

      <div>
        <img class="mx-5" alt="imagen de usuario sentado frente a la pc para loguearse en el sitio" src="../../../api/css/img/loginPsd.png">
     </div>
    </div>
    </div>
</template>

<script>

    import LoginForm from "../components/LoginForm";
        export default {
        name: "Login",
        components: {LoginForm},
            props: {},
            data:() =>({
                credenciales:{
                    password:'',
                    email:'',
                },
                status: {
                    titulo: null,
                    mensaje: null,
                    tipo: 'info'
                }
            }),
            computed:{},
            methods:{}
        }
</script>

<style>

</style>