<div id="aside-container">
    <!-- ASIDE -->
    <aside id="aside-block">
        <div id="login" class="aside-block-container">
                <?php if (!isset($_SESSION['identity'])) : ?>
                <h2>Login</h2>
                <?php if (isset($_SESSION['loginfailed']) && $_SESSION['loginfailed'] == 'unable to login'): ?>
                    <strong class="alert alert_red">Email or password incorrect</strong>
                <?php endif; ?>
                <form action="/user/login" method="post">
                    <label for="">Email</label>
                    <input type="email" name="email">
                    <label for="">Password</label>
                    <input type="password" name="password">
                    <input type="submit" value="Login">
                </form>
                <br>
                <br>
                <?php endif; ?>
                <input type="checkbox" name="aside-button" id="aside-menu-button">
                <div class="aside-menu">
                <?php if (isset($_SESSION['admin'])) : ?>
                <a href="/category/index">Manage Categories</a>
                <a href="/product/manage">Manage Products</a>
                <a href="/order/manage">Manage Orders</a>
                <a href="/user/manage">Manage Users</a>
                <?php endif; ?>
                <?php if (isset($_SESSION['identity'])) : ?>
                <a href="/order/myorders">My orders</a>
                <a href="/user/logout">Logout</a>
                <?php else: ?>
                <a href="/user/create">Or register now!!</a>
                <?php endif; ?>
                </div>
                
            </div>
    </aside>
    <?php Utils::deleteSession('loginfailed'); ?>
</div>