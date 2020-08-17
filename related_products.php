<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
    <div class="container">
        <div class="p-b-45">
            <h3 class="ltext-106 cl5 txt-center">
                <?php echo RELATED_PRODUCTS;?>
            </h3>
        </div>

        <!-- Slide2 -->
        <div class="wrap-slick2">
            <div class="slick2">
                <?php
                $sqlProRelat = "SELECT * FROM `lc_product` WHERE `status` ='1' AND `id` != '".$pro_id."' AND `category` = '".$rowPro['category']."' LIMIT 8";
                $quProRelat = mysqli_query($conn,$sqlProRelat);
                while($rowProRelat = mysqli_fetch_array($quProRelat, MYSQLI_ASSOC)){
                    ?>
                    <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">

                                <?php
                                    $proImages = '';
                                    if(!empty($rowProRelat['images'])){
                                        $proImages = 'uploads/product/'.$rowProRelat['images'];
                                    }else{
                                        $proImages = 'uploads/product/none.jpg';
                                    }
                                ?>

                                <img src="<?php echo $proImages;?>" alt="<?php echo $rowProRelat['name'];?>">

                                <!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                    <?php echo QUICK_VIEW;?>
                                </a> -->

                                <a href="product-detail.php?id=<?php echo encode($rowProRelat['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
                                    <?php echo QUICK_VIEW;?>
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="product-detail.php?id=<?php echo encode($rowProRelat['id'],LIAM_COINS_KEY);?>" class="stext-104 cl5 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        <?php echo $rowProRelat['name'].", ".$rowProRelat['age'];?><br>
                                        <?php echo $rowProRelat['description'];?>
                                    </a>

                                    <!-- <span class="stext-105 cl3">
                                        <?php echo LIAM_COINS_CURRENCY.number_format($rowProRelat['price'],2);?>
                                    </span> -->
                                </div>

                                <!-- <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>