import {API} from "../constants";

let usuarios = null;

// Creamos el objeto del servicio.
const listadoUsuariosService = {
    /**
     * Retorna los usuarios.
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/listadoUsuarios.php`, {
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        usuarios = respuesta.data;
        return [...usuarios];
    },

    getUsuarioMensaje: function (){
        const fetchResponse =  fetch(`${API}/listadoUsuarios.php`, {
            credentials: 'include'
        });
        const respuesta     =  fetchResponse.json();
        usuarios = respuesta.data;

        return [...usuarios];

    },
    /* ...comentario,
                    id_mensaje: this.$route.params.id,
                     id_usuario: id_usuario*/

    /**
     * Edita un producto en el servidor según su id.
     *
     * @param {Number} id
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    edit: function(id, data) {
        return fetch(`${API}/listadoUsuarios.php?id=${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            credentials: 'include'

        })
            .then(rta => rta.json())
            .then(response => {
                return response;
            });
    },


    deleteItem: function(id) {
        return fetch(`${API}/usuarios.php?id=${id}`, {
            method: 'DELETE',
            credentials: 'include'
        })
            .then(rta => rta.json())
            .then(response => {
                return response.success;
            });
    }
};

export default listadoUsuariosService;
