<template>
  <table
      class="table"
  >
    <thead>
    </thead>
    <MensajesUsuariosInt
        v-for="mensaje in mensajes"
        :key="mensaje.id_mensaje"
        :mensaje="mensaje"
    ></MensajesUsuariosInt>

    <ComentarioCont
        :comentarios="comentario"
    />
  </table>
</template>

<script>

import MensajesUsuariosInt from './MensajesUsuariosInt';
import ComentarioInt from "@/components/ComentarioInt";
import ComentarioCont from "@/components/ComentarioCont";
export default {
  name: "MensajesUsuariosCont",
  components: {
    MensajesUsuariosInt, ComentarioCont
  },
  props: ['mensajes', 'comentario'],
}
</script>

<style>

</style>