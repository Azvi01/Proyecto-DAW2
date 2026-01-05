<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="index.php?Controller=Login&Action=auth" method="post">
        <label for="mail">Correo Electronico: </label>
        <input type="email" name="mail" id="mail">

        <label for="pass">Contraseña: </label>
        <input type="password" name="pass" id="pass">

        <input type="submit" value="Enviar">
    </form>
</body>
</html>