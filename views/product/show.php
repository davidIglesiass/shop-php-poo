<div class="product-details">
    <?php if ($product->image != null): ?>
        <img src="/public/uploads/products/<?= $product->image ?>" alt="product">
    <?php else: ?>
        <img src="/assets/img/tshirt-black.png" alt="product">
    <?php endif; ?>
    <div class="details">
        <h2><?= $product->name ?></h2>
        <p>$<?= $product->price ?> EUR</p>
        <p><?= $product->description ?></p>
        <a href="" class="buy">Buy</a>
    </div>
</div>