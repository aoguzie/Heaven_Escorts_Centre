<!-- Menu desktop -->
<div class="content-menu">
    <div class="menu-desktop">
        <ul class="main-menu">
            <li>
                <a href="index.php"><?php echo HOME;?></a>
            </li>

            <li>
                <a href="#"><?php echo ESCORTS;?></a>
            </li>
            <li>
                <a href="#"><?php echo ROTA;?></a>
            </li>
            <li>
                <a href="#"><?php echo FAQS;?></a>
            </li>
            <li>
                <a href="#"><?php echo WORK_WITH_US;?></a>
            </li>
            <li>
                <a href="#"><?php echo VIP_EXPERINCE;?></a>
            </li>
            <li>
                <a href="#"><?php echo CONTACT_US;?></a>
            </li>

            <!-- <li>
                <?php 
                    $rowCatSub1 = get_redirect_product($conn,1);
                ?>
                <a href="product.php?cat_id=<?php echo encode(1,LIAM_COINS_KEY);?>"><?php echo get_category_name($conn,1);?></a>
                <ul class="sub-menu">
                    <li><a href="product.php?cat_id=<?php echo encode(1,LIAM_COINS_KEY);?>">New Arrivals</a></li>
                    <?php
                    $sqlCatSubMenu = "SELECT * FROM `lc_category_sub` WHERE `category` = 1 ORDER BY id ASC";
                    $quCatSubMenu = mysqli_query($conn,$sqlCatSubMenu);
                    while($rowCatSubMenu = mysqli_fetch_array($quCatSubMenu, MYSQLI_ASSOC)){
                        ?>
                        <li><a href="product.php?cat_id=<?php echo encode(1,LIAM_COINS_KEY);?>&catsub_id=<?php echo encode($rowCatSubMenu['id'],LIAM_COINS_KEY);?>"><?php echo $rowCatSubMenu['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </li> -->

            <!-- <li>
                <?php $rowCatSub2 = get_redirect_product($conn,2);?>
                <a href="product.php?cat_id=<?php echo encode(2,LIAM_COINS_KEY);?>"><?php echo get_category_name($conn,2);?></a>
                <ul class="sub-menu">
                    <li><a href="product.php?cat_id=<?php echo encode(2,LIAM_COINS_KEY);?>">New Arrivals</a></li>
                    <?php
                    $sqlCatSubMenu = "SELECT * FROM `lc_category_sub` WHERE `category` = 2 ORDER BY id ASC";
                    $quCatSubMenu = mysqli_query($conn,$sqlCatSubMenu);
                    while($rowCatSubMenu = mysqli_fetch_array($quCatSubMenu, MYSQLI_ASSOC)){
                        ?>
                        <li><a href="product.php?cat_id=<?php echo encode(2,LIAM_COINS_KEY);?>&catsub_id=<?php echo encode($rowCatSubMenu['id'],LIAM_COINS_KEY);?>"><?php echo $rowCatSubMenu['name'];?></a></li>
                        <?php
                    }
                    ?>
                </ul>
                <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </li> -->

            <!-- <li>
                <a href="numismatics-buy-and-sell.php"><?php echo NUMISMATICS;?></a>
                <ul class="sub-menu">
                    <li><a href="numismatics-buy-and-sell.php"><?php echo BUY_AND_SELL;?></a></li>
                    <li><a href="numismatics-service.php"><?php echo NUMISMATIC_SERVICE;?></a></li>
                </ul>
                <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </li> -->

            <!-- <li>
                <a href="upcoming-auctions.php"><?php echo AUCTIONS;?></a>
                <ul class="sub-menu">
                    <li><a href="upcoming-auctions.php"><?php echo UPCOMING_AUCTIONS;?></a></li>
                    <li><a href="intresting-auctions-results.php"><?php echo INTERESTING_AUCTIONS_RESULTS;?></a></li>
                    <li><a href="auctions-bid.php"><?php echo BID;?></a></li>
                </ul>
                <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </li> -->

            <!-- <li>
                <a href="banknotes-investment.php"><?php echo INVESTMENT;?></a>
                <ul class="sub-menu">
                    <li><a href="banknotes-investment.php"><?php echo BANKNOTES_INVESTMENT;?></a></li>
                    <li><a href="coins-investment.php"><?php echo COINS_INVESTMENT;?></a></li>
                </ul>
                <span class="arrow-main-menu">
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                </span>
            </li> -->

            <!-- <li>
                <a href="about-us.php"><?php echo ABOUT_US;?></a>
            </li> -->
            
            <?php 
                if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){
                    ?>
                    <li>
                        <a href="my-account.php"><?php echo MY_ACCOUNT;?></a>
                        <ul class="sub-menu">
                            <!-- <li><a href="my-address.php"><?php echo SHIP_ADDRESS;?></a></li> -->
                            <!-- <li><a href="my-order.php"><?php echo ORDER_HISTORY;?></a></li> -->
                            <!-- <li><a href="my-tracking"><?php echo ORDER_TRACKING;?></a></li> -->
                            <li><a href="logout.php"><?php echo LOGOUT;?></a></li>
                        </ul>
                        <span class="arrow-main-menu">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </span>
                    </li>
                    <?php
                }
                else{
                    ?>
                    <!-- <li>
                        <a href="register.php"><?php echo REGISTER;?></a>
                    </li> -->
                    <?php
                }
            ?>
        </ul>
    </div>
</div>