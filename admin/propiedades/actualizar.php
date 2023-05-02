<?php


$id = $_GET['id'];
$id = filter_var($id,FILTER_VALIDATE_INT);
// var_dump($id);

if(!$id){
    header('Location: ../index.php');
}

require '../../includes/config/database.php';
$db = conectarDB();

$consulta = 'SELECT * FROM propiedades WHERE id = '.$id.'';
echo 'SELECT * FROM propiedades WHERE id = $id';
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);
// var_dump($propiedad);

//Consultar para obtener a los vendedores
$consulta = 'SELECT * FROM vendedores';
$resultado = mysqli_query($db, $consulta);

// Arreglo con mensaje de errores
$errores = [];

$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
// $imagen = '';
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamientos = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];

// Ejecutar el codigo despues de que el usuario envia el formulario
// var_dump($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //mysqli_real_escape_string sirve para que a las variables no le inyecten codigo SQL o algun tipo de inyección
    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamientos = mysqli_real_escape_string($db, $_POST['estacionamientos']);
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);
    $creado = date('Y/m/d');

    $imagen = $_FILES['imagen'];

    //  var_dump($imagen);

    // exit;

    if (!$titulo) {
        $errores[] = 'Debes añadir un titulo';
    }
    if (!$precio) {
        $errores[] = 'Debes añadir un precio';
    }
    if (strlen($descripcion) < 50) {
        $errores[] = 'Debes añadir una descripcion y debe tener al menos 50 caracteres';
    }
    if (!$habitaciones) {
        $errores[] = 'Debes añadir el numero de habitaciones';
    }
    if (!$wc) {
        $errores[] = 'Debes añadir el numero de baños';
    }
    if (!$estacionamientos) {
        $errores[] = 'Debes añadir el numero de estacionamientos';
    }
    if (!$vendedorId) {
        $errores[] = 'Debes elegir un vendedor';
    }
    if(!$imagen['name'] || $imagen['error']){
        $errores[] = 'La imagen es obligatoria';
    }

    //Valida por tamaño 
    if($imagen['size'] > 1000000){
        $errores[] = 'La imagen es muy pesada';
    }

    // var_dump($errores);
    // exit;

    // Revisar que no contenga ningun error almacenado en el arreglo de errores

    if (empty($errores)) {
        /* SUBIDA DE ARCHIVOS */

        // Crear Carpeta
        $carpetaImagenes = '../../Imagenes/';

        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        //Generar un nombre unico
        $nombreImagen = md5(uniqid(rand(),true)) . '.jpg';

        // Subir la iamgen
        move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);

        //Insertar en la base de datos
        $query = "INSERT INTO propiedades(titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) 
        VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamientos', '$creado', '$vendedorId')";

        // echo $query;

        $resultado = mysqli_query($db, $query);

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
    <header class="header">
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
                    </nav>
                </div>

            </div>
        </div>
    </header>

    <main class="contenedor seccion">
        <h1>Actualizar Propiedad</h1>
        <a href="../index.php" class="boton boton-verde">Volver</a>

        <?php foreach ($errores as $error) : ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach ?>

        <form class="formulario" method="POST" action="crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" name="titulo" id="titulo" placeholder="Titulo de la propiedad" value="<?= $titulo ?>">

                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" placeholder="Precio de la propiedad" value="<?= $precio ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" name="imagen" 
                id="imagen" accept="image/jpeg, image/png" value="<?php  ?>">

                <img class="imagen-small" src="../../Imagenes/<?= $imagenPropiedad ?>" alt="Vista previa">

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion" id="descripcion"><?= $descripcion ?></textarea>
            </fieldset>
            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" name="habitaciones" id="habitaciones" placeholder="Ejemplo: 3" min="1" max="9" value="<?= $habitaciones ?>">

                <label for="wc">Baños:</label>
                <input type="number" name="wc" id="wc" placeholder="Ejemplo: 3" min="1" max="9" value="<?= $wc ?>">

                <label for="estacionamientos">Estacionamientos:</label>
                <input type="number" name="estacionamientos" id="estacionamientos" placeholder="Ejemplo: 3" min="1" max="9" value="<?= $estacionamientos ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor" id="vendedor">
                    <option value="">--Seleccione--</option>
                    <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                        <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ''; ?> value="<?= $vendedor['id'] ?>">
                            <?= $vendedor['nombre'] . ' ' . $vendedor['apellido'] ?>
                        </option>
                    <?php endwhile ?>
                </select>
            </fieldset>
            <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">
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