<?php


class usuariosListado
{
    public $id_usuario;
    public $nombre;
    public $email;
    public $password;
    public $imagen;
    public $alt;

    function traerTodos($db)
    {
        $query = "SELECT * from usuarios";
        $res = mysqli_query($db, $query);

        $query = "SELECT usuarios.nombre, usuario.fecha, mensajes.mensaje, mensajes.fecha
                  from usuarios 
                  INNER JOIN mensajes ON usuarios.id_usuario = mensajes.id_usuario 
                  order by usuarios.nombre";
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
        $query = "SELECT usuarios.nombre, usuarios.imagen, mensajes.mensaje, mensajes.fecha
        FROM usuarios
        INNER JOIN mensajes ON usuarios.id_usuario = mensajes.id_usuario";

        $res = mysqli_query($db, $query);

        return mysqli_fetch_assoc($res);

    }

    function mensajesPorUsuario($id)
    {
        $db = DBConnection::getConnection();

        $id = (int)$id; //en vez de hacer la inyeccion sql
        $query = "SELECT * FROM mensajes WHERE mensajes.id_usuario = ?";


        $stmt = $db->prepare($query);
        $stmt->execute([$id]);

        $salida = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $obj = new self;

            $obj->setNombre($fila['nombre']);
            $obj->setImagen($fila['imagen']);
            $obj->setEmail($fila['email']);
            $obj->setAlt($fila['alt']);
            $obj->setIdUsuario($fila['id_usuario']);

            $salida[] = $obj;
        }
        return $salida;
       /* $res = mysqli_query($db, $query);

        $salida = [];

        while ($fila = mysqli_fetch_assoc($res)) {
            $salida[] = $fila;
        }
        return $salida;*/

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
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $alt
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getAlt()
    {
        return $this->alt;
    }
}