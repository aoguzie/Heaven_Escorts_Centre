<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    Categories
                </h4>

                <ul>
                    <li class="p-b-10">
                    <?php $rowCatSub1 = get_redirect_product($conn,1);?>
                        <a href="product.php?cat_id=<?php echo encode(1,LIAM_COINS_KEY);?>" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo get_category_name($conn,1);?>
                        </a>
                    </li>

                    <li class="p-b-10">
                    <?php $rowCatSub2 = get_redirect_product($conn,2);?>
                        <a href="product.php?cat_id=<?php echo encode(2,LIAM_COINS_KEY);?>" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo get_category_name($conn,2);?>
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="numismatics-buy-and-sell.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo NUMISMATICS;?>
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="upcoming-auctions.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo AUCTIONS;?>
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="banknotes-investment.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo INVESTMENT;?>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    <?php echo HELP;?>
                </h4>

                <ul>
                    <!-- <li class="p-b-10">
                        <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo TRACK_ORDER;?>
                        </a>
                    </li> -->

                    <li class="p-b-10">
                        <a href="returns.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo RETURNS;?> 
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="shipping.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo SHIPPING;?>
                        </a>
                    </li>

                    <li class="p-b-10">
                        <a href="faqs.php" class="stext-107 cl7 hov-cl1 trans-04">
                            <?php echo FAQS;?>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                   <?php echo GET_IN_TOUCH;?>
                </h4>

                <p class="stext-107 cl7 size-201">
                    <!-- Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879 -->
                    Any questions? Let us know in store at ....
                </p>

                <div class="p-t-27">
                    <a href="https://twitter.com/CoinsLiam" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="https://www.instagram.com/liamcoins/" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-instagram"></i>
                    </a>

                    <a href="https://www.youtube.com/channel/UC6XKbkGqLn4xgoq34J8g75g/about?view_as=subscriber" target="_blank" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                        <i class="fa fa-youtube"></i>
                    </a>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 p-b-50">
                <h4 class="stext-301 cl0 p-b-30">
                    <?php echo NEWSLETTER;?>
                </h4>

                <form>
                    <div class="wrap-input1 w-full p-b-4">
                        <input class="input1 bg-none plh1 stext-107 cl7" style="border: none;" type="text" name="email" placeholder="email@example.com">
                        <div class="focus-input1 trans-04"></div>
                    </div>

                    <div class="p-t-18">
                        <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                            <?php echo SUBSCRIBE;?>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="p-t-40">
            <div class="flex-c-m flex-w p-b-18">
                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
                </a>

                <a href="#" class="m-all-1">
                    <img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
                </a>
            </div>

            <p class="stext-107 cl6 txt-center">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
            </p>
        </div>
    </div>
</footer>