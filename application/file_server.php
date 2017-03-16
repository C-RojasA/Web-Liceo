<?php
$config = parse_ini_file('../../config.ini', true);
foreach($config as $seccion=>$array) {
    foreach($array as $constante=>$valor) {
        define($constante, $valor);
    }
}

$archivo = "../".DIR_FOTOS_NOTICIAS."{$_GET['f']}.jpg";

$archivo = (file_exists($archivo)) ? $archivo : "../".DIR_FOTOS_NOTICIAS."1.jpg" ;

        if (file_exists($archivo)) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $archivo);
            finfo_close($finfo);
            header("Content-Type : $mime");
            readfile($archivo);
        }
?>