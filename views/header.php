<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_title ?></title>
    <!-- Bootstrap -->
    <link href="./style/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="./style/style.css" rel="stylesheet">
    <link rel="stylesheet" href="./style/font-awesome.min.css">
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
</head>
<body>
<div class="jumbotron">
    <div class="container text-center">
        <h1>Online Store</h1>
        <p>Tv & Computer</p>
    </div>
</div>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Online Store</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul id="navright" class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="dropdown">
                    <a href="category.php" data-toggle="dropdown">Produkter
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="category.php?id=2">TV</a></li>
                        <li><a href="category.php?id=1">Datorer</a></li>
                    </ul>
                </li>
                <li><a href="admin.php">Admin Panel</a></li>
            </ul>

            <div id="searchbox" class="col-md-8 nav navbar-nav">
                <form action="search.php" method="GET" class="search-form">
                    <div class="input-group">
                          <span id="searchicon2" class="input-group-addon">
                              <i class="glyphicon glyphicon-search"></i>
                          </span>
                        <input type="text" name="q" placeholder="search" class="form-control" required="required">
                          <span id="searchremove" class="input-group-addon">
                              <i class="glyphicon glyphicon-remove"></i>
                          </span>

                    </div>
                </form>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li id="searchicon"><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
                <li><a href="my_cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
                          <span id="cart" class="hidden-xs badge">
                              <?php if ($cart->cartItems() > 0) : ?>
                                  <?= $cart->cartItems(); ?> produkter, pris <?= $cart->productsSum(); ?> :-
                              <?php else: ?>
                                  0 produkter, pris 0 :-
                              <?php endif; ?>
                          </span>
                    </a></li>
            </ul>
        </div>
    </div>
</nav>
<div id="overlayForSearch"></div>
<div class="container">