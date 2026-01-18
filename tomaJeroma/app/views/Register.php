<form action="index.php?Controller=Login&Action=auth" method="post">
    <label for="mail">Correo Electronico: </label>
    <input type="email" name="mail" id="mail">

    <label for="telfNumber">Numero de telefono: </label>
    <input type="number" name="telfNumber" id="telfNumber">

    <label for="pass">Contraseña: </label>
    <input type="password" name="pass" id="pass">

    <label for="passConf">Confirmar contraseña: </label>
    <input type="password" name="passConf" id="passConf">

    
    <input type="submit" value="Enviar">
</form>