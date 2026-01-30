<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toma Jeroma</title>

    <link rel="stylesheet" href="/css/style.css">
    <script src="./js/theme-switcher.js"></script>
</head>

<body class="overflow-hidden">
    <?php if (Session::get('error')): ?>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                document.getElementById("errorModal").showModal();
            });
        </script>
        <div>
            <dialog id="errorModal" class="modal text-xl">
                <div class="modal-box p-5">
                    <form method="dialog">
                        <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                            ✕
                        </button>
                    </form>
                    <?= Session::get('error') ?>
                    <?php Session::delete('error'); ?>
                </div>
            </dialog>
        </div>
    <?php endif; ?>

    <!--HEADER MENU -->
    <header class="navbar bg-base-300 shadow-sm">
        <div class="lg:navbar-start">
            <div class="drawer">
                <input id="my-drawer-1" type="checkbox" class="drawer-toggle" />
                <div class="drawer-content">
                    <label for="my-drawer-1" class="drawer-button">
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                    </label>
                </div>
                <div class="drawer-side">
                    <label for="my-drawer-1" aria-label="close sidebar" class="drawer-overlay"></label>
                    <ul class="menu bg-base-200 min-h-full w-80 p-4 text-2xl flex gap-5">
                        <li><a href="index.php?controller=Products">Inicio</a></li>
                        <li>
                            <a href="#">Categorias</a>
                            <ul class="menu">
                                <?php if ($categories): ?>
                                    <?php foreach ($categories as $category) : ?>
                                        <li><a href="index.php?controller=Products&action=showProductCategory&categoryId=<?= $category->getId(); ?>"><?= $category->getName(); ?></a></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </li>
                        <li><a href="index.php?controller=Products&action=showProductOffer">Ofertas</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- LOGIN -->
        <div class="navbar py-2 flex justify-between ">
            <?php if (Session::get('UserToken')) {
                $SesionMail = JWTToken::rescueMail(Session::get('UserToken'));
                echo "<a href='index.php?controller=Login&action=logout'>$SesionMail</a>";

                if (JWTToken::rescueUserRole(Session::get('UserToken')) === "admin") {
                    echo "<a href='index.php?controller=Admin&action=index'>Dashboard</a>";
                }
                
            } else {
                echo "<a href='index.php?controller=Login&action=index'>Login</a>";
            } ?>
        </div>
        <!--HEADER lOGO -->
        <div class="navbar py-2">
            <a href="index.php?controller=Products">
                <img class="w-25 h-15 " src="./img/logo-sin-fondo.png" />
            </a>
        </div>
        <!--HEADER  BUSQUEDA Y CARRITO -->
        <div class="navbar-center  ">
            <!--HEADER BUSQUEDA -->
            <button class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>
            <form action="index.php?controller=Products&action=search" method="post">
                <input class="input" type="text" placeholder="buscar producto" name="buscar" />
            </form>
            <!--HEADER CARRITO -->
            <button class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <a href="index.php?controller=cart&action=chekLogin">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" class="w-5 h-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1" />
                            <circle cx="20" cy="21" r="1" />
                            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                        </svg>
                        <span class="badge badge-xs badge-primary indicator-item"><?php
                            $carrito = Session::get("Carrito") ?? [];
                            if (count($carrito) > 9) {
                                echo "+9";
                            } else {
                                echo count($carrito);
                            }
                            ?>
                        </span>
                    </a>
                </div>
            </button>
            <!-- BOTON COLOR-->
            <label class="swap swap-rotate">
                <!-- this hidden checkbox controls the state -->
                <input type="checkbox" class="theme-controller" value="dark" />
                <!-- sun icon -->
                <svg
                    class="swap-off h-6 w-6 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                </svg>
                <!-- moon icon -->
                <svg
                    class="swap-on h-6 w-6 fill-current"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24">
                    <path
                        d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                </svg>
            </label>
        </div>
    </header>

    <div class="flex flex-col gap-3 h-dvh overflow-scroll">
        <main class="flex-1 block">
            <?= $content ?>
        </main>


        <footer>
            <footer class="footer footer-horizontal footer-center bg-base-300 text-base-content rounded p-10">
                <nav class="grid grid-flow-col gap-4">
                    <a class="link link-hover">About us</a>
                    <a class="link link-hover">Contact</a>
                    <a class="link link-hover">Jobs</a>
                    <a class="link link-hover">Press kit</a>
                </nav>
                <nav>
                    <div class="grid grid-flow-col gap-4">
                        <a class="hover:text-cyan-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                            </svg>
                        </a>
                        <a class="hover:text-red-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                            </svg>
                        </a>
                        <a class="hover:text-blue-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                class="fill-current">
                                <path
                                    d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                            </svg>
                        </a>
                    </div>
                </nav>
                <aside>
                    <p>Copyright © {new Date().getFullYear()} - All right reserved by ACME Industries Ltd</p>
                </aside>
            </footer>
        </footer>
    </div>
</body>

</html>