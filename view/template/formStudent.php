<form id="student">
    <h2>Datos del estudiante</h2>
    <div class="content-input">
        <label for="userName">Nombre de usuario</label>
        <input type="text" name="userName" id="userName" required pattern="^\S+$">
        <span></span>
    </div>

    <div class="content-input">
        <label for="groupID">Seleccione un grupo (opcional)</label>
        <select name="groupID" id="groupID">
            <option value="">Aun no tienes grupos</option>
        </select>
    </div>
    <div class="content-input">
        <label for="birthDate">Fecha de nacimiento</label>
        <input type="date" name="birthDate" id="birthDate" required>
        <span></span>
    </div>
    <div class="content-input">
        <p>Sexo</p>
        <div>
            <input type="radio" name="gender" id="sex" value="Masculino" required>
            <label for="sex">Masculino</label>
        </div>
        <div>
            <input type="radio" name="gender" id="sex1" value="Femenino">
            <label for="sex1">Femenino</label>
        </div>
    </div>
    <div class="content-input">
        <label for="password"><?php echo ($action == 'Actualizar') ? 'Si desea cmabiar la contraseña escribala, de lo contrario puede omitirla' : 'Contraseña'; ?></label>
        <input type="password" name="password" id="password" <?php echo ($action == 'Actualizar') ? '' : 'required'; ?>>
        <span></span>
    </div>
    <div class="content-input">
        <label for="password-2">Repetir contraseña</label>
        <input type="password" name="password-2" id="password2" <?php echo ($action == 'Actualizar') ? '' : 'required'; ?>>
        <span></span>
    </div>
    <button type="submit"><?php echo $action; ?></button>
</form>