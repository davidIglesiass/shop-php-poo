<div id="register-container">
    <?php if (isset($_SESSION['identity'])): ?>
        <h1>Make your order</h1> <br>
        <a href="/carshop/index" class="buy">Go to products and prices</a>

        <form action="/order/add" method="POST">
            <label for="state">State</label>
            <input type="text" name="state" required>
            <label for="city">City</label>
            <input type="text" name="city">
            <label for="address">Address</label>
            <input type="text" name="address" required>

            <input type="submit" value="Order">
        </form>

    <?php else: ?>
        <h1>Log in to make your order</h1>
    <?php endif; ?>
</div>