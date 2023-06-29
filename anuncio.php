<?php
require 'includes/app.php';
use App\Propiedad;

// Consultar
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: /');
}

$propiedad = Propiedad::find($id);

if(!$propiedad){
    header('Location: index.php');
}

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?= $propiedad->titulo ?></h1>
    <picture>
        <img loading="lazy" src="Imagenes/<?= $propiedad->imagen ?>" alt="Imagen de la propiedad">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio"><?= $propiedad->precio ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                <p><?= $propiedad->wc ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                <p><?= $propiedad->estacionamiento ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                <p><?= $propiedad->habitaciones ?></p>
            </li>
        </ul>
        <p><?= $propiedad->descripcion ?></p>


    </div>
</main>

<?php
    incluirTemplate('footer');
?>