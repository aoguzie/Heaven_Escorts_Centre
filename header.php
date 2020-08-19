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

<style>
    .main-menu>li>a{
        color: <?php echo $siteconfig['link_color'];?>;
    }
    .main-menu>li:hover>a,.sub-menu>li:hover>a,.hov-cl1:hover,.right-top-bar a:hover{
        color: <?php echo $siteconfig['link2_color'];?>;
    }
    .btn-back-to-top,.btn-back-to-top:hover,.page-item.active .page-link{
        background-color: <?php echo $siteconfig['link2_color'];?>;
    }
    .page-link:focus, .page-link:hover{
        background-color: <?php echo $siteconfig['link2_color'];?>;
        color: <?php echo $siteconfig['link_color'];?>;
    }
    .bg1{
        background-color: <?php echo $siteconfig['button_color'];?>;
    }
    .top-bar,.topbar-mobile li{
        background-color: <?php echo $siteconfig['bgtopbar_color'];?>;
    }
    .header-v4 .wrap-menu-desktop,.main-menu-m{
        background-color: <?php echo $siteconfig['bgtop_color'];?>;
    }
    .bg3{
        background-color: <?php echo $siteconfig['bgfooter_color'];?>;
    }
</style>

<!-- Header desktop -->
<div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
        <div class="content-topbar flex-sb-m h-full container">
            <div class="left-top-bar">
                <?php echo WELCOME_TO_OUR_STORE;?>
            </div>

            <div class="right-top-bar flex-w h-full">
                <!-- <a href="about-us.php" class="flex-c-m trans-04 p-lr-25">
                    <?php echo strtoupper(ABOUT_US);?>
                </a> -->

                <?php 
                 if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){
                    ?>
                    <a href="my-account.php" class="flex-c-m p-lr-10 trans-04">
                        <?php echo strtoupper(MY_ACCOUNT);?>
                    </a>
                    <?php
                 }
                 else{
                    ?>
                    <a href="login.php" class="flex-c-m p-lr-25 trans-04">
                        <?php echo strtoupper(LOGIN);?>
                    </a>
                    <a href="register.php" class="flex-c-m trans-04 p-lr-25">
                        <?php echo strtoupper(REGISTER);?>
                    </a>
                    <?php
                 }
                ?>

                <!-- <a href="#" class="flex-c-m trans-04 p-lr-25">
                    EN
                </a>

                <a href="#" class="flex-c-m trans-04 p-lr-25">
                    USD
                </a> -->
            </div>
        </div>
    </div>

    <div class="wrap-menu-desktop">
        <nav class="limiter-menu-desktop container">
            
            <!-- Logo desktop -->		
            <a href="index.php" class="logo">
                <img src="images/icons/heaven-escorts-centre-logo.png" alt="Heaven Escorts Centre">
            </a>

            <?php include_once('nav_menu.php');?>	

            <!-- Icon header -->
            <!-- <div class="wrap-icon-header flex-w flex-r-m">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $meQty;?>">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div> -->
        </nav>
    </div>	
</div>