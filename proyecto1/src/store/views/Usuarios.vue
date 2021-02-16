<template>
    <div>
        <h1>Login de Usuarios</h1>
        <router-link to="/usuarios/nuevo">Registrate</router-link>
        <form-login/>
    </div>
</template>

<script>
    import {API} from "./../constants";
    import usuariosService from '../Services/usuarios';
    import FormLogin from "../components/FormLogin" ;

    export default {
        name: "Login",
        components: {
            FormLogin
        },
        props: {},
        data: function () {
            return {}
        },

        computed: {

        },
        methods:{

        },


    }
</script>

<style>

</style>
