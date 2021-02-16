<?php
/**
 * Decodifica el $base64 y lo guarda en el $path, con un nombre autogenerado o indicado con $filename.
 *
 * @param string $base64
 * @param string $path
 * @param null|string $filename
 * @return string
 */
function fileUploadBase64($base64, $path, $filename = null) {
    $fragmentos = explode(';base64,', $base64);
    $dataBase64 = $fragmentos[0]; // data:image/jpeg
    $imgBase64 = $fragmentos[1]; // /9j/4AAQSkZJRgABAQAA .....

    $tipoMIME = substr($dataBase64, 5);

    switch($tipoMIME) {
        case 'image/jpeg':
        case 'image/pjpeg':
            $extension = ".jpg";
            break;

        case 'image/png':
            $extension = ".png";
            break;

        case 'image/webp':
            $extension = ".webp";
            break;

        case 'image/gif':
            $extension = ".gif";
            break;

        default:
            // Lanzar error.
            $extension = ".jpg";
    }

    //si file name es null, sino date....
    $nombreImagen = $filename ?? date('YmdHis') . $extension;

    // Decodificamos el base64.
    // base64_decode decodificada el base64, y restaura el archivo original en *memoria*.
    $imagenDecodificada = base64_decode($imgBase64);

    // Ahora escribimos en disco la imagen.
    file_put_contents($path . $nombreImagen, $imagenDecodificada);

    return $nombreImagen;
}
