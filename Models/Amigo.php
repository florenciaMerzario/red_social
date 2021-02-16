<?php
require_once '../api/DB/DBConnection.php';
use \api\DB\DBConnection;
class Amigo
{
    public $id;
    public $id_usuario;
    public $id_amigo;
    public $nombre;
    public $email;
    public $imagen;


    function traerPorPk($id)  // trae info de los amigos
    {
        $db = DBConnection::getConnection();
        $query = "SELECT amigos.id_amigo, amigos.id_usuario, usuarios.nombre,
                    usuarios.imagen, 
                    usuarios.email 
                    FROM amigos INNER JOIN usuarios 
                    WHERE amigos.id_usuario = :id 
                    AND usuarios.id_usuario = amigos.id_amigo
                    OR amigos.id_amigo = :id 
                    AND usuarios.id_usuario = amigos.id_usuario
                   ";

        $stmt = $db->prepare($query);
        $stmt->execute([
                'id' => $id
                ]);
        $salida = [];
        while($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new self;

            $obj->setIdUsuario($fila['id_usuario']);
            $obj->setIdAmigo($fila['id_amigo']);
            $obj->setEmail($fila['email']);
            $obj->setImagen($fila['imagen']);
            $obj->setNombre($fila['nombre']);

            // Lo agregamos al array de salida.
            $salida[] = $obj;
        }
        return $salida;
    }

    function validarExisteRelacion($id_usuario, $id_amigo)
    {
        $db = DBConnection::getConnection();
        $query = "SELECT * FROM amigos
                        WHERE amigos.id_usuario = :id_usuario
                        AND amigos.id_amigo = :id_amigo
                        OR amigos.id_amigo = :id_usuario 
                        AND amigos.id_usuario = :id_amigo
                        ";

        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'id_usuario' => $id_usuario,
            'id_amigo' => $id_amigo
        ]);
        $salida = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $obj = new Amigo;

            $obj->setIdUsuario($fila['id_usuario']);
            $obj->setIdAmigo($fila['id_amigo']);

            $salida[] = $obj;
        }
        return $salida;
        }


    function amigoCrear($postData)
    {
        $db = DBConnection::getConnection();

        $query = "INSERT INTO amigos (id_usuario, id_amigo)
                                  VALUES (:id_usuario, :id_amigo)";
        $stmt = $db->prepare($query);
        $exito = $stmt->execute([
            'id_usuario' => $postData['id_usuario'],
            'id_amigo' => $postData['id_amigo']
        ]);
    }

    function amigosEliminar($db, $postData) {
        $id_usuario          = mysqli_real_escape_string($db, $postData['id_usuario']);
        $id_amigo            = mysqli_real_escape_string($db, $postData['id_amigo']);

        $query = "DELETE FROM amigos
        WHERE id_usuario = $id_usuario AND id_amigo = $id_amigo
        OR id_usuario = $id_amigo AND id_amigo = $id_usuario    ";
        return mysqli_query($db, $query);
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
    public function getIdAmigo()
    {
        return $this->id_amigo;
    }

    /**
     * @param mixed $id_amigo
     */
    public function setIdAmigo($id_amigo)
    {
        $this->id_amigo = $id_amigo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
        
