<template>

  <div>
    <ul class="list-group border-primary px-5 mt-3 mb-3">

        <div class="bg-light">
        <p class="alert alert-secondary">Comentario:</p>
          <li class="list-group-item"><span>Usuario:  </span>{{comentario.nombre}}</li>

          <div class="d-flex ">
            <div
                v-if="tieneImagen"
                class="img-msg-gd d-inline-block"
            >
              <img class="p-3"
                   :src="imagenPath"
                   :alt="comentario.nombre"
              >
            </div>
            <div
                v-else class="m-1">''</div>
          </div>
          <li class="list-group-item"><span>Fecha:  </span>{{comentario.fecha}}</li>
          <li class="list-group-item"><span>Detalle:  </span>{{comentario.detalle_comentario}}</li>
        </div>
    </ul>

  </div>
</template>

<script>
    import store from "../store";
    import comentariosService from "../Services/comentarios";
    import mensajesService from "@/Services/mensajes";
    import usuariosService from "@/Services/usuarios";
    import {PATH_IMGS} from "@/constants";

    export default {
      name: "ComentarioInt",
      props: ['comentario','amigo'],
      data: function () {
        return {
          store,

        }
      },
      computed: {
        imagenPath() {
          return `${PATH_IMGS}/${this.comentario.imagen}`;
        },
        tieneImagen() {
          return this.comentario.imagen !== null && this.comentario.imagen !== '';
        },
      },
      methods: {
      },

    }
</script>

<style>

</style>
