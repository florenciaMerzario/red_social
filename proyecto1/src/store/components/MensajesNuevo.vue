<template>
    <div >
        <h1>Añadir Mensaje</h1>
        <mensajesNuevoForm>
        </mensajesNuevoForm>
    </div>
</template>

<script>
    import {API} from "../constants";
    import MensajesNuevoForm from "./MensajesNuevoForm";
    export default {
        name: "MensajesNuevo",
        components: {
            MensajesNuevoForm
        },
        props:{},
        data: function () {
            return {}
        },
        computed:{},
        methods:{}
    }

</script>