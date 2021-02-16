<?php
/*
namespace Api\DB;
use Api\DB\DBConnection;
use PDO;
*/
class Comentario
{
    private $id_comentario;
    private $id_usuario;
    private $id_mensaje;
    private $detalle_mensaje;
    private $fecha;

  /*  public function crear(array $data, $fecha)
    {

        $query = "INSERT INTO mensajes (id_mensaje, mensaje, id_usuario, fecha)
                                 VALUES (NULL, :mensaje, :id_usuario, :fecha)";
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'mensaje' => $data['mensaje'],
            'id_usuario' => $data['id_usuario'],
            'fecha' => $fecha
        ]);*/


        /*function comentariosCrear($db, $data) {
           // $db = DBConnection::getConnection();

            $query = "INSERT INTO comentarios (detalle_comentario, id_usuario, id_mensaje, fecha)
          VALUES (:detalle_comentario, :id_usuario', :id_mensaje, :fecha )";

            $stmt = $bd->prepare($query);
            $exito = $stmt->execute([
                'detalle_comentario' => mysqli_real_escape_string($db, $data['detalle_comentario']),
                'id_usuario' => mysqli_real_escape_string($db, $data['id_usuario']),
                'id_mensaje' => mysqli_real_escape_string($db, $data['id_mensaje']),
                'fecha' => date('Y-m-d H:i:s')
            ]);

            return mysqli_query($db, $query);
        }
*/
    function comentariosCrear($db, $data) {

        $id_usuario            = mysqli_real_escape_string($db, $data['id_usuario']);
        $detalle_comentario    = mysqli_real_escape_string($db, $data['detalle_comentario']);
        $id_mensaje            = mysqli_real_escape_string($db, $data['id_mensaje']);
        $fecha                 = date('Y-m-d H:i:s');



        $query = "INSERT INTO comentarios (detalle_comentario, id_usuario, id_mensaje, fecha)
          VALUES ('" . $detalle_comentario . "', '" . $id_usuario . "',  '" . $id_mensaje . "' , '" . $fecha . "')";

        return mysqli_query($db, $query);
    }

    function comentariosTodos($db)
    {
        $query = "SELECT * FROM comentarios";

        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }

        return $salida;
    }



            function comentariosTraerPorPk($db, $id)
        {
        $query = "SELECT * FROM comentarios WHERE id_mensaje = $id";

        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
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

}