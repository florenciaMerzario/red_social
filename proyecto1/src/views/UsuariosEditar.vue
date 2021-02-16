<template>
    <div>
        <h1>Editar Perfil</h1>
            <p>Modificá tus datos. Cuando hayas terminado, dale click a "Grabar".</p>
      <UsuariosEditarForm />
    </div>
</template>

<script>
    import UsuariosEditarForm from "../components/UsuariosEditarForm";

    export default {
        name: "UsuariosEditar",
        components: {
            UsuariosEditarForm
        },
        props: {},
        data: function () {
            return {}
        },
        computed: {},
        methods: {}
    }

</script>

<style>

</style>
