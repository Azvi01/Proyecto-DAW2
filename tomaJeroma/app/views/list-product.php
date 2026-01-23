
<h1 class="text-3xl text-content font-bold col-span-full">Productos</h1>

<?php foreach ($products as $product): ?>
<a href="index.php?controller=Products&action=show&id=<?= $product->getIdProduct() ?>" 
    class="card bg-neutral-content border border-base-300 hover:shadow-lg transition w-full max-w-xs mx-auto"
>
    <figure class="h-40 flex items-center justify-center p-3 bg-white">
        <img
            src="<?= $product->getImgProduct() ?>"
            alt="<?= $product->getNameProduct() ?>"
            class="max-h-full object-contain"/>
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


