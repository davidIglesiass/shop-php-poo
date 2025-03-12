<div id="manage-container" class="m-carshop">
    <h1>Carshop</h1>
    <?php if (!empty($carshop) && count($carshop) > 0): ?>
        <div id="table-container">
            <table>
                <tr>
                    <th>Drop</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Units</th>
                    <th>Total</th>
                </tr>
                <?php foreach ($carshop as $key => $value):
                    $product = $value["product"];
                ?>
                <tr>
                    <td>
                        <a href="/carshop/remove&index=<?= $key ?>" class="alert alert_red">X</a>
                    </td>
                    <?php if (isset($product->image)): ?>
                        <td><img src="/public/uploads/products/<?= $product->image ?>" alt="product" width="100px"></td>
                    <?php else: ?>
                        <td><img src="/assets/img/tshirt-black.png" alt="product" width="100px"></td>
                    <?php endif; ?>
                    <td><a href="/product/show&id=<?= $product->id ?>" class="link-product_carshop"><?= $product->name ?></a></td>
                    <td>$<?= $product->price ?> USD</td>
                    <td>
                        <div class="units">
                            <a href="/carshop/down&index=<?= $key?>" class="alert alert_red">-</a>
                            <?= $value["units"] ?>
                            <a href="/carshop/up&index=<?= $key ?>" class="alert alert_green">+</a>
                        </div>
                    </td>
                    <td>$<?= ($product->price) * $value["units"] ?> USD</td>
                </tr>
                <?php endforeach; ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><strong>Total:</strong></td>
                    <td><strong>$<?= Utils::statsCarShop()["total"] ?> USD</strong></td>
                </tr>
            </table>
            <br>
            <div id="carshop-buttons-actions">
                <a href="/carshop/delete" class="button alert_red">Clean Carshop</a>
                <a href="/order/index" class="button alert_green">Buy All</a>
            </div>
        </div>
    <?php else: ?>
        <p>¡¡¡The carshop is empty!!!</p>
        <a href="/" class="button button-start-buy alert_green">¡Start Buying!</a>
    <?php endif; ?>
</div>