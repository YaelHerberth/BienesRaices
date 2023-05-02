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
    <header class="header <?php //echo $inicio ? 'inicio' : ''; ?>">
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
        <h1>Borrar</h1>
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