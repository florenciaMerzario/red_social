<template>
    <table
            class="table table-striped table-bordered"
    >
        <thead>
        <tr>
            <th>Mensaje (ID)</th>
            <th>Detalle </th>
            <th>Fecha</th>
            <th>Acciones</th>

        </tr>
        </thead>
        <tbody>
        <MensajesInt
                v-for="mensaje in mensajes"
                :key="mensaje.id_mensaje"
                :mensaje="mensaje"
                :usuario="usuario"
        ></MensajesInt>
        </tbody>
    </table>
</template>

<script>

    import MensajesInt from './MensajeInt';

    export default {
        name: "MensajesCont",
        components: {
            MensajesInt
        },
        props: ['mensajes', 'usuario'],
    }
</script>

<style>

</style>