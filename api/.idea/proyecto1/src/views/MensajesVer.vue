<template>
    <div    >
        <h1>Detalle de Posteo Nro:{{ mensaje.id_mensaje }}</h1>

        <div>
                <div class="card" style="width: 18rem;">

                    <div class="card-body">
                        <h6 class="card-title">Fecha</h6>
                        <p class="card-title">{{mensaje.fecha}}</p>
                        <h6 class="card-title">Mensaje</h6>
                        <p class="card-text">{{mensaje.mensaje }}</p>
                        <h6 class="card-title">Usuario</h6>
                        <p class="card-text">{{usuario.nombre}}</p>

                       <router-link :to="`/comentarios/nuevo/${mensaje.id_mensaje}`">Agregar Comentario</router-link>

                     <!--   this.$router.push({path: '/pagename', param: {param1: 'value1', param2: value2})-->

                    </div>
                   <div class="m-3">
                        <router-link :to="`/mensajes/`">Volver</router-link></div>

                </div>

            </div>

    <ComentarioCont
            :comentarios="comentario"
            :usuario="usuario"
    />
    </div>

</template>

<script>
    import mensajesService from "../Services/mensajes";
    import comentariosService from "../Services/comentarios";
    import ComentarioCont from "../components/ComentarioCont";
    import usuariosService from "../Services/usuarios";

    export default {
        name: "Comentarios",
        components: {
            ComentarioCont
        },
        props: {},
        data: function () {
            return {

                mensaje: {
                    id_mensaje: '',
                    id_usuario: '',
                    detalle_mensaje: '',
                    fecha: '',
                },
                comentario:{
                    id_comentario: '',
                    id_usuario: '',
                    detalle_comentario: '',
                    id_mensaje: '',
                    fecha: '',
                },
                usuario:{
                    nombre:'',
                    id_usuario:''
                },
            }
        },
        computed: {},
        methods: {},
        mounted() {
            const id = this.$route.params.id;

            mensajesService
                .getByPk(id)
                .then(data => {
                    this.mensaje = data;
                    console.log('soy MENSAJE')
                    console.log(data)

                    usuariosService
                        .getByPk(this.mensaje.id_usuario)

                        .then(date => {
                            this.usuario = date;
                            console.log('soy usuario...')
                            console.log(date)
                        });

            comentariosService
                .getByPk(id)
                .then(data => {
                    this.comentario = data;
                    mensajesService
                        .getByPk(id)
                        .then(data => {
                            this.mensaje = data;

                    usuariosService
                        .getByPk(this.mensaje.id_usuario)

                        .then(date => {
                            this.usuario = date;
                            console.log('soy usuario...')
                            console.log(date)
                        });
                     });

                })
                })
    }
    }


</script>

<style>

</style>
