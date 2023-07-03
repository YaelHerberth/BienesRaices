<?php
require '../../includes/app.php';

use App\Propiedad;
use App\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
// var_dump($id);

if (!$id) {
    header('Location: ../index.php');
}

// Obtener los datos de la propiedad
$propiedad = Propiedad::find($id);

// Consulta para obtener todos los vendedores
$vendedores = Vendedor::all();

// Arreglo con mensaje de errores
$errores = Propiedad::getErrores();


// Ejecutar el codigo despues de que el usuario envia el formulario
// var_dump($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    // Validacion 
    $errores = $propiedad->validar();

    // Subida de archivos
    //Generar un nombre unico
    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';


    if (empty($errores)) {

        // Almacenar la imagen
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
            $propiedad->setImagen($nombreImagen);
            $image->save(CARPETA_IMAGENES . $nombreImagen);
        }

        $propiedad->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>
    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include "../../includes/templates/formulario_propiedades.php" ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
    </form>
</main>

<?php incluirTemplate('footer'); ?>