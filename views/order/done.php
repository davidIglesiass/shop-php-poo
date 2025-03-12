<div id="manage-container" class="m-carshop">
    <?php if (isset($_SESSION['ordercreated'])): ?>
        <h1><?= $_SESSION['ordercreated'] ?></h1>
        <p>
            Your order has been saved successfully, once you have paid the order to this address (213-456-787-654-321) your products will be sent to the address you have indicated. We will notify you when the products are shipped.
        </p>
        <br>
        <?php if (isset($order)): ?>
            <h3>Information of the order:</h3>
            Number of order: <?= $order->id ?><br>
            Total to pay: $<?= $order->price ?><br>
            Products:
        <?php endif; ?>
        <div id="table-container">
            <table>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Units</th>
                </tr>
                <?php foreach ($products as $product):?>
                    <tr>
                        <?php if (isset($product->image)): ?>
                            <td><img src="/public/uploads/products/<?= $product->image ?>" alt="product" width="100px"></td>
                        <?php else: ?>
                            <td><img src="/assets/img/tshirt-black.png" alt="product" width="100px"></td>
                        <?php endif; ?>
                        <td><a href="/product/show&id=<?= $product->id ?>" class="link-product_carshop"><?= $product->name ?></a></td>
                        <td>$<?= $product->price ?> USD</td>
                        <td><?= $product->quantity ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <?php elseif (isset($_SESSION['orderfailed'])): ?>
            <h1><?= $_SESSION['orderfailed'] ?></h1>
        <?php endif; ?>
</div>