import {API} from "../constants"
let amigos = null;

// Creamos el objeto del servicio.
const amigosService = {
    /**
     * Retorna los amigos.
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/amigos.php`, {
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        amigos = respuesta.data;
        return [...amigos];
    },

    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/amigos.php?id=${id}`, {
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        if(respuesta.data){
            return {...respuesta.data};
        }else{
            return false
        }
    },

    async getByUserFriend(id_usuario, id_amigo) {
        const fetchResponse = await fetch(`${API}/amigos.php?id_usuario=${id_usuario}&id_amigo=${id_amigo}`,
            {
                credentials: 'include'
            });
        const respuesta     = await fetchResponse.json();
        return {...respuesta};
    },
    /**
     *
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    create: function($id_usuario, $id_amigo) {
        return fetch(`${API}/amigos.php`, {
                method: 'POST',
                body: JSON.stringify({
                    id_usuario: $id_usuario,
                    id_amigo: $id_amigo,
                    credentials: 'include'
                }),
            })
                .then(rta => rta.json())
                .then(response => {
                      return response;
            })
    },

    /**
     * *
     * @param {Number} id
     * @param {{}} data
     * @return {Promise<Response | never>}
     */

    delete: function($id_usuario, $id_amigo) {
        return fetch(`${API}/amigos.php?`, {
            method: 'DELETE',
            body: JSON.stringify({
                id_usuario: $id_usuario,
                id_amigo: $id_amigo,
                credentials: 'include'
            }),
            })
            .then(rta => rta.json())
            .then(response => {
                return true;
            })
    },
    async validarUsuarioLogueado(id_usuario) {
        const fetchResponse = await fetch(`${API}/amigos.php?id_usuario=${id_usuario}`);
        const respuesta     = await fetchResponse.json();
        return {...respuesta.data};
    },
};

// Exportamos el servicio.
export default amigosService
