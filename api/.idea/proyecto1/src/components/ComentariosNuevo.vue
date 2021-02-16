<template>
    <div >
        <h1>Añadir Post</h1>
        <comentariosNuevoForm>
        </comentariosNuevoForm>
    </div>
</template>

<script>

    import {API} from "../constants";
    import ComentariosNuevoForm from "./ComentariosNuevoForm";

    export default {
        name: "ComentariosNuevo",
        components: {
            ComentariosNuevoForm
        },
        props:{},
        data: function () {
            return {}
        },
        computed:{},
        methods:{}
    }

</script>