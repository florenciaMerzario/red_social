<?php
function usuariosTodos($db) {
    $query = "SELECT * FROM usuarios";

    $res = mysqli_query($db, $query);

    $salida = [];

    while($fila = mysqli_fetch_assoc($res)) {
        $salida[] = $fila;
    }

    return $salida;
}
