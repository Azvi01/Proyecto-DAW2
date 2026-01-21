
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


<div class="carousel w-full">
  <div id="slide1" class="carousel-item relative w-full">
    <img
      src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp"
      class="w-full" />
    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
      <a href="#slide4" class="btn btn-circle">❮</a>
      <a href="#slide2" class="btn btn-circle">❯</a>
    </div>
  </div>
  <div id="slide2" class="carousel-item relative w-full">
    <img
      src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp"
      class="w-full" />
    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
      <a href="#slide1" class="btn btn-circle">❮</a>
      <a href="#slide3" class="btn btn-circle">❯</a>
    </div>
  </div>
  <div id="slide3" class="carousel-item relative w-full">
    <img
      src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp"
      class="w-full" />
    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
      <a href="#slide2" class="btn btn-circle">❮</a>
      <a href="#slide4" class="btn btn-circle">❯</a>
    </div>
  </div>
  <div id="slide4" class="carousel-item relative w-full">
    <img
      src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp"
      class="w-full" />
    <div class="absolute left-5 right-5 top-1/2 flex -translate-y-1/2 transform justify-between">
      <a href="#slide3" class="btn btn-circle">❮</a>
      <a href="#slide1" class="btn btn-circle">❯</a>
    </div>
  </div>
</div>

