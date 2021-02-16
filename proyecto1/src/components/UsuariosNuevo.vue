<template>
    <div >
        <h1>Registro de Usuario</h1>
        <usuariosNuevoForm>
        </usuariosNuevoForm>
    </div>
</template>

<script>
    import {API} from "../constants";
    import UsuariosNuevoForm from "./UsuariosNuevoForm";
    export default {
        name: "UsuariosNuevo",
        components: {
            UsuariosNuevoForm
        },
        props:{},
        data: function () {
            return {}
        },
        computed:{},
        methods:{}
    }
</script>