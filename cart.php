<?php
include_once("include/include_app.php");

$itemCountCart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

if (isset($_SESSION['qty'])) {
    $meQtyCart = 0;
    foreach ($_SESSION['qty'] as $meItem) {
        $meQtyCart = ((float)$meQtyCart + (float)$meItem);
    }
} else {
    $meQtyCart = 0;
}

if (isset($_SESSION['cart']) && $itemCountCart > 0) {

    $itemIdsCart = "";
    foreach ($_SESSION['cart'] as $itemId) {
        $itemIdsCart = $itemIdsCart . $itemId . ",";
    }

    $inputItemsCart = rtrim($itemIdsCart, ",");
    $meSqlCart = "SELECT * FROM `lc_product` WHERE `id` in ({$inputItemsCart})";
    $meQueryCart = mysqli_query($conn,$meSqlCart);
    $meCountCart = mysqli_num_rows($meQueryCart);

} else {
    $meCountCart = 0;
}
?>

<!-- Cart show-header-cart-->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <?php 
        if($itemCountCart > 0){
        ?>
        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                <?php
                $total_priceCart = 0;
                $numCart = 0;
                while ($meResultCart = mysqli_fetch_assoc($meQueryCart)){
                    $key = array_search($meResultCart['id'], $_SESSION['cart']);

                    if((float)$_SESSION['qty'][$key] > 0){
                        $total_priceCart = ((float)$total_priceCart + ((float)$meResultCart['price'] * (float)$_SESSION['qty'][$key]));

                        $proImages = '';
                        if(!empty($meResult['images'])){
                            $proImages = 'uploads/product/'.$meResult['images'];
                        }else{
                            $proImages = 'uploads/product/none.jpg';
                        }

                        ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <a href="control/removecart.php?itemId=<?php echo encode($meResultCart['id'],LIAM_COINS_KEY);?>">
                                <div class="header-cart-item-img">
                                    <img src="<?php echo $proImages;?>" alt="<?php echo $meResultCart['name'];?>">
                                </div>
                            </a>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="product-detail.php?id=<?php echo encode($meResultCart['id'],LIAM_COINS_KEY);?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    <?php echo $meResultCart['name'];?>
                                </a>
        
                                <span class="header-cart-item-info">
                                    <?php echo $_SESSION['qty'][$key];?> x <?php echo $meResultCart['price'];?>
                                </span>
                            </div>
                        </li>
                        <?php 
                    }

                    $numCart++;
                }
                ?>

            </ul>
            
            <div class="w-full">
                <div class="header-cart-total w-full p-tb-40">
                    Total: <?php echo LIAM_COINS_CURRENCY.number_format($total_priceCart, 2); ?>
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>

                    <a href="checkout.php" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
        <?php
        }else{
        ?>
        <div class="header-cart-content flex-w js-pscroll" style="margin: 0 auto;">
            <div class="text-center">
                <p class="p-b-20"><img src="images/emtry_cart.png" style="width: 200px;"></p>
                <p class="p-b-20 stext-113 cl6">Your cart is currently empty.</p>
                <p class="p-b-20"><a href="index.php" class="hov-cl1">RETURN TO SHOP</a></p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</div>