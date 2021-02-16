import {API} from "../constants"
import comentariosService from "@/Services/comentarios";

let amigosMensajes = null;

// Creamos el objeto del servicio.
const amigosMensajesService = {
    /**
     * Retorna los mensajes.
     *
     * @return {Promise<Response | never>}
     */
    async getByPk(id) {
        const fetchResponse = await fetch(`${API}/amigosMensajes.php?id=${id}`, {
            credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        if (respuesta.data == false) {
            return false;
        }else{
            return {...respuesta.data}
        }
    },

};

export default amigosMensajesService;


