<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiauGuauTech</title>
</head>
<body>
    <h1>MiauGuau-Tech</h1>

    <?php
        $password = "1234";
        $hash = password_hash($password, PASSWORD_DEFAULT);

        echo $hash;
    ?>
</body>
</html>