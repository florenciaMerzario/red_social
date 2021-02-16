import {API} from "../constants"

let mensUsuarios = null;
// Creamos el objeto del servicio.
const mensajesUsuarios = {
    /**
     * Retorna los amigos.
     *
     * @return {Promise<Response | never>}
     */

    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/mensajesUsuario.php?id=${id}`, {
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

    /**
     * *
     * @param {Number} id
     * @param {{}} data
     * @return {Promise<Response | never>}
     */


};

// Exportamos el servicio.
export default mensajesUsuarios
