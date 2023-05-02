<?php

require 'includes/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor seccion">
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen de contacto">
    </picture>
    <h2>Llene el formulario de contacto</h2>
    <form class="formulario" action="">
        <fieldset>
            <legend>Información personal</legend>

            <label for="nombre">Nombre:</label>
            <input type="text" placeholder="Tu Nombre" id="nombre">

            <label for="email">E-Mail:</label>
            <input type="email" placeholder="Tu Correo Electrónico" id="email">

            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono">

            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre Propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select name="opciones" id="opciones">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto">
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado:</p>
            <div class="forma-contacto">
                <label for="">Telefono</label>
                <input type="radio" value="Telefono" id="contactar-telefono" name="contacto">

                <label for="">E-Mail</label>
                <input type="radio" value="Email" id="contactar-email" name="contacto">
            </div>

            <p>Si elegió teléfono, elija la fecha y la hora para ser contactado</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha">

            <label for="telefono">Hora:</label>
            <input type="time" id="telefono" min="09:00" max="18:00">
        </fieldset>

        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>

<?php
    incluirTemplate('footer');
?>