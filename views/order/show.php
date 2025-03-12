<div id="manage-container" class="m-carshop">
    <?php if (isset($_SESSION['ordercreated'])): ?>
        <h1>My orders</h1>
        <p>
            Your order has been saved successfully, once you have paid the order to this address (213-456-787-654-321) your products will be sent to the address you have indicated. We will notify you when the products are shipped.
        </p>
        <?php if (isset($order)): ?>
            <div class="order-details">
                <?php if (isset($_SESSION['admin'])): ?>
                    <h3>Change status of the order: </h3>
                    <form action="/order/status" method="POST">
                        <select name="status" id="status">
                            <option value="requested" <?= $order->status == 'requested' ? 'selected' : ''  ?> >Requested</option>
                            <option value="paid" <?= $order->status == 'paid' ? 'selected' : ''  ?>>Paid</option>
                            <option value="shipped" <?= $order->status == 'shipped' ? 'selected' : ''  ?>>Shipped</option>
                            <option value="delivered" <?= $order->status == 'delivered' ? 'selected' : ''  ?>>Delivered</option>
                            <option value="cancelled" <?= $order->status == 'cancelled' ? 'selected' : ''  ?>>Cancelled</option>
                        </select>

                        <input type="hidden" name="id" value="<?= $order->id ?>">
                        <input type="submit" value="Change">
                    </form>
                <?php endif; ?>
                <hr>
                <h3>Address</h3>
                <p><strong>State:</strong> <?= $order->state ?></p>
                <p><strong>City:</strong> <?= $order->city ?></p>
                <p><strong>Address:</strong> <?= $order->address ?></p>
                <hr>
                <h3>Information of the order: </h3>
                <p><strong>Status:</strong> <?= Utils::showStatus($order->status) ?></p>
                <p><strong>Number of order:</strong> <?= $order->id ?></p>
                <p><strong>Total to pay:</strong> $<?= $order->price ?> USD</p>
                <p><strong>Products:</strong></p>
            </div>
        <?php endif; ?>
        <div id="table-container">
            <table>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Units</th>
                </tr>
                <?php foreach ($products as $product): ?>
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