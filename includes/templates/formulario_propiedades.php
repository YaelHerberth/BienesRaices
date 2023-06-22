<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Titulo de la propiedad" value="<?= s($propiedad->titulo)?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio de la propiedad" value="<?= s($propiedad->precio) ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png" value="<?php $propiedad->imagen ?>">

    <?php if($propiedad->imagen): ?>
        <img class="imagen-small" src="../../Imagenes/<?= $propiedad->imagen ?>" alt="Vista previa">
    <?php endif ?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion"><?= s($propiedad->descripcion) ?></textarea>
</fieldset>
<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">Habitaciones:</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ejemplo: 3" min="1" max="9" value="<?= s($propiedad->habitaciones) ?>">

    <label for="wc">Baños:</label>
    <input type="number" name="propiedad[wc]" id="wc" placeholder="Ejemplo: 3" min="1" max="9" value="<?= s($propiedad->wc) ?>">

    <label for="estacionamiento">Estacionamientos:</label>
    <input type="number" name="propiedad[estacionamiento]" id="estacionamiento" placeholder="Ejemplo: 3" min="1" max="9" value="<?= s($propiedad->estacionamiento) ?>">
</fieldset>
<?php ?>
<fieldset>
    <legend>Vendedor</legend>
    
</fieldset>