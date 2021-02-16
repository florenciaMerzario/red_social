import {API} from "../constants";

let usuarios = null;

// Creamos el objeto del servicio.
const usuariosService = {
    /**
     * Retorna los usuarios.
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/usuarios.php`);
        const respuesta     = await fetchResponse.json();
        usuarios = respuesta.data;
        return [...usuarios];
    },

    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/usuarios.php?id=${id}`);
        const respuesta     = await fetchResponse.json();
        return {...respuesta.data};
    },

    async loginU(id) {
        const fetchResponse = await fetch(`${API}/usuarios.php?id=${id}`);
        const respuesta     = await fetchResponse.json();
        return {...respuesta.data};
    },
    /**
     *
     * @param {{}} data
     * @return {Promise<Response | never>}
     */

    create: function(data) {
        return fetch(`${API}/usuarios.php`, {
            method: 'POST',
            body: JSON.stringify(data)
        })
            .then(rta => rta.json())
            .then(res => {
                if (!res.success) {
                    return false;
                }
//busco el id en la db FALTA EL ID
                const usuario = data;

                return {
                    ...usuario
                };
            });
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
        return fetch(`${API}/usuarios.php?id=${id}`, {
            method: 'PUT',
            body: JSON.stringify(data)
        })
            .then(rta => rta.json())
            .then(response => {
                return response;
            });
    },


    deleteItem: function(id) {
        return fetch(`${API}/usuarios.php?id=${id}`, {
            method: 'DELETE',
        })
            .then(rta => rta.json())
            .then(response => {
                return response.success;
            });
    }
};

export default usuariosService;
