<template>
    <table
            class="table table-striped table-bordered"
    >
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Password</th>
            <th>Acciones</th>
        </tr>
        </thead>
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
        name: "UsuariosLista",
        components: {
            UsuariosInt
        },
        props: ['usuarios'],
    }
</script>

<style>

</style>