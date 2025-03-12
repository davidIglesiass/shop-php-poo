<div id="manage-container" class="m-categories">
    <h1>Manage Categories</h1>
    <form action="/category/save" method="POST">
        <input type="text" name="name" placeholder="Category name" required>
        <input type="submit" value="Create">
    </form>
    <div id="table-container">
        <table>
            <tr>
                <th>ID</th>
                <th>NAME</th>
            </tr>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category->id ?></td>
                    <td><?= $category->name ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>