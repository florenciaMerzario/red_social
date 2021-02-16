<template>
  <div class="m-5">
    <h1 class="text-dark">Detalle de Mensajes de: {{ usuario.nombre }}</h1>
    <div>
      <div class="bg-light rounded-sm p-5">

        <h6>Mensajes</h6>
        <div class="m-3">
          <router-link :to="`/listadoUsuarios/`">Volver</router-link></div>

        <MensajeCont
            :mensajes="mensaje"
        />
      </div>

    </div>

  </div>
</template>
<script>

import usuariosService from "../Services/usuarios";
import listadoUsuariosService from "@/Services/listadoUsuario";
import MensajeCont from "@/components/MensajeCont";

export default {
  name: "Mensajes",
  components: {
    MensajeCont,
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

      usuario:{
        nombre:null,
        id_usuario:null,
        email:null,
        imagen:null,
        alt:null
      },

    }
  },
  computed: {},
  methods: {},
  mounted() {
    const id = this.$route.params.id;

    usuariosService
        .getByPk(id)
        .then(data => {
          this.usuario = data;

          listadoUsuariosService
              .getByPk(id)
              .then(dito => {
                this.mensaje = dito;
              });

        })
  }
}


</script>

<style>

</style>
