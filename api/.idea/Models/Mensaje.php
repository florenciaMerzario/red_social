<?php

class Mensaje
{
    private $id_mensaje;
    private $id_usuario;
    private $mensaje;
    private $fecha;

    function mensajesCrear($db, $data) {

        $id_usuario     = mysqli_real_escape_string($db, $data['id_usuario']);
        $mensaje        = mysqli_real_escape_string($db, $data['detalle_mensaje']);
        $fecha          = date('Y-m-d H:i:s');

        $query = "INSERT INTO mensajes (id_usuario, mensaje, fecha)
          VALUES ('" . $id_usuario . "' , '" . $mensaje . "', '" . $fecha . "')";

        return mysqli_query($db, $query);
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

    function mensajesTraerPorPk($db, $id)
    {
        $id = (int)$id; //en vez de hacer la inyeccion sql
        $query = "SELECT * FROM mensajes WHERE id_mensaje = " . $id;

        $res = mysqli_query($db, $query);

        return mysqli_fetch_assoc($res);

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



}