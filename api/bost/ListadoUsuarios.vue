<template>
  <div>
    <div class="d-flex flex-column my-3">
      <h1>Gente</h1>

    </div>
    <UsuarioCont
        :usuarios="usuarios"
        :usuario="this.usuario"
    />
  </div>
</template>

<script>
import {API, PATH_IMGS} from "./../constants";
import UsuarioCont from "@/components/UsuarioCont";
import usuariosService from '../Services/usuarios';


export default {
  name: "Usuarios",
  components: {
    UsuarioCont
  },

  data: function() {
    return {
      estaCargando: true,
      usuarios: [],

      usuario:{
        nombre:null,
        id_usuario:null,
        email:null,
        password:null,
        imagen:null,
      },
    }
  },

  computed: {

  },
  methods:{
    refrescarUsuarios(){
      this.estaCargando = true;

      usuariosService
          .getAll()
          .then(response => {
            this.estaCargando = false;
            this.usuarios = response;
          });
    }
  },

  mounted: function() {
    this.estaCargando = true;

    usuariosService
        .getAll()
        .then(response => {
          this.estaCargando = false;
          this.usuarios = response;
        });
  }
}
</script>

<style>
</style>
