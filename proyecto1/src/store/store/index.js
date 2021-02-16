const store = {
    status: {
        titulo: null,
        mensaje: null,
        tipo: null

    },
    auth: {
        id_usuario: null,
        email: null,
        nombre: null
    },

    setStatus(newStatus){
        this.status = {
            ...this.status,
            ...newStatus
        }

    },
    clearStatus(){
        this.status = {
            titulo: null,
            mensaje: null,
            tipo: null,
        }
    }
}

export default store;