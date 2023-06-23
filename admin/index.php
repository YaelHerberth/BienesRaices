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

        // Obtener los datos de la propiedad
        $propiedad = Propiedad::find($id);

        $propiedad->eliminar();
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
    <link rel="stylesheet" href="../build/css/app.css">
</head>

<body>
    <header class="header">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="index.php">
                    <img src="../build/img/logo.svg" alt="Logotipo de Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="../build/img/barras.svg" alt="Icono menu responsive">
                </div>
                <div class="derecha">
                    <img class="dark-mode-boton" src="../build/img/dark-mode.svg" alt="Modo Oscuro">
                    <nav class="navegacion">
                        <a href="../nosotros.php">Nosotros</a>
                        <a href="../anuncios.php">Anuncios</a>
                        <a href="../blog.php">Blog</a>
                        <a href="../contacto.php">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="../cerrar-sesion.php">Cerrar Sesión</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div>
        </div>
    </header>

    <main class="contenedor seccion">
        <h1>Administrador de Bienes Raices</h1>
        <?php if (intval($resultado) == 1) : ?>
            <p class="alerta exito">Anuncio Creado Correctamente</p>
        <?php elseif (intval($resultado) == 2) : ?>
            <p class="alerta exito">Anuncio Actualizado Correctamente</p>
        <?php elseif (intval($resultado) == 3) : ?>
            <p class="alerta exito">Anuncio Eliminado Correctamente</p>
        <?php endif ?>
        <a href="propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>
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
                        <td><?= $vendedor->nombre . ' ' .$vendedor->apellido ?></td>
                        <td><?= $vendedor->telefono ?></td>
                        <td>
                            <form class="w-100" method="POST" action="">
                                <input type="hidden" name="id" value="<?= $vendedor->id ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="vendedores/actualizar.php?id=<?= $vendedor->id ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    </main>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
            </nav>
        </div>
        <p class="copyright">Todos los Derechos Reservados <?= date('Y'); ?> &copy;</p>
    </footer>

    <script src="../build/js/bundle.min.js"></script>
    <script></script>
</body>

</html>

<?php
mysqli_close($db);
?>