<?php
	$num = 0;
	$e_page=16; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
	$step_num=0;
	$sqlPro = "";
	$totalPro = 0;
    $query_str = '';
    
    $sqlPro = "SELECT * FROM `lc_product` WHERE status = '1' ORDER BY id DESC";
    $quPro = mysqli_query($conn,$sqlPro);
    $totalPro = mysqli_num_rows($quPro);

    if(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page']==1)){   
		$_GET['page']=1;   
		$step_num=0;
		$s_page = 0;    
	}else{   
		$s_page = $_GET['page']-1;
		$step_num=$_GET['page']-1;  
		$s_page = $s_page*$e_page;
	}   

	$sqlPro.=" LIMIT ".$s_page.",$e_page";
	$quProS = mysqli_query($conn,$sqlPro);

?>

<script>
	function addToCart(itemId,itemName){

		$.post("include/call_api.php",
		{
			action: "addToCart",
			itemId: itemId
		},
		function(data, status){

			if(status === "success"){
				// var dataSet = data.split("|");
				// document.getElementById('pro_category_sub').innerHTML= dataSet[1];
				// $("#pro_category_sub").val('').trigger('change')
				swal(itemName, "Added to cart !", "success");
				setTimeout(function(){ location.reload(); }, 1000);
				
			}
		});
		
	}
    </script>
    
<!-- Product -->
<section class="bg0 p-t-23">
    <div class="container">
        <div class="p-t-50 p-b-50 text-center">
            <h3 class="ltext-103 cl5">
                <?php echo NEW_MODEL_ARRIVALS;?>
            </h3>
        </div>

        <?php /*include_once('filter_product.php');*/ ?>

        <div class="row isotope-grid">

        <?php 
        while($rowPro = mysqli_fetch_array($quProS, MYSQLI_ASSOC)){
            ?>
            <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                <!-- Block2 -->
                <div class="block2">
                    <div class="block2-pic hov-img0">
                        <?php
                            $proImages = '';
                            if(!empty($rowPro['images'])){
                                $proImages = 'uploads/product/'.$rowPro['images'];
                            }else{
                                $proImages = 'uploads/product/none.jpg';
                            }
                        ?>
                        <img src="<?php echo $proImages;?>" alt="<?php echo $rowPro['name'];?>">

                        <!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                            <?php echo QUICK_VIEW;?>
                        </a> -->
                        <a href="product-detail.php?id=<?php echo encode($rowPro['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
                            <?php echo QUICK_VIEW;?>
                        </a>

                        <!-- <button tyle="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04" onclick="addToCart('<?php echo $rowPro['id'];?>','<?php echo $rowPro['name'];?>')">ADD TO CART</button> -->

                    </div>

                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l ">
                            <a href="product-detail.php?id=<?php echo encode($rowPro['id'],LIAM_COINS_KEY);?>" class="stext-104 cl5 hov-cl1 trans-04 js-name-b2 p-b-6">
                                <?php echo $rowPro['name'].", ".$rowPro['age'];?><br>
                                <?php echo $rowPro['description'];?>
                            </a>

                            <!-- <span class="stext-105 cl3">
                                <?php echo LIAM_COINS_CURRENCY.number_format($rowPro['price'],2);?>
                            </span> -->
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
            
        </div>

        <?php
        
        if($totalPro > $e_page){
        ?>
        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45 pb-5">
            <?php

                    $pageN = 0;
                    if(isset($_GET['page'])){
                        $pageN = $_GET['page']; 
                    }else{
                        $pageN = 1;
                    }
                    page_navi($totalPro,$pageN,$e_page,$query_str);
            ?>
        </div>
        <?php }?>
    </div>
</section>