<form id="group">
    <h2>Datos del grupo</h2>
    <div class="content-input">
        <label for="nameGroup">Nombre de grupo</label>
        <input type="text" name="name" id="nameGroup">
        <span></span>
    </div>
    <div class="content-input">
        <label for="descriptionGroup">Descripcion del grupo</label>
        <textarea name="description" id="descriptionGroup"></textarea>
    </div>
    <button type="submit"><?php echo $action;?></button>
</form>