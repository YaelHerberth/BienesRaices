<?php

require 'includes/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en venta en frente del bosque</h1>
    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio">$3,000,000</p>
        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Habitaciones">
                <p>4</p>
            </li>
        </ul>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, doloremque omnis? Pariatur
            repudiandae
            labore, eum ullam exercitationem placeat libero officia. Perspiciatis impedit autem error veritatis
            distinctio id fuga vero minus.
            Veniam culpa dolores cumque est ex vero! Provident repudiandae ex aliquid distinctio architecto
            sapiente
            animi maxime, expedita molestias vel porro non! Aliquam officia facilis perferendis quia ex
            voluptate
            fugiat omnis.
            Quaerat exercitationem distinctio perspiciatis eligendi, illo deleniti ab unde facere numquam rem
            minus
            esse consequuntur aut reiciendis velit dignissimos, nulla obcaecati ratione nobis aperiam. Fuga
            aliquam
            harum esse dolore repellat.</p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea libero laudantium commodi illo facilis.
            Possimus, ipsa nobis tenetur similique blanditiis vitae consequuntur! Fuga neque quod ea ipsa
            temporibus a amet.</p>
    </div>
</main>

<?php
    incluirTemplate('footer');
?>