<?php
include_once("include_app.php");

if(isset($_POST['getData']) and $_POST['getData']=="ok"){

    $condition = '';

    if(isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != ""){
        $cat_id = decode($_REQUEST['cat_id'],LIAM_COINS_KEY);
        $condition .= " AND `category` = '".$cat_id."'";
    }

    if(isset($_REQUEST['catsub_id']) && $_REQUEST['catsub_id'] != ""){
        $catsub_id = decode($_REQUEST['catsub_id'],LIAM_COINS_KEY);
        $condition .= " AND `category_sub` = '".$catsub_id."'";
    }

	$sqlProLoad = "SELECT * FROM `lc_product` WHERE `status` ='1' ".$condition." LIMIT ".$_REQUEST["start"].", ".$_REQUEST["limit"]." ";
    $quProLoad = mysqli_query($conn,$sqlProLoad);
}else{
    die();
}

$n = 1;

while($rowProLoad = mysqli_fetch_array($quProLoad, MYSQLI_ASSOC)){
    ?>
    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
		<div class="block2">
			<div class="block2-pic hov-img0">

            <?php
                $proImages = '';
                if(!empty($rowProLoad['images'])){
                    $proImages = 'uploads/product/'.$rowProLoad['images'];
                }else{
                    $proImages = 'uploads/product/none.jpg';
                }
            ?>

                <img src="<?php echo $proImages;?>" alt="<?php echo $rowProLoad['name'];?>">
                
				<a href="product-detail.php?id=<?php echo encode($rowProLoad['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
					<?php echo QUICK_VIEW;?>
				</a>
			</div>

			<div class="block2-txt flex-w flex-t p-t-14">
				<div class="block2-txt-child1 flex-col-l ">
					<a href="product-detail.php?id=<?php echo encode($rowProLoad['id'],LIAM_COINS_KEY);?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
						<?php echo $rowProLoad['name'];?>
					</a>

					<span class="stext-105 cl3">
                        <?php echo LIAM_COINS_CURRENCY.number_format($rowProLoad['price'],2);?>
					</span>
				</div>
			</div>
		</div>
	</div>
    <?php
    $n++;
}

?>