<?php
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();

$vendedor = new Vendedor();
// debuguear($vendedor);


// Arreglo con mensaje de errores
$errores = Vendedor::getErrores();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);
    
    // Validar que no haya objetos vacios
    $errores = $vendedor->validar();

    // No hay errores
    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header')
?>


<main class="contenedor seccion">
    <h1>Crear Vendedor(a)</h1>

    <a href="../index.php" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>

    <?php endforeach ?>

    <form class="formulario" method="POST" action="crear.php">

        <?php include "../../includes/templates/formulario_vendedores.php" ?>

        <input type="submit" value="Crear Vendedor(a)" class="boton boton-verde">
    </form>


</main>

<?php incluirTemplate('footer') ?>