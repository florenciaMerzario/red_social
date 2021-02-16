<?php

require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class Mensaje
{
    public $id_mensaje;
    public $id_usuario;
    public $mensaje;
    public $fecha;
    public $nombre;
    public $imagen;

    function mensajesCrear($data) {
        $db = DBConnection::getConnection();

        $fecha          = date('Y-m-d H:i:s');

        $query = "INSERT INTO mensajes (id_usuario, mensaje, fecha)
          VALUES (:id_usuario , :mensaje , :fecha)";

        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'id_usuario' => $data['id_usuario'],
            'mensaje' => $data['detalle_mensaje'],
            'fecha' => $fecha
        ]);
        if(!$exito) {
            return false;
        }else{
            return true;
        }
       // return mysqli_query($query);
    }

    function mensajesTodos($db)
    {
        $query = "SELECT * FROM mensajes";

        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }

        return $salida;
    }

    function mensajesTraerPorPk($id)
    {
       /* $id = (int)$id; //en vez de hacer la inyeccion sql
        $query = "SELECT * FROM mensajes WHERE id_mensaje = " . $id;

        $res = mysqli_query($db, $query);

        return mysqli_fetch_assoc($res);*/

        $db = DBConnection::getConnection();

        $id = (int)$id; //en vez de hacer la inyeccion sql

        $query = "SELECT * FROM mensajes WHERE id_mensaje = ?" ;
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $mensaje = new self;
            $mensaje->setFecha($fila['fecha']);
            $mensaje->setIdMensaje($fila['id_mensaje']);
            $mensaje->setIdUsuario($fila['id_usuario']);
            $mensaje->setMensaje($fila['mensaje']);

            return $mensaje;
        }
        return null;
    }

    function traerMensajesConUsuarios()
    {
        $db = DBConnection::getConnection();

        $query = "SELECT mensajes.mensaje, mensajes.fecha, mensajes.id_mensaje, mensajes.id_usuario,
                  usuarios.nombre, usuarios.imagen
                  from mensajes 
                  INNER JOIN usuarios ON mensajes.id_usuario = usuarios.id_usuario";
/*
        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }
        return $salida;*/

        $stmt = $db->prepare($query);
        $stmt->execute();
        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $obj = new self;
            $obj->setIdMensaje($fila['id_mensaje']);
            $obj->setIdUsuario($fila['id_usuario']);
            $obj->setMensaje($fila['mensaje']);
            $obj->setFecha($fila['fecha']);
            $obj->setNombre($fila['nombre']);
            $obj->setImagen($fila['imagen']);

            $salida[] = $obj;
        }
        return $salida;

    }    /**
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

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
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
    public function getImagen()
    {
        return $this->imagen;
    }

}