<div id="register-container">
    <?php if (isset($edit) && isset($getOneProduct)): ?>
        <h1>Edit Product</h1>
        <?php $url = '/product/save&id='.$getOneProduct->id; ?>
    <?php else: ?>
        <h1>Create Product</h1>
        <?php $url = '/product/save'; ?>
    <?php endif; ?>
    <form action="<?=$url?>" method="POST" enctype="multipart/form-data">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php if (isset($edit) && isset($getOneProduct)) echo $getOneProduct->name; ?>" required>

        <label for="price">Price</label>
        <input type="number" name="price" value="<?php if (isset($edit) && isset($getOneProduct)) echo $getOneProduct->price; ?>" required>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?php if (isset($edit) && isset($getOneProduct)) echo $getOneProduct->stock; ?>" required>

        <label for="description">Description</label>
        <textarea name="description"><?php if (isset($edit) && isset($getOneProduct)) echo $getOneProduct->description; ?></textarea>

        <label for="category_id">Category</label>
        <?php $categories = Utils::showCategories(); ?>
        <select name="category_id" required>
            <option disabled>Select a category</option>
            <?php foreach ($categories as $category) : ?>
                <option <?php if (isset($edit) && isset($getOneProduct) && $getOneProduct->category_id == $category->id) echo 'selected'; ?> value="<?= $category->id ?>"><?= $category->name ?></option>
            <?php endforeach; ?>
        </select>

        <label for="image">Image</label>
        <?php if (isset($edit) && isset($getOneProduct)): ?>
            <img src="/public/uploads/products/<?= $getOneProduct->image ?>" alt="<?= $getOneProduct->name ?>" style="width: 300px; margin: 0 auto; border-radius: 5px;"> 
        <?php endif; ?>
        <input type="file" name="image">

        <input type="submit" value="<?= (isset($edit) && isset($getOneProduct)) ? 'Edit' : 'Create'?>" >
    </form>
</div>