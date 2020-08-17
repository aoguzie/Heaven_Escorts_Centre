<?php 

$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

if(isset($_SESSION['qty'])){
    $meQty = 0;
    foreach($_SESSION['qty'] as $meItem){
        $meQty = ((float)$meQty + (float)$meItem);
    }
}else{
    $meQty = 0;
}
?>
<!-- Header Mobile -->
<div class="wrap-header-mobile">
    <!-- Logo moblie -->		
    <div class="logo-mobile">
        <a href="index.php"><img src="images/icons/heaven-escorts-centre-logo.png" alt="Heaven Escorts Centre"></a>
    </div>

    <!-- Icon header -->
    <!-- <div class="wrap-icon-header flex-w flex-r-m m-r-15">
        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
        </div>

        <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="<?php echo $meQty;?>">
            <i class="zmdi zmdi-shopping-cart"></i>
        </div>

        <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
            <i class="zmdi zmdi-favorite-outline"></i>
        </a>
    </div> -->

    <!-- Button show menu -->
    <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
    </div>
</div>