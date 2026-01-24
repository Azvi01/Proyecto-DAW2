<div class="grid gap-4 px-4  
    grid-cols-2
    sm:grid-cols-3
    md:grid-cols-4
    lg:grid-cols-5
    xl:grid-cols-6">
    <h1 class="text-3xl text-content font-bold col-span-full">Productos</h1>

    <?php if (isset($error)): ?>

        <div role="alert" class="alert alert-error">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span><?= $error ?></span>
        </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <a href="index.php?controller=Products&action=show&id=<?= $product->getIdProduct() ?>"
                class="card bg-neutral-content border border-base-300 hover:shadow-lg transition w-full max-w-xs mx-auto">
                <figure class="h-40 flex items-center justify-center p-3 bg-white">
                    <img
                        src="<?= $product->getImgProduct() ?>"
                        alt="<?= $product->getNameProduct() ?>"
                        class="max-h-full object-contain" />
                </figure>

                <div class="card-body p-3 gap-2 text-neutral flex flex-col">

                    <h2 class="text-sm font-semibold leading-tight line-clamp-2 min-h-10">
                        <?= $product->getNameProduct() ?>
                    </h2>

                    <?php if ($product->hasOffer()): ?>
                        <span class="badge badge-secondary badge-sm w-fit">
                            <?= $product->getOffer() ?>
                        </span>
                    <?php endif; ?>

                    <span class="badge badge-outline badge-sm w-fit">
                        <?= $product->getNameCategory() ?>
                    </span>

                    <!-- PRECIO SIEMPRE ABAJO -->
                    <div class="mt-auto pt-2 flex items-center gap-2">
                        <?php if ($product->hasOffer()): ?>
                            <span class="text-sm line-through decoration-red-500">
                                <?= $product->getBasePriceProduct() ?> €
                            </span>
                        <?php endif; ?>

                        <span class="text-lg font-bold text-primary">
                            <?= $product->getFinalPrice() ?> €
                        </span>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>

    <?php endif; ?>
</div>