<template>
    <div>
        <div class="d-flex flex-column">

            <h1>Mensajes</h1>
            <router-link to="/mensajes/nuevo" class="bg-light p-3 mb-3">Nuevo Mensaje</router-link>
        </div>
            <BaseLoader
                    v-if="estaCargando"
            />
            <MensajeCont
                    v-else
                    :mensajes="mensajesOrdenados"
                    :usuario="this.usuario"
            />
    </div>
</template>

<script>
    import {API} from "./../constants";
    import MensajeCont from "../components/MensajeCont";
    import BaseLoader from "../components/BaseLoader";
    import mensajesService from '../Services/mensajes';
    import usuariosService from "../Services/usuarios";


    export default {
        name: "Mensajes",
        components: {
            BaseLoader,
            MensajeCont
        },

        data: function() {
            return {
                estaCargando: true,
                mensajes: [],

                usuario:{
                    nombre:null,
                    id_usuario:null,
                    email:null,
                    password:null
                }
            }
        },

        computed: {
            mensajesOrdenados: function() {
                const mensajes = this.mensajes.slice();
                mensajes.reverse();
                return mensajes
            }
        },
        methods:{
            refrescarMensajes(){
                this.estaCargando = true;

                mensajesService
                    .getAll()
                    .then(response => {
                        this.estaCargando = false;
                        this.mensajes = response;
                    });
            }
        },

        mounted: function() {
            this.estaCargando = true;

            mensajesService
                .getAll()
                .then(response => {
                    this.estaCargando = false;
                    this.mensajes = response;
/*
                        usuariosService
                            .getByPk(this.mensaje.id_usuario)
                            .then(date => {
                                this.usuario = date;
                            });
*/
                });

        }
    }
</script>

<style>
</style>
