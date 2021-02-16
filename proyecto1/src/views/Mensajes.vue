<template>
    <div class="margin-top-20">
        <h1>Mensajes</h1>
        <MensajesListaFiltro @change="setFiltro"/>
            <MensajeCont
                  :mensajes="mensajesFiltrados"
                  :usuario="this.usuario"
                />
    </div>
</template>

<script>
    import {API, PATH_IMGS} from "./../constants";
    import MensajesListaFiltro from "@/components/MensajesListaFiltro";
    import MensajeCont from "../components/MensajeCont";
    import mensajesService from '../Services/mensajes';
    import store from "@/store";


export default {
        name: "Mensajes",
        components: {
            MensajeCont,
            MensajesListaFiltro
        },

        data: function() {
            return {
                estaCargando: true,
                mensajes: [],

                filtros: {
                  mensaje: null
                },
                usuario:{
                      nombre:null,
                      id_usuario:null,
                      email:null,
                      password:null,
                      imagen:null,
                  },
                 store
              }
        },
  computed: {
    mensajesFiltrados() {
      if(this.filtros.mensaje == null || this.filtros.mensaje == '') {
        return this.mensajes;
      }
      const mensajes = [...this.mensajes];
      return mensajes.filter(item => item.mensaje.toLowerCase().indexOf(this.filtros.mensaje.toLowerCase()) !== -1);
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
            },

            setFiltro(filtroValor) {
              this.filtros.mensaje = filtroValor;
            }
        },

        mounted: function() {
            this.estaCargando = true;
            mensajesService
                .getAll()
                .then(response => {
                    this.estaCargando = false;
                    this.mensajes = response;
                });
        }
    }
</script>

<style>
</style>
