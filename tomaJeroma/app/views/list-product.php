
<h1 class="text-3xl text-content font-bold col-span-full">Productos</h1>

<?php
    foreach ($products as $product):
?>
<div class="card bg-neutral-content shadow-md hover:shadow-xl transition-shadow duration-300 w-full p-4 text-neutral max-w-sm mx-auto">
    <figure class="aspect-4/5 overflow-hidden rounded-xl">
        <img
            src="<?= $product->getImgProduct() ?>"
            alt="<?= $product->getNameProduct() ?>"
            class="h-full w-full"/>
    </figure>
    <div class="card-body p-4 gap-3">
        <h2 class="card-title text-base md:text-lg flex justify-between items-start gap-2">
        <span class="line-clamp-2"><?= $product->getNameProduct() ?></span>
        <?php if ($product->hasOffer()):?>
            <div class="badge badge-secondary shrink-0">Offer</div>
        <?php endif;?>
        </h2>
        <p class="text-sm text-neutral/80 line-clamp-3"><?= $product->getDescriptionProduct() ?></p>
        <div class="card-actions justify-between items-center mt-auto">
            <div class="badge badge-outline text-xs"><?= $product->getNameCategory() ?></div>

            <?php if ($product->hasOffer()):?>
                <div class="flex items-center gap-2">
                    <p class="text-sm line-through decoration-red-500"><?= $product->getBasePriceProduct() ?></p>
                    <div class="badge badge-outline font-semibold"><?= $product->getFinalPrice() ?></div>
                </div>
            <?php else:?>
                <div class="badge badge-outline font-semibold"><?= $product->getBasePriceProduct() ?></div>
            <?php endif;?>

        </div>
    </div>
</div>

<?php endforeach;?>

