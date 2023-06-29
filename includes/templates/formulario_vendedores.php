<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre Vendedor(a)" value="<?= s($vendedor->nombre)?>">
    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido Vendedor(a)" value="<?= s($vendedor->apellido)?>">
    
</fieldset>

<fieldset>
    <legend>Información extra</legend>
    <label for="telefono">Telefono:</label>
    <input type="number" name="vendedor[telefono]" id="telefono" placeholder="Telefono Vendedor(a)" value="<?= s($vendedor->telefono)?>">
</fieldset>