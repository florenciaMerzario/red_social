<template>
  <div class="my-3">
    <h2>Filtrar</h2>
    <form @submit.prevent="emitChange">
      <div class="form-group">
        <label for="filtro-mensaje">Mensaje</label>
        <input
            type="text"
            id="filtro-mensaje"
            class="form-control"
            :value="value"
            @input="setValue($event)"
        >
      </div>
      <button type="submit" class="btn btn-primary btn-block">Aplicar filtros</button>
    </form>
  </div>
</template>

<script>
export default {
  name: "MensajesListaFiltro",
  components: {},
  props: {},
  data: () => ({
    value: null
  }),
  computed: {},
  methods: {
    /**
     * Setea el nuevo valor para value, y emite el evento change con ese valor.
     *
     * @param {Event} ev
     */
    setValue(ev) {
      this.value = ev.target.value;
      this.emitChange();
    },

    /**
     * Emite el evento change con el value.
     */
    emitChange() {
      this.$emit('change', this.value);
    }
  }
}
</script>

<style>

</style>
