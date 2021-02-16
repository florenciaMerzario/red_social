<template>
    <div>
        <div class="d-flex flex-column">
            <h1>Login de Usuario: </h1>
            <router-link to="/usuarios/nuevo" class="bg-white text-dark rounded p-3 mb-3">Si no tenés cuenta hacé Click Aquí</router-link>
        </div>
    <LoginForm/>
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