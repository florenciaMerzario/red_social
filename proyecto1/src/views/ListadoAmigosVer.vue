  <template>
  <div class="m-5">
    <h1 class="text-dark">Listado de Usuario:</h1>

    <div>
      <div class="bg-light rounded-sm p-5">
        <h6>Amigo</h6>
        <p>{{usuario.nombre}}</p>
        <h6>Mensaje</h6>

        <p>{{usuario.imagen}}</p>
        <router-link :to="`/comentarios/nuevo/${mensaje.id_mensaje}`">/Ver</router-link>
        <router-link :to="`/comentarios/nuevo/${mensaje.id_mensaje}`">/Agregar Amigo</router-link>
        <!--   this.$router.push({path: '/pagename', param: {param1: 'value1', param2: value2})-->

        <div class="m-3">
          <router-link :to="`/mensajes/`">Volver</router-link></div>
        <ComentarioCont
            :comentarios="comentario"
        />
      </div>

    </div>

  </div>
</template>
<script>
import mensajesService from "../Services/mensajes";
import comentariosService from "../Services/comentarios";
import ComentarioCont from "../components/ComentarioCont";
import usuariosService from "../Services/usuarios";
import mensajesPrivadosService from "@/Services/mensajesPrivado";
export default {
  name: "Comentarios",
  components: {
    ComentarioCont
  },
  props: {},
  data: function () {
    return {
      mensaje: {
        id_comentario: '',
        id_mensaje: '',
        id_usuario: '',
        detalle_mensaje: '',
        fecha: '',
      },
      comentario:{
        id_usuario: '',
        detalle_comentario: '',
        id_mensaje: '',
        fecha: '',
        id_comentario: '',

      },
      usuario:{
        nombre:null,
        id_usuario:null
      },

      msgP:{
        mensaje: null,
      }
    }
  },
  computed: {},
  methods: {},
  mounted() {
    const id = this.$route.params.id;

    mensajesService
        .getByPk(id)
        .then(data => {
          this.mensaje = data;

          usuariosService
              .getByPk(this.mensaje.id_usuario)
              .then(dito => {
                this.usuario = dito;
              });

          comentariosService
              .getByPk(id)
              .then(data => {
                this.comentario = data;
              });

        })
  }
}


</script>

<style>

</style>
