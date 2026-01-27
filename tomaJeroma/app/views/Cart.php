<?php if (empty($product)): ?>
    <div class="text-center py-20">
        <h1 class="text-2xl font-bold opacity-50">Vaya, parece que el carrito está vacío. Echa un vistazo a la web y compra algo.</h1>
    </div>
<?php else: ?>

    <ul class="list bg-base-100 rounded-box shadow-md">
        <li class="p-4 pb-2 text-xl opacity-60 tracking-wide border-b border-base-200">Objetos en el carrito</li>

        <?php foreach ($product as $item): 
            $id = $item->getIdProduct();
            $carrito = Session::get('Carrito');
            $cantidad = $carrito[$id]['cantidad'];
        ?>
            <li class="list-row items-center gap-6 py-6 px-4 group rounded-2xl transition-all duration-300 hover:bg-base-200">
                <div>
                    <img
                        src="<?= $item->getImgProduct() ?>"
                        alt="<?= $item->getNameProduct() ?>"
                        class="w-20 h-20 rounded-xl object-cover transition-transform duration-300 group-hover:scale-105">
                </div>

                <div class="list-col-grow">
                    <div class="text-lg font-semibold"><?= $item->getNameProduct() ?></div>
                    <div class="text-base font-bold text-primary"><?= $item->getFinalPrice() ?> €</div>
                    <?php if ($item->hasOffer()): ?>
                    <div class="text-sm line-through decoration-red-500"><?= $item->getBasePriceProduct() ?></div>
                    <?php endif;?>
                </div>

                <div class="flex items-center gap-4">
                    <div class="join border border-base-300">
                        <form action="index.php?controller=Cart&action=removeOne" method="POST" class="inline">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" class="btn btn-ghost join-item btn-sm <?= $cantidad <= 1 ? 'btn-disabled' : '' ?>">-</button>
                        </form>

                        <span class="px-4 py-1 bg-base-100 flex items-center font-mono"><?= $cantidad ?></span>

                        <form action="index.php?controller=Cart&action=addOne" method="POST" class="inline">
                            <input type="hidden" name="id" value="<?= $id ?>">
                            <button type="submit" class="btn btn-ghost join-item btn-sm">+</button>
                        </form>
                    </div>

                    <form action="index.php?controller=Cart&action=deleteProductToCart" method="POST" class="inline">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button type="submit" class="btn btn-error btn-outline btn-sm sm:btn-square" title="Eliminar producto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>