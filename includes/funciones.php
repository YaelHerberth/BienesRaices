<?php
// require 'app.php';

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/{$nombre}.php";
}

function estaAutenticado()
{
    session_start();
    
    if(!$_SESSION['login']){
        header('Location: ../index.php');
        return $auth = false;
    }
    return $auth = true;
}

function debuguear($variable){
    var_dump($variable);
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}