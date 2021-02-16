<?php

require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class MensajePrivado
{
    public $id_mensajePrivado;
    public $id_usuarioEnvia;
    public $id_usuarioRecibe;
    public $mensaje;
    public $fecha;

    function mensajesCrear($data) {

        $db = DBConnection::getConnection();

      /*  $id_usuarioEnvia     = mysqli_real_escape_string($db, $data['id_usuario']);
        $id_usuarioRecibe    = mysqli_real_escape_string($db, $data['id_amigo']);
        $mensaje        = mysqli_real_escape_string($db, $data['mensaje']);
      */
       $fecha          = date('Y-m-d H:i:s');

        $query = "INSERT INTO mensajesPrivados (id_usuarioEnvia, id_usuarioRecibe, mensaje, fecha)
          VALUES (:id_usuarioEnvia, :id_usuarioRecibe, :mensaje, :fecha)";

        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'id_usuarioEnvia' => $data['id_usuario'],
            'id_usuarioRecibe' => $data['id_amigo'],
            'mensaje' => $data['mensaje'],
            'fecha' => $fecha,
        ]);
        if(!$exito) {
            return false;
        }else{
            return true;
        }

       // return mysqli_query($db, $query);
    }

    function traerMensajesPrivadosPorUsuario($id_usuarioEnvia, $id_usuarioRecibe)
    {
        $db = DBConnection::getConnection();

        $query = "SELECT * FROM mensajesprivados 
                    WHERE id_usuarioEnvia = :id_usuarioEnvia
                    AND id_usuarioRecibe = :id_usuarioRecibe 
                    or id_usuarioRecibe = :id_usuarioEnvia 
                    AND id_usuarioEnvia = :id_usuarioRecibe
                    ";

        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'id_usuarioEnvia' => $id_usuarioEnvia,
            'id_usuarioRecibe' => $id_usuarioRecibe,
        ]);
        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $obj = new self;
            $obj->setIdUsuarioRecibe($fila['id_usuarioRecibe']);
            $obj->setIdUsuarioEnvia($fila['id_usuarioEnvia']);
            $obj->setIdMensajePrivado($fila['id_mensajePrivado']);
            $obj->setFecha($fila['fecha']);
            $obj->setMensaje($fila['mensaje']);

            $salida[] = $obj;
        }
        return $salida;
    /*    $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }
        return $salida;*/

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
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @param mixed $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    /**
     * @return mixed
     */
    public function getIdMensajePrivado()
    {
        return $this->id_mensajePrivado;
    }

    /**
     * @return mixed
     */
    public function getIdUsuarioEnvia()
    {
        return $this->id_usuarioEnvia;
    }

    /**
     * @return mixed
     */
    public function getIdUsuarioRecibe()
    {
        return $this->id_usuarioRecibe;
    }

    /**
     * @param mixed $id_mensajePrivado
     */
    public function setIdMensajePrivado($id_mensajePrivado)
    {
        $this->id_mensajePrivado = $id_mensajePrivado;
    }

    /**
     * @param mixed $id_usuarioEnvia
     */
    public function setIdUsuarioEnvia($id_usuarioEnvia)
    {
        $this->id_usuarioEnvia = $id_usuarioEnvia;
    }

    /**
     * @param mixed $id_usuarioRecibe
     */
    public function setIdUsuarioRecibe($id_usuarioRecibe)
    {
        $this->id_usuarioRecibe = $id_usuarioRecibe;
    }

}