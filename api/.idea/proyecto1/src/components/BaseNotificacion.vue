<template>
    <div
            class="alert alert-dismissible"
            :class="['alert-' + tipo]"
    >
        <h3
                class="alert-heading"
                v-if="titulo != null"
        >
            {{ titulo }}
        </h3>
        {{ mensaje }}
        <button
                type="button"
                class="close"
                data-dismiss="alert"
                aria-label="Cerrar"
                v-if="closable"
                @click="$emit('close')"> <!-- envia el evento al padre-->
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
    export default {
        name: "BaseNotificacion",
        components: {},
        props: {
            // Definimos la propiedad, y el tipo de dato.
            // Noten que el tipo de dato no va entre comillas, sino que le pasamos el "constructor" del tipo
            // nativo de JS.
            mensaje: {
                type: String,
                required: true
            },
            tipo: {
                type: String,
                default: 'primary'
            },
            closable: {
                type:Boolean,
                default: true
            },
            titulo: String,
        },
        data: function () {
            return {}
        },
        computed: {},
        methods: {}
    }
</script>

<style>

</style>
