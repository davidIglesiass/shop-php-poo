<div id="manage-container" class="m-carshop">  
    <?php if (!isset($manage)): ?>
    <h1>My Orders</h1>
    <?php else: ?>
    <h1>Manage Orders</h1>
    <?php endif; ?>
    <?php if (!empty($orders)): ?>
        <div id="table-container">
            <table>
                <tr>
                    <th>No Order</th>
                    <th>Price</th>
                    <th>Requested At</th>
                    <th>Status</th>
                </tr>
                <?php foreach ($orders as $order):?>
                    <tr>
                        <td><a href="/order/show&id=<?= $order->id ?>" class="button"><?= $order->id ?></a></td>
                        <td>$<?= $order->price ?> USD</td>
                        <td><?= $order->created_at ?></td>
                        <td><?= Utils::showStatus($order->status) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
        </div>
    <?php else: ?>
        <p>¡¡¡You have no orders!!!</p>
        <a href="/" class="button button-start-buy alert_green">¡Start Buying!</a>
    <?php endif; ?>
</div>