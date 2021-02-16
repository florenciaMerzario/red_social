<template>
  <div>
    <div class="d-flex flex-column my-3">
      <h1>Gente:</h1>
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
import authService from "@/Services/auth";
import usuariosService from "@/Services/usuarios";

export default {
  name: "ListadoUsuarios",
  components: {
    UsuarioCont
  },

  data: function () {
    return {
      estaCargando: true,
      usuarios: [],

      usuario: {
        nombre: null,
        id_usuario: null,
        email: null,
        password: null,
        imagen: null,
      },
      amigos: [],

      amigo: {
        id_usuario: null,
        id_amigo: null,
      },
    }
  },

  computed: {},
  methods: {},

  mounted: function () {

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
