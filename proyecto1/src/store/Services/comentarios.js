// Vamos a crear el servicio de comentarios.
// Un servicio es un objeto que brinda métodos para administrar alguna funcionalidad.

import {API} from "../constants";

let comentarios = null;

const comentariosService = {
    /**
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/comentarios.php`, {
            credentials: 'include'

        });
        const respuesta     = await fetchResponse.json();
        comentarios = respuesta.data;
        return [...comentarios];
    },

    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/comentarios.php?id=${id}`, {
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        return [...respuesta.data];
    },


    /**
     *
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    create: function(data) {

        return fetch(`${API}/comentarios.php`, {
            method: 'POST',
            body: JSON.stringify(data),
            credentials: 'include'

        })
            .then(rta => rta.json())
            .then(response => {
                return response;
            });
    },
    /**
     *
     * @param {Number} id
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    edit: function(id, data) {
        return fetch(`${API}/comentarios.php?id=${id}`, {
            method: 'PUT',
            body: JSON.stringify(data),
            credentials: 'include'

        })
            .then(rta => rta.json())
            .then(response => {
                return response;
            });
    },

};

// Exportamos el servicio.
export default comentariosService;
