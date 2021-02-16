<?php

require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class Comentario
{
    public $id_comentario;
    public $id_usuario;
    public $detalle_comentario;
    public $id_mensaje;
    public $detalle_mensaje;
    public $fecha;
    public $nombre;
    public $imagen;


    function comentariosCrear($data) {
        $db = DBConnection::getConnection();

        $fecha                 = date('Y-m-d H:i:s');

            $query = "INSERT INTO comentarios (detalle_comentario, id_usuario, id_mensaje, fecha)
            VALUES  (:detalle_comentario, :id_usuario, :id_mensaje, :fecha)";

            $stmt = $db->prepare($query);
            $exito = $stmt->execute([
                'detalle_comentario' => $data['detalle_comentario'],
                'id_usuario' => $data['id_usuario'],
                'id_mensaje' => $data['id_mensaje'],
                'fecha' => $fecha
            ]);
            if(!$exito) {
                return false;
            }else{
            return true;
             }
      //  return mysqli_query($db, $query);
    }

    function comentariosTodos()
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM comentarios";

        $res = mysqli_query($query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }

        return $salida;
    }

    function comentariosTraerPorPk($id)
        {
            $db = DBConnection::getConnection();

            $query = "SELECT comentarios.id_comentario, comentarios.id_usuario, 
                        comentarios.detalle_comentario, comentarios.id_mensaje , 
                        comentarios.fecha, usuarios.nombre, usuarios.imagen 
                        FROM comentarios INNER JOIN usuarios WHERE id_mensaje = ?
                        AND comentarios.id_usuario = usuarios.id_usuario";

            $stmt = $db->prepare($query);
            $stmt->execute([$id]);

            $salida = [];
            while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $obj = new self;

                $obj->setFecha($fila['fecha']);
                $obj->setIdMensaje($fila['id_mensaje']);
                $obj->setDetalleComentario($fila['detalle_comentario']);
                $obj->setImagen($fila['nombre']);
                $obj->setImagen($fila['imagen']);
                $obj->setIdComentario($fila['id_comentario']);
                $obj->setIdUsuario($fila['id_usuario']);

                $salida[] = $obj;
            }
            return $salida;

        }
    /**
     * @param mixed $id_comentario
     */
    public function setIdComentario($id_comentario)
    {
        $this->id_comentario = $id_comentario;
    }

    /**
     * @param mixed $detalle_mensaje
     */
    public function setDetalleMensaje($detalle_mensaje)
    {
        $this->detalle_mensaje = $detalle_mensaje;
    }

    /**
     * @return mixed
     */
    public function getIdComentario()
    {
        return $this->id_comentario;
    }

    /**
     * @return mixed
     */
    public function getDetalleMensaje()
    {
        return $this->detalle_mensaje;
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
    public function getIdUsuario()
    {
        return $this->id_usuario;
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
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param mixed $id_mensaje
     */
    public function setIdMensaje($id_mensaje)
    {
        $this->id_mensaje = $id_mensaje;
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

    /**
     * @return mixed
     */

    /**
     * @return mixed
     */
    public function getDetalleComentario()
    {
        return $this->detalle_comentario;
    }

    /**
     * @param mixed $detalle_comentario
     */
    public function setDetalleComentario($detalle_comentario)
    {
        $this->detalle_comentario = $detalle_comentario;
    }

}