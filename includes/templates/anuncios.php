<?php
// Importar la base de datos
// require __DIR__ . '/../config/database.php';
$db = conectarDB();

// Consultar
$query = "SELECT * FROM propiedades LIMIT {$limite}";

// Obtener los resultados
$resultado = mysqli_query($db,$query);
?>




<div class="contenedor-anuncios">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="anuncio">

        <img loading="lazy" src="Imagenes/<?= $propiedad['imagen'] ?>" alt="Anuncio">

        <div class="contenido-anuncio">
            <h3><?= $propiedad['titulo'] ?></h3>
            <p><?= $propiedad['descripcion'] ?></p>
            <p class="precio">$<?= $propiedad['precio'] ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p><?= $propiedad['wc'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                    <p><?= $propiedad['estacionamiento'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                    <p><?= $propiedad['habitaciones'] ?></p>
                </li>
            </ul>
            <a href="anuncio.php?id=<?= $propiedad['id']  ?>" class="boton-amarillo-block">Ver propiedad</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<?php
// Cerrar la conexion
mysqli_close($db);
?>