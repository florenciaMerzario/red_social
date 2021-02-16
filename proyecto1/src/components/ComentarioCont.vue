<template>
    <table
        class="table table-striped table-bordered mt-5"
    >
        <tbody>
        <ComentarioInt
                v-for="comentario in comentarios"
                :key="comentario.id_comentario"
                :comentario="comentario"
                :amigo="amigo"
        ></ComentarioInt>

        </tbody>
    </table>
</template>


<script>
    import ComentarioInt from './ComentarioInt';
    export default {
        name: "ComentarioCont",
        components: {
            ComentarioInt
        },
        props: ['comentarios', 'amigo', 'comentario'],

      mounted: function () {
        this.estaCargando = true;
        console.log('soy comentariosS en cont' )
        console.log(this.comentarios)

        console.log('soy comentario1 cont' )
        console.log(this.comentario)
      },

    }


</script>

<style>

</style>
