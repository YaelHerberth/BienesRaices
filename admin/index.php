<?php

require '../includes/app.php';
$auth = estaAutenticado();

use App\Propiedad;
use App\Vendedor;

// Implementar un metodo para obtener todas las propiedades
$propiedades = Propiedad::all();

// Implementar un metodo para obtener todos los vendedores
$vendedores = Vendedor::all();

$resultado = $_GET['resultado'] ?? null; // Las ?? Sirve para asignarle un valor a la variable si esta no tinene un valor definido

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {

        $tipo = $_POST['tipo'];

        if (validarTipoContenido($tipo)) {

            // Comparar lo que se va eliminar
            if ($tipo === 'propiedad') {
                // Obtener los datos de la propiedad
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
            } else if ($tipo == 'vendedor') {
                // Obtener los datos de vendedores
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
            }
        }
    }
}
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php
    $mensaje = mostrarNotificacion(intval($resultado));
    if ($mensaje) : ?>
    <p class="alerta exito"><?= s($mensaje) ?></p>
    <?php endif ?>

    <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
    <a href="vendedores/crear.php" class="boton boton-azul">Nuevo Vendedor</a>
    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?= $propiedad->id ?></td>
                    <td><?= $propiedad->titulo ?></td>
                    <td><img class="imagen-tabla" src="../Imagenes/<?= $propiedad->imagen ?>" alt="Casa en la playa"></td>
                    <td><?= $propiedad->precio ?></td>
                    <td>
                        <form class="w-100" method="POST" action="">
                            <input type="hidden" name="id" value="<?= $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="propiedades/actualizar.php?id=<?= $propiedad->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="vendedores">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td><?= $vendedor->id ?></td>
                    <td><?= $vendedor->nombre . ' ' . $vendedor->apellido ?></td>
                    <td><?= $vendedor->telefono ?></td>
                    <td>
                        <form class="w-100" method="POST" action="">
                            <input type="hidden" name="id" value="<?= $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="vendedores/actualizar.php?id=<?= $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</main>

<?php incluirTemplate('footer'); ?>