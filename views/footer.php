</div>

<!--Display Shopping Cart -->
<div id="mainCart" class="hidden-xs col-md-2">
    <div class="change"><a href="my_cart.php">Ändra</a></div>
    <div class="toggle"><i class="glyphicon glyphicon-minus"></i></div>
    <div class="page-header">Varukorg
    </div>
    <ul>
        
    </ul>
</div>
<div class="toggled col-md-2 text-center">Varukorg (<?= $cart->cartItems();?>)</div>
<br><br>
<footer class="container-fluid text-center">
    <p>Online Store Copyright</p>
</footer>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>
<script src="js/js.cookie.js"></script>
<script src="js/jquery.slides.min.js"></script>
</body>
</html>