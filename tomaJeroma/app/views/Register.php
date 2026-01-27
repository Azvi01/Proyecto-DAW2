<div class="grid place-content-center">
    <form class=" grid place-content-center fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 " action="index.php?controller=Register&action=auth" method="post">
    <legend class="fieldset-legend">Register</legend>
    <label class="label" for="mail">Correo Electronico: </label>
    <input class="input" type="email" name="mail" id="mail" required>

    <label class="label" for="telfNumber">Numero de telefono: </label>
    <input class="input" type="number" name="telfNumber" id="telfNumber" required>

    <label class="label" for="pass">Contraseña: </label>
    <input class="input" type="password" name="pass" id="pass" required>

    <label class="label" for="passConf">Confirmar contraseña: </label>
    <input class="input" type="password" name="passConf" id="passConf" required>


    <input class="btn btn-neutral mt-4" type="submit" value="Enviar">

    <p>Ya tienes una cuenta?</p>
    <a class='color-blue-900' href="index.php?controller=Login&action=index"> Inicia sesión aqui</a>
</form>
</div>