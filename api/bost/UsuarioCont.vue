<template>
    <table
        class="table table-striped table-bordered"
    >
        <tbody>

        <UsuariosInt
                v-for="usuario in usuarios"
                :key="usuario.id_usuario"
                :usuario="usuario"
        ></UsuariosInt>
        </tbody>
    </table>
</template>

<script>

    import UsuariosInt from './UsuarioInt';

    export default {
        name: "UsuarioCont",
        components: {
            UsuariosInt
        },
        props: ['usuarios'],
    }
</script>

<style>

</style>