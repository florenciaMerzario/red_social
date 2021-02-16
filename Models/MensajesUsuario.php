<?php

require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class MensajesUsuario
{
    public $id_mensaje;
    public $id_usuario;
    public $mensaje;
    public $fecha;
    public $nombre;
    public $imagen;

    function mensajesTraerPorPk($id)
    {
        $db = DBConnection::getConnection();
        $id = (int)$id;

        $query = "SELECT mensajes.*,usuarios.* from mensajes,usuarios 
                where mensajes.id_usuario =  :id AND 
                mensajes.id_usuario = usuarios.id_usuario" ;

        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $obj = new self;
            $obj->setMensaje($fila['mensaje']);
            $obj->setFecha($fila['fecha']);
            $obj->setImagen($fila['imagen']);
            $obj->setNombre($fila['nombre']);
            $obj->setIdUsuario($fila['id_usuario']);
            $obj->setIdMensaje($fila['id_mensaje']);

            $salida[] = $obj;
        }
        return $salida;
        /*
        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }
        return $salida;*/
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @param mixed $id_mensaje
     */
    public function setIdMensaje($id_mensaje)
    {
        $this->id_mensaje = $id_mensaje;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @return mixed
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @return mixed
     */
    public function getIdMensaje()
    {
        return $this->id_mensaje;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }
}