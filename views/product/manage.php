<div id="manage-container" class="m-products">
    <h1>Manage Products</h1>
    <?php if(isset($_SESSION['productsaved'])) : ?>
        <div class="alert alert_green"><?= $_SESSION['productsaved'] ?></div>
    <?php elseif(isset($_SESSION['productunsaved'])) : ?>
        <div class="alert alert_red"><?= $_SESSION['productunsaved'] ?></div>
    <?php endif; ?>
    <?php if(isset($_SESSION['productdeleted'])) : ?>
        <div class="alert alert_green"><?= $_SESSION['productdeleted'] ?></div>
    <?php elseif(isset($_SESSION['productundeleted'])) : ?>
        <div class="alert alert_red"><?= $_SESSION['productundeleted'] ?></div>
    <?php endif; ?>
    <?php if(isset($_SESSION['productupdated'])) : ?>
        <div class="alert alert_green"><?= $_SESSION['productupdated'] ?></div>
    <?php endif; ?>
    <?php Utils::deleteSession('productsaved'); Utils::deleteSession('productunsaved'); Utils::deleteSession('productdeleted'); Utils::deleteSession('productundeleted'); Utils::deleteSession('productupdated'); ?>
    <a href="/product/create" class="button">Create</a>
    <div id="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
                <th>PRICE</th>
                <th>STOCK</th>
                <th>ACTIONS</th>
            </tr>
            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product->id ?></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->price ?></td>
                    <td><?= $product->stock ?></td>
                    <td>
                        <a href="/product/update&id=<?= $product->id ?>" class="alert alert_green">Edit</a>
                        <a href="/product/delete&id=<?= $product->id ?>" class="alert alert_red">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>