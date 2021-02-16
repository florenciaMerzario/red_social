<?php

require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;

class Usuario
{
    public $id_usuario;
    public $nombre;
    public $email;
    public $password;
    public $imagen;
    public $imagen1;
    public $alt;

    function usuariosCrear($data)
    {
        $db = DBConnection::getConnection();
        /*  $nombre           = mysqli_real_escape_string($db, $data['nombre']);
          $email            = mysqli_real_escape_string($db,$data['email']);
        /*  $password         = password_hash($data['password'], PASSWORD_DEFAULT);
          $imagen           = mysqli_real_escape_string($db, $data['imagen']);
          $alt              = $imagen;
  */

        $query = "SELECT * FROM usuarios WHERE email = :email" ;
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'email' => $data['email']
        ]);
        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return false;
        }else{

            $query = "INSERT INTO usuarios (password, nombre, email, imagen, alt)
              VALUES (:password , :nombre , :email , :imagen , :alt)";

            $stmt = $db->prepare($query);
            $exito = $stmt->execute([
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
                'imagen' => $data['imagen'],
                'alt' => $data['imagen'],
            ]);
            if (!$exito) {
                return false;
            } else {
                return true;
            }
        }
//        return mysqli_query($db, $query);
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



    function usuariosTraerPorPk($id)
    {
        $db = DBConnection::getConnection();


        $id = (int)$id; //en vez de hacer la inyeccion sql
        $query = "SELECT * FROM usuarios WHERE id_usuario =?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        if ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $usuario = new self;
            $usuario->setIdUsuario($fila['id_usuario']);
            $usuario->setAlt($fila['alt']);
            $usuario->setEmail($fila['email']);
            $usuario->setImagen($fila['imagen']);
            $usuario->setNombre($fila['nombre']);
            $usuario->setPassword($fila['password']);

            return $usuario;
        }
        return null;
      /*  $res = mysqli_query($db, $query);

        return mysqli_fetch_assoc($res);*/
    }

    function usuariosEditar($id, $data)
    {
        $db = DBConnection::getConnection();


            $query = "UPDATE usuarios SET
                                    nombre = :nombre,
                                    email = :email,
                                    imagen = :imagen,
                                    alt = :alt
                                    WHERE id_usuario = :id";

            $stmt = $db->prepare($query);
            $exito = $stmt->execute([
                'id' => $id,
                'nombre' => $data['nombre'],
                'email' => $data['email'],
                'imagen' => $data['imagen'],
                'alt' => $data['imagen']
            ]);
            return $exito;
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
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
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
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getImagen1()
    {
        return $this->imagen1;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $imagen1
     */
    public function setImagen1($imagen1)
    {
        $this->imagen1 = $imagen1;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}