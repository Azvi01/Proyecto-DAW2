<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiauGuauTech</title>

    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <header class="cabezera">
        <div class="ladoIzquierdo">
            <div class="logo">
                <img src="./img/logo-sin-fondo.png" alt="Logo" class="logoImg">
            </div>
            <nav>
                <a href="#">Inicio</a>
                <a href="">Ofertas</a>
            </nav>
        </div>

        <div class="ladoDerecho">
            <div class="barraBusqueda">
                <i class="bi bi-search"></i>
                <input type="text" placeholder="Buscar...">
            </div>
            <div class="accesibilidad">
                <p>🛒</p>
                <label for="menuPerfil" class="perfil">
                    U
                </label>
                <input type="checkbox" name="" id="menuPerfil">
                <nav class="menuPerfil">
                    <ul>
                        <li>Cerrar sesion</li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    

    <main>
        <?= $content ?>
    </main>

    <footer>

    </footer>
</body>
</html>