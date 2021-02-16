<template>
  <table
      class="table"
  >
    <thead>
    </thead>
    <MensajePrivadoUsuarioInt
        v-for="mensajePrivado in mensajesPrivados"
        :key="mensajePrivado.mensajePrivado"
        :mensajePrivado="mensajePrivado"
    ></MensajePrivadoUsuarioInt>
  </table>
</template>

<script>

import MensajePrivadoUsuarioInt from "@/components/MensajePrivadoUsuarioInt";

export default {
  name: "MensajePrivadoUsuarioCont",
  components: {
    MensajePrivadoUsuarioInt
  },
  props: ['mensajesPrivados', 'usuario', 'amigo'],
}
</script>

<style>

</style>