<?php
require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class AmigosMensajes
{
    public $id_mensaje;
    public $id_usuario;
    public $mensaje;
    public $fecha;
    public $nombre;
    public $imagen;
    public $email;


    function mensajesTraerPorPk($id)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT mensajes.id_usuario, mensajes.mensaje, mensajes.id_mensaje, mensajes.fecha, 
                    usuarios.nombre, usuarios.email, usuarios.imagen FROM 
                    mensajes INNER JOIN usuarios WHERE
                     mensajes.id_usuario = :id AND usuarios.id_usuario = mensajes.id_usuario
                  ";

        $stmt = $db->prepare($query);
        $stmt->execute([
            'id' => $id
        ]);
        $salida = [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new self;
            // Le cargo los datos.
            $obj->setMensaje($fila['mensaje']);
            $obj->setFecha($fila['fecha']);
            $obj->setIdUsuario($fila['id_usuario']);
            $obj->setNombre($fila['nombre']);
            $obj->setImagen($fila['imagen']);
            $obj->setIdMensaje($fila['id_mensaje']);
            $obj->setEmail(['email']);

            $salida[] = $obj;
        }
        return $salida;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
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
    public function getMensaje()
    {
        return $this->mensaje;
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
    public function getIdMensaje()
    {
        return $this->id_mensaje;
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
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $id_mensaje
     */
    public function setIdMensaje($id_mensaje)
    {
        $this->id_mensaje = $id_mensaje;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @param mixed $imagen
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
}