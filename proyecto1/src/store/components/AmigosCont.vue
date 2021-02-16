<template>
  <table
      class="table table-striped table-bordered mt-5"
  >
    <tbody>
    <AmigosInt
        v-for="amigo in amigos"
        :key="amigo.id_amigo"
        :amigo="amigo"
    ></AmigosInt>
    </tbody>
  </table>
</template>


<script>
import AmigosInt from './AmigosInt';
export default {
  name: "AmigosCont",
  components: {
    AmigosInt
  },
  props: ['amigos', 'amigo'],
}
</script>

<style>

</style>