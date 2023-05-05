<?php

require '../includes/funciones.php';
$auth = estaAutenticado();

if (!$auth) {
    header('Location: ../index.php');
}

// Importar la conexion
require '../includes/config/database.php';
$db = conectarDB();

//Escribir el Query
$query = "SELECT * FROM propiedades";

//Consultar la base de datos
$resultadoConsulta = mysqli_query($db, $query);

// var_dump($_GET);
$resultado = $_GET['resultado'] ?? null; // Las ?? Sirve para asignarle un valor a la variable si esta no tinene un valor definido

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) {
        //Eliminar el archivo
        $query = "SELECT imagen FROM propiedades WHERE id = {$id}";

        $resultado = mysqli_query($db, $query);
        $propiedad = mysqli_fetch_assoc($resultado);

        unlink('../Imagenes/' . $propiedad['imagen']);

        //Eliminar el registro
        $query = "DELETE FROM propiedades WHERE id = {$id}";
        $resultado  = mysqli_query($db, $query);

        if ($resultado) {
            header('Location: /BienesRaices/admin/index.php?resultado=3');
            // require '/wamp64/www/BienesRaices/admin/index.php';
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
                        <?php if($auth): ?>
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
                <?php while ($propiedad = mysqli_fetch_assoc($resultadoConsulta)) : ?>
                    <tr>
                        <td><?= $propiedad['id'] ?></td>
                        <td><?= $propiedad['titulo'] ?></td>
                        <td><img class="imagen-tabla" src="../Imagenes/<?= $propiedad['imagen'] ?>" alt="Casa en la playa"></td>
                        <td><?= $propiedad['precio'] ?></td>
                        <td>
                            <form class="w-100" method="POST" action="">
                                <input type="hidden" name="id" value="<?= $propiedad['id'] ?>">
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>
                            <a href="propiedades/actualizar.php?id=<?= $propiedad['id'] ?>" class="boton-amarillo-block">Actualizar</a>
                        </td>
                    </tr>
                <?php endwhile ?>
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