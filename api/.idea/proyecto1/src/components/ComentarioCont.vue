<template>
    <table
            class="table table-striped table-bordered mt-5"
    >
    <!--   <thead>
        <tr>
            <th>Comentario (ID)</th>
            <th>Usuario (ID)</th>
            <th>Detalle </th>
            <th>Fecha</th>

        </tr>
        </thead>
              -->
        <tbody>
        <ComentarioInt
                v-for="comentario in comentarios"
                :key="comentario.id_comentario"
                :comentario="comentario"
                :usuario="usuario"
        ></ComentarioInt>

        </tbody>
    </table>
</template>


<script>

    import ComentarioInt from './ComentarioInt';

    export default {
        name: "ComentariosCont",
        components: {
            ComentarioInt
        },
        props: ['comentarios','usuario'],
    }
</script>

<style>

</style>