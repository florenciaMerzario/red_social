<template>


<div>
    <ul class="list-group border-primary px-5 mt-3 mb-3">
        <div class="bg-light">
        <p class="alert alert-secondary">Comentario:</p>
        <p class="px-3">Fecha:</p>
        <li class="list-group-item">{{comentario.fecha}}</li>
        <p class="px-3">Detalle</p>
        <li class="list-group-item">{{comentario.detalle_comentario}}</li>
        <p class="px-3">Usuario</p>
        <li class="list-group-item">{{usuario.nombre}}</li>
        </div>
    </ul>
</div>


</template>

<script>
    import store from "../store";
    import comentariosService from "../Services/comentarios";

    export default {
        name: "ComentarioInt",
        props: ['comentario',  'usuario'],
        data: function () {
            return {
                store
            }
        },
        methods: {}

    }

</script>

<style>

</style>
