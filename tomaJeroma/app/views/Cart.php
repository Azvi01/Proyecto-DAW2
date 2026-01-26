<?php 


if (empty(Session::get('Carrito'))): ?>
    <h1>Vaya, parece que el carrito esta vacio. Echa un vistazo a la web y compra algo.</h1>

<?php else : ?>
    <ul class="list bg-base-100 rounded-box shadow-md ">
        <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Objetos en el carrito</li>
        <?= print_r(Session::get('Carrito')) ?>
        <?php foreach (Session::get('Carrito') as $product):  ?>

            <li class="list-row">
                <div class="text-4xl font-thin opacity-30 tabular-nums"></div>
                <div><img
                        src="<?= $product->getImgProduct() ?>"
                        alt="<?= $product->getNameProduct() ?>"
                        class="size-10 rounded-box"></div>
                <div class="list-col-grow">
                    <div><?= $product->getNameProduct()?></div>
                    <div class="text-xs uppercase font-semibold opacity-60"><?= $product->getBasePriceProduct()?></div>
                </div>
                <button class="btn btn-square btn-ghost">
                    <svg class="size-[1.2em]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <g stroke-linejoin="round" stroke-linecap="round" stroke-width="2" fill="none" stroke="currentColor">
                            <path d="M6 3L20 12 6 21 6 3z"></path>
                        </g>
                    </svg>
                </button>
            </li>

        <?php endforeach; ?>
    <?php endif; ?>
</ul>
