<template>
  <table
      class="table"
  >
    <thead>
    </thead>

    <ListadoUsuariosInt
        v-for="usuario in usuarios"
        :key="usuario.id_usuario"
        :usuario="usuario"
        :mensaje="mensaje"
    ></ListadoUsuariosInt>
  </table>
</template>

<script>

import ListadoUsuariosInt from './ListadoUsuariosInt';

export default {
  name: "ListadoUsuariosCont",
  components: {
    ListadoUsuariosInt
  },
  props: ['usuarios', 'mensaje'],
}
</script>

<style>

</style>