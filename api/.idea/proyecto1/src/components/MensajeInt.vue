<template>
    <tr>
        <td>{{ mensaje.id_mensaje }}</td>
        <td>{{ mensaje.mensaje }}</td>
        <td>{{ mensaje.fecha }}</td>
        <td><router-link :to="`/mensajes/${mensaje.id_mensaje}`">Ver Detalle</router-link></td>
    </tr>
</template>

<script>
    import store from "../store";
    import mensajesService from "../Services/mensajes";
    import usuariosService from "../Services/usuarios";

    export default {
        name: "MensajesInt",
        props: ['mensaje', 'usuario'],

        data: function () {
            return {
                store
            }
        },
        methods: {

        },

    }
</script>

<style>
</style>

