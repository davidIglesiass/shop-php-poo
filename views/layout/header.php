<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>T-Shirts Shop</title>
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="icon" href="../assets/img/logo.png">
</head>

<body>
    <div id="container">
        <!-- HEADER -->
        <header id="header">
            <div id="logo">
                <img src="../assets/img/logo.png" alt="logo-tshirt">
                <a href="index.php">T-Shirts Shop</a>
            </div>

            <!-- MENU -->
            <?php $categories = Utils::showCategories(); ?>
            <nav id="menu">
                <ul>
                    <li><a href="/">Home</a></li>
                    <?php foreach ($categories as $category) : ?>
                        <li><a href="/category/show&id=<?= $category->id ?>"><?= $category->name ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </header>
        <!-- MAIN -->
        <div id="main-container">