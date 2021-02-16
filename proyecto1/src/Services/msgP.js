// Vamos a crear el servicio de comentarios.
// Un servicio es un objeto que brinda métodos para administrar alguna funcionalidad.

import {API} from "@/constants";

let msgP = null;

const mensajePrivadoService = {
    /**
     *
     * @return {Promise<Response | never>}
     */
    getAll: async function() {
        const fetchResponse = await fetch(`${API}/msgP.php`, {
            credentials: 'include'

        });
        const respuesta     = await fetchResponse.json();
        msgP = respuesta.data;
        return [...msgP];
    },


    async getByPk(id_usuario, id_amigo) {
        const fetchResponse = await fetch(`${API}/msgp.php?id_usuario=${id_usuario}&id_amigo=${id_amigo}`,
            {
                credentials: 'include'
        });
        const respuesta     = await fetchResponse.json();
        if (respuesta.data == false) {
            return false
        }else{
            return {...respuesta.data};
        }
    },

    async getByUser(id_usuario) {
        const fetchResponse = await fetch(`${API}/msgp.php?id_usuario=${id_usuario}`, {
            credentials: 'include'
        });
        const respuesta = await fetchResponse.json();
        console.log('respuesta en service')
        console.log(respuesta.data)
        if(respuesta.data){
            return {...respuesta.data};
        }else{
            return false
        }
    },/**
     *
     * @param {{}} data
     * @return {Promise<Response | never>}
     */
    create: function(data) {
        return fetch(`${API}/msgP.php?`, {
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

};

// Exportamos el servicio.
export default mensajePrivadoService;
