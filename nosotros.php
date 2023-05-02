<?php

require 'includes/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Conoce Sobre Nosotros</h1>
    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="img/webp">
                <source srcset="build/img/nosotros.jpg" type="img/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>25 años de experiencia</blockquote>
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
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>
    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono Seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ipsa, officia aspernatur
                sapiente rerum corporis quis consequuntur? Accusamus ipsam deserunt nobis. Ipsam, quos. Hic placeat
                voluptas animi numquam ad fugiat.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ipsa, officia aspernatur
                sapiente rerum corporis quis consequuntur? Accusamus ipsam deserunt nobis. Ipsam, quos. Hic placeat
                voluptas animi numquam ad fugiat.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae ipsa, officia aspernatur
                sapiente rerum corporis quis consequuntur? Accusamus ipsam deserunt nobis. Ipsam, quos. Hic placeat
                voluptas animi numquam ad fugiat.</p>
        </div>
    </div>
</section>


<?php
    incluirTemplate('footer');
?>