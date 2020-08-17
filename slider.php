<!-- Slider -->
<section class="section-slide">
    <div class="wrap-slick1">
        <div class="slick1">
        <?php
            $sqlBanner = "SELECT * FROM `lc_banner` WHERE `status` = 1 ORDER BY `id` DESC";
            $quBanner = mysqli_query($conn, $sqlBanner);
            while($rowBanner = mysqli_fetch_array($quBanner, MYSQLI_ASSOC)){
                $linkTarget = '';
                $bannerIMG = '';

                if($rowBanner['target'] === '1'){
                    $linkTarget = 'target="_blank"';
                }else{
                    $linkTarget = 'target="_parent"';
                }

                if(!empty($rowBanner['images'])){
                    $bannerIMG = 'uploads/banner/'.$rowBanner['images'];
                }else{
                    $bannerIMG = 'uploads/banner/none.jpg';
                }

        ?>
            <div class="item-slick1" style="background-image: url(<?php echo $bannerIMG;?>);">
                <div class="container h-full">
                    <!-- <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                        <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                            <span class="ltext-101 cl2 respon2">
                                <?php echo $rowBanner['name'];?>
                            </span>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                            <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                <?php echo stripslashes($rowBanner['detail']);?>
                            </h2>
                        </div>
                            
                        <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                            <a href="<?php echo $rowBanner['link'];?>" <?php echo $linkTarget;?> class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                <?php echo VIEW_MORE;?>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        <?php
            }
        ?>
        </div>
    </div>
</section>