import {API} from "../constants";

let userData = {
    id_usuario: null,
    email: null,
    nombre: null,
};

const authService = {
    /**
     * Trata de autenticar al usuario contra la API.
     *
     * @param {{}} credenciales
     * @param {String} credenciales.email
     * @param {String} credenciales.password
     * @return Promise
     */
    login(credenciales) {
        return fetch(`${API}/login.php`, {
            method: 'POST',
            body: JSON.stringify(credenciales),

            credentials: 'include'
        })
            .then(res => res.json())
            .then(res => {
                if(!res.success) {
                    return false;
                }
                const usuario = res.data.usuario;
                userData = {
                    ...usuario
                };
                return {
                    ...userData
                };
            });
    },

    /**
     * Cierra sesión.
     *
     * @return Promise
     */
    logout() {
        return fetch(`${API}/logout.php`, {
            method: 'POST',
            credentials: 'include'
        })
            .then(rta => rta.json())
            .then(res => {
                userData = {
                    id_usuario: null,
                    email: null,
                    nombre: null,
                };
                return res;
            });
    },

    /**
     * Loguea forzosamente al usuario provisto como argumento.
     *
     * @param {{}} user
     * @param {{}} user.id_usuario
     * @param {{}} user.email
     * @param {{}} user.nombre
     * @param {{}} user.apellido
     */
    logUser(user) {
        userData = {...user};
    },


    /**
     * Retorna true si el usuario está autenticado.
     * false de lo contrario.
     *
     * @return {boolean}
     */
    isLogged: function() {
        return userData.id_usuario !== null;
    }
};

export default authService;
