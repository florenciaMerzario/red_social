<template>
    <div>
        <h1>Comentarios</h1>
        <p>Sección de administración de comentarios.</p>
        <router-link to="/comentarios/nuevo">Crear nuevo comentario</router-link>
        <ComentarioCont
                :comentarios="comentariosOrdenados"
        />

    </div>
</template>

<script>
    import {API} from "./../constants";
    import ComentarioCont from "../components/ComentarioCont";
    import comentariosService from '../Services/comentarios';

    export default {
        name: "Comentarios",
        components: {
            ComentarioCont
        },
        data: function() {
            return {
                estaCargando: true,
                comentarios: [],
                usuario:{
                    nombre:'',
                },
            }
        },

      computed: {
            comentariosOrdenados: function() {

                const comentarios = this.comentarios.slice();
                comentarios.reverse();
                return comentarios;
            }
        },
        methods:{
            refrescarComentarios(){
                this.estaCargando = true;

                comentariosService
                    .getAll()
                    .then(response => {
                        this.estaCargando = false;
                        this.comentarios = response;
                    });
            }
        },

        mounted: function() {
            this.estaCargando = true;
            comentariosService
                .getAll()
                .then(response => {
                    this.estaCargando = false;
                    this.comentarios = response;
                });
        }
    }
</script>

<style>

</style>
