<template>
    <table
            class="table"
    >
        <thead>
        </thead>

        <MensajesInt
                v-for="mensaje in mensajes"
                :key="mensaje.id_mensaje"
                :mensaje="mensaje"
        ></MensajesInt>
    </table>
</template>

<script>

    import MensajesInt from './MensajeInt';

    export default {
        name: "MensajeCont",
        components: {
            MensajesInt
        },
        props: ['mensajes', 'usuario'],
    }
</script>

<style>

</style>