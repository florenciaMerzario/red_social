import {API} from "../constants"

let mensajes = null;

// Creamos el objeto del servicio.
const mensajesService = {
    /**
     * Retorna los mensajes.
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/mensajes.php`);
        const respuesta     = await fetchResponse.json();
        mensajes = respuesta.data;
        return [...mensajes];
    },

    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/mensajes.php?id=${id}`,{
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        return {...respuesta.data};
    },

    async loginU(id) {
        const fetchResponse = await fetch(`${API}/mensajes.php?id=${id}`,{
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        return {...respuesta.data};
    },

    /**
     *
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    create: function(data) {
        return fetch(`${API}/mensajes.php`, {
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
     * *
     * @param {Number} id
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    edit: function(id, data) {
        return fetch(`${API}/mensajes.php?id=${id}`, {
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
        return fetch(`${API}/mensajes.php?id=${id}`, {
            method: 'DELETE',
        })
            .then(rta => rta.json())
            .then(response => {
                return response.success;
            });
    }
};

// Exportamos el servicio.
export default mensajesService;
