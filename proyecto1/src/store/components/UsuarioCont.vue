<template>

  <table
      class="table"
  >
    <thead>
    </thead>
    <UsuarioInt
        v-for="usuario in usuarios"
        :key="usuario.id_usuario"
        :usuario="usuario"

    ></UsuarioInt>
  </table>
</template>

<script>

import UsuarioInt from './UsuarioInt';

export default {
  name: "UsuarioCont",
  components: {
    UsuarioInt
  },
  props: ['usuarios', 'usuario'],
}
</script>

<style>

</style>