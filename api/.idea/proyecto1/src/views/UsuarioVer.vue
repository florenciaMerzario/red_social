<template>
    <div>
        <h1>Detalles de {{ usuario.nombre }}</h1>

        <dl>
            <dt>ID</dt>
            <dd>$ {{ usuario.id_usuario }}</dd>
            <dt>Nombre</dt>
            <dd>{{ usuario.nombre }}</dd>
            <dt>Email</dt>
            <dd>{{ usuario.email }}</dd>
            <dt>Password</dt>
            <dd>{{ usuario.password }}</dd>

        </dl>
    </div>
</template>

<script>
    import usuariosService from "../Services/usuarios";

    export default {
        name: "ProductosVer",
        components: {},
        props: {},
        data: function () {
            return {
                usuario: {
                    id_usuario: null,
                    nombre: null,
                    email: null,
                    password: null,
                }
            }
        },
        computed: {},
        methods: {},
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
