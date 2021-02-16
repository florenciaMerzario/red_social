<template>
    <tr>
        <td>{{ usuario.id_usuario }}</td>
        <td>{{ usuario.nombre }}</td>
        <td>{{ usuario.email }}</td>
        <td>{{ usuario.password }}</td>

        <td>
            <router-link :to="`/usuarios/${usuario.id_usuario}`">Ver</router-link>
            <router-link :to="`/usuarios/${usuario.id_usuario}/editar`">Editar</router-link>

        </td>


    </tr>
</template>

<script>
    import store from "../store";
    import usuariosService from "../Services/usuarios";

    export default {
        name: "UsuariosListaItem",
        props: ['usuario'],
        data: function () {
            return {
                store
            }
        },
        methods: {

        }
    }

</script>

<style>

</style>

