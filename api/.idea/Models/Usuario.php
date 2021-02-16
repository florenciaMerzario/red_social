<?php


class Usuario
{
    private $id_usuario;
    private $nombre;
    private $email;
    private $password;

    function usuariosCrear($db, $data) {

        $nombre           = mysqli_real_escape_string($db, $data['nombre']);
        $email            = mysqli_real_escape_string($db, $data['email']);
        $password         = password_hash($data['password'], PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios (password, nombre, email)
          VALUES ('" . $password . "', '" . $nombre . "', '" . $email . "')";

        return mysqli_query($db, $query);
    }

    function usuariosTodos($db)
    {
        $query = "SELECT * FROM usuarios";

        $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }

        return $salida;
    }



    function usuariosTraerPorPk($db, $id)
    {
        $id = (int)$id; //en vez de hacer la inyeccion sql
        $query = "SELECT * FROM usuarios WHERE id_usuario = " . $id;

        $res = mysqli_query($db, $query);

        return mysqli_fetch_assoc($res);

    }


    function usuariosEditar($db, $id, $data) {
      //  $id              = (int) $id; //en vez de hacer la inyeccion sql
        $nombre          = mysqli_real_escape_string($db, $data['nombre']);
        $email           = mysqli_real_escape_string($db, $data['email']);
      //  $password       = mysqli_real_escape_string($db, $data['password']);


        $query = "UPDATE usuarios SET
                                    nombre = '" . $nombre . "',
                                    email = '" . $email . "'
                               
                                    WHERE id_usuario = " . $id;

        return mysqli_query($db, $query);
    }


}