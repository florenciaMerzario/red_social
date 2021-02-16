<template>
  <div >
    <h1>Añadir Mensaje</h1>
    <MensajePrivadoNuevoForm/>
  </div>


</template>

<script>
import {API} from "../constants";
import MensajePrivadoNuevoForm from "@/components/MensajePrivadoNuevoForm";

export default {
  name: "MensajePrivadoNuevo",
  components: {
    MensajePrivadoNuevoForm,
  },
  props:{},
  data: function () {
    return {}
  },
  computed:{},
  methods:{}
}

</script>