<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;


estaAutenticado();
$db = conectarDB();

$propiedad = new Propiedad();

//Consultar para obtener a los vendedores
$consulta = 'SELECT * FROM vendedores';
$resultadoo = mysqli_query($db, $consulta);

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
    if($_FILES['propiedad']['tmp_name']['imagen']){
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
        $resultado = $propiedad->guardar();

        // Mensaje de exito o error
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /BienesRaices/admin/index.php?resultado=1');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="../../build/css/app.css">
</head>

<body>
    <header class="header <?php //echo $inicio ? 'inicio' : ''; 
                            ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="../../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="../../build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="../../build/img/dark-mode.svg" alt="Modo Oscuro">
                    <nav class="navegacion">
                        <a href="../../nosotros.php">Nosotros</a>
                        <a href="../../anuncios.php">Anuncios</a>
                        <a href="../../blog.php">Blog</a>
                        <a href="../../contacto.php">Contacto</a>
                        <?php $auth = true;
                        if ($auth) : ?>
                            <a href="../cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div>
        </div>
    </header>

    <main class="contenedor seccion">
        <h1>Crear</h1>
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

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="../../nosotros.php">Nosotros</a>
                <a href="../../anuncios.php">Anuncios</a>
                <a href="../../blog.php">Blog</a>
                <a href="../../contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los Derechos Reservados <?= date('Y'); ?> &copy;</p>
    </footer>

    <script src="../../build/js/bundle.min.js"></script>
</body>

</html>