import {API} from "../constants";

let userData = {
    id: null,
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
            // Por defecto, fetch *no* envía ni recibe cookies.
            // Si quiero permitir el uso de cookies, tengo que explícitamente declararlo con la siguiente
            // propiedad:
            credentials: 'include'
        })
            .then(res => res.json())
            .then(res => {
                console.log(res);

                if(!res.success) {
                    return false;
                }

                const usuario = res.data.usuario;
                userData = {
                    // id: usuario.id,
                    // email: usuario.email,
                    // nombre: usuario.nombre,
                    // apellido: usuario.apellido,
                    // Usando la sintaxis de ES6+
                    ...usuario
                };
                // Guardamos el usuario en localStorage.
                localStorage.setItem('user', JSON.stringify(userData));

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
                    id: null,
                    email: null,
                    nombre: null,
                };
                // Lo borro de localStorage.
                localStorage.removeItem('user');
                return res;
            });
    },

    /**
     * Loguea forzosamente al usuario provisto como argumento.
     *
     * @param {{}} user
     * @param {{}} user.id
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
        return userData.id !== null;
    },

    /**
     * Retorna la data del usuario.
     *
     * @return {{id: null, email: null, nombre: null, apellido: null}}
     */
    getUserData() {
        return {...userData};
    }
};

if(localStorage.getItem('user') !== null) {
    userData = JSON.parse(localStorage.getItem('user'));
    authService.logUser(userData);
}

export default authService;
