<template>
  <div class="row margin-top-70">
    <nav class="col-lg-3">
      <p>Tabla de navegación</p>
      <ul class="bg-transparent">
        <li class="bg-dark my-2"><router-link to="/mensajes">Listado</router-link></li>
        <li class="bg-dark my-2" v-if="store.auth.id !== null"><router-link to="/mensajes/nuevo">Crear nuevo</router-link></li>
      </ul>
    </nav>
    <div class="col-lg-9">
      <router-view></router-view>
    </div>
  </div>
</template>

<script>
import store from './../store';

export default {
  name: "MensajesLayout",
  data: () => ({
    store
  }),
}
</script>

<style>

</style>
