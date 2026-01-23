<div class="max-w-7xl mx-auto px-4 py-8 grid grid-cols-1 col-span-full md:grid-cols-2 gap-10">

    <!-- IMAGEN -->
    <div class="bg-gray-100 rounded-lg p-6 flex items-center justify-center">
        <img
            src="<?= $product->getImgProduct() ?>"
            alt="<?= $product->getNameProduct() ?>"
            class="w-full max-w-md object-contain"
        >
    </div>

    <!-- INFO -->
    <form action="#" method="get" class="flex flex-col gap-4">

        <h2 class="text-2xl md:text-3xl font-bold text-content">
            <?= $product->getNameProduct() ?>
        </h2>

        <p class="text-gray-500 leading-relaxed">
            <?= $product->getDescriptionProduct() ?>
        </p>

        <!-- PRECIOS -->
        <div class="flex items-center gap-3 mt-2">
            <span class="text-3xl font-bold text-content">
                <?= $product->getFinalPrice() ?>
            </span>

            <?php if ($product->hasOffer()) :?>
                <span class="text-gray-400 line-through">
                    <?= $product->getBasePriceProduct() ?>
                </span>

                <span class="bg-red-600 text-white text-sm px-2 py-1 rounded">
                    <?= $product->getOffer() ?>
                </span>
            <?php endif;?>
        </div>

        <!-- CANTIDAD + BOTÓN -->
        <div class="flex gap-3 mt-4">
            <select
                name="cantidad"
                class="border border-gray-300 rounded-md px-3 py-2 text-content"
            >
                <?php for ($i=1; $i <= 10 ; $i++) :?>
                    <option  class="text-content" value="<?= $i ?>"><?= $i ?></option>
                <?php endfor;?>
            </select>

            <button
                type="submit"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-md transition"
            >
                Añadir al carrito
            </button>
        </div>

        <!-- ESPECIFICACIONES -->
        <div class="mt-8">
            <h3 class="text-lg font-semibold mb-4">
                Especificaciones Técnicas
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-6">
                <?php foreach ($attrs as $attr): ?>
                    <?php $unit = $attr->getUnit() ?? '' ?>

                    <p class="text-gray-500">
                        <?= $attr->getName() ?>
                    </p>

                    <p class="font-medium text-content sm:text-right">
                        <?= $attr->getValue() . " " . $unit ?>
                    </p>
                <?php endforeach; ?>
            </div>
        </div>

    </form>
</div>
