<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$propiedad = new Propiedad();

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

// Arreglo con mensaje de errores
$errores = Propiedad::getErrores();

// Ejecutar el codigo despues de que el usuario envia el formulario
// var_dump($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Crea una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    /* Subida de archivos */
    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';

    // Setear la imagen
    // Realiza un resize a la imagen con intervention
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    // Validar
    $errores = $propiedad->validar();


    // Revisar que no contenga ningun error almacenado en el arreglo de errores
    if (empty($errores)) {

        // Crear la carpeta para subir imagenes
        if (!is_dir(CARPETA_IMAGENES)) {
            mkdir(CARPETA_IMAGENES);
        }

        // Guardar la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        // Guardar en la base de datos
        $propiedad->guardar();
    }
}

incluirTemplate('header')
?>

<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>
    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach ?>

    <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">

        <?php include "../../includes/templates/formulario_propiedades.php" ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>