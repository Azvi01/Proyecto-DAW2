<?php if (empty($product)): ?>
    <div class="text-center py-20">
        <h1 class="text-2xl font-bold opacity-50">Vaya, parece que el carrito está vacío. Echa un vistazo a la web y compra algo.</h1>
    </div>
<?php else: ?>
    <div class="flex flex-col lg:flex-row gap-8">
        
        <div class="grow">
            <ul class="list bg-base-100 rounded-box shadow-md">
                <li class="p-4 pb-2 text-xl opacity-60 tracking-wide border-b border-base-200">Objetos en el carrito</li>

                <?php 
                $subtotalGeneral = 0;
                foreach ($product as $item): 
                    $id = $item->getIdProduct();
                    $carrito = Session::get('Carrito');
                    $cantidad = $carrito[$id]['cantidad'];
                    $precioFinal = $item->getFinalPrice();
                    $subtotalGeneral += ($precioFinal * $cantidad);
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
                            <div class="text-base font-bold text-primary"><?= $precioFinal ?> €</div>
                            <?php if ($item->hasOffer()): ?>
                            <div class="text-sm line-through decoration-red-500 opacity-50"><?= $item->getBasePriceProduct() ?> €</div>
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
        </div>

        <div class="lg:w-96">
            <div class="card bg-base-100 shadow-md border border-base-200">
                <div class="card-body">
                    <h2 class="card-title text-xl mb-4 border-b pb-2">Resumen del pedido</h2>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span><?= number_format($subtotalGeneral, 2) ?> €</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Envío</span>
                            <span class="text-success font-medium">Gratis</span>
                        </div>
                        
                        <div class="divider"></div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold">Total</span>
                            <span class="text-2xl font-extrabold text-primary"><?= number_format($subtotalGeneral, 2) ?> €</span>
                        </div>
                    </div>

                    <div class="card-actions mt-6">
                        <form action="index.php?controller=Pedido&action=checkout" method="POST" class="w-full">
                            <button type="submit" class="btn btn-primary btn-block text-lg">
                                Realizar Pedido
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="index.php" class="link link-hover text-sm opacity-70 italic">Continuar comprando</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php endif; ?>