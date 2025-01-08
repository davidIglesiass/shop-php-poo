<div id="product-container">
    <?php foreach ($products as $product): ?>
        <div class="product">
            <?php if ($product->image != null): ?>
                <img src="public/uploads/products/<?= $product->image ?>" alt="product">
            <?php else: ?>
                <img src="assets/img/tshirt-black.png" alt="product">
            <?php endif; ?>
            <h2><a class="link-product" href="/product/show&id=<?= $product->id ?>"><?= $product->name ?></a></h2>
            <p>$<?= $product->price ?> EUR</p>
            <a href="" class="buy">Buy</a>
        </div>
    <?php endforeach; ?>
</div>