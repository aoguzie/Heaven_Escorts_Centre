<?php
	include_once("include/include_app.php");

	$num = 0;
	$e_page=16; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
	$step_num=0;
	$sqlPro = "";
	$cat_id = "";
	$catsub_id = "";
	$totalPro = 0;
	$query_str = '';

	if(isset($_GET['cat_id']) && $_GET['cat_id'] != ""){

		$cat_id = decode($_GET['cat_id'],LIAM_COINS_KEY);
		
		$sqlPro = "SELECT * FROM `lc_product` WHERE status = '1' AND category = '".$cat_id."' ORDER BY id DESC";
		$quPro = mysqli_query($conn,$sqlPro);
		$totalPro = mysqli_num_rows($quPro);
		$query_str = '?cat_id='.$_GET['cat_id'];

		// if(!isset($_GET['catsub_id'])){
		// 	$rowCatSubFide = get_redirect_product($conn,$cat_id);
		// 	header("Location:product.php?cat_id=".$_GET['cat_id']."&catsub_id=".encode($rowCatSubFide,LIAM_COINS_KEY));
		// }
	
	}else{
		header("Location:index.php?action=failed");
	}
	
	if(isset($_GET['catsub_id']) && $_GET['catsub_id'] != ""){
		$cat_id = decode($_GET['cat_id'],LIAM_COINS_KEY);
		$catsub_id = decode($_GET['catsub_id'],LIAM_COINS_KEY);
		$sqlPro = "SELECT * FROM `lc_product` WHERE status = '1' AND category = '".$cat_id."' AND category_sub = '".$catsub_id."' ORDER BY id DESC";
		$quPro = mysqli_query($conn,$sqlPro);
		$totalPro = mysqli_num_rows($quPro);
		$query_str = '?cat_id='.$_GET['cat_id'].'&catsub_id='.$_GET['catsub_id'];

	}

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
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product - </title>
	<?php include_once('head_meta.php');?>

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
</head>
<body class="animsition">
	
	<!-- Header -->
	<header class="header-v4">
		<?php include_once("header.php");?>

		<?php include_once("header_mobile.php");?>

		<?php include_once("nav_menu_mobile.php");?>

		<?php include_once("modal_search.php");?>
	</header>

	<?php include_once('cart.php');?>	

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="product.php?cat_id=<?php echo encode($cat_id,LIAM_COINS_KEY);?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo get_category_name($conn,$cat_id);?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<?php
			if(isset($_GET['catsub_id']) && $_GET['catsub_id'] != ""){
			?>
			<a href="product.php?cat_id=<?php echo encode($cat_id,LIAM_COINS_KEY);?>&catsub_id=<?php echo encode($catsub_id,LIAM_COINS_KEY);?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo get_category_sub_name($conn,$catsub_id);?>
			</a>
			<?php
			}else{
				?>
				<span class="stext-109 cl4">
					New arrivals
				</span>
				<?php
			}
			?>
		</div>
	</div>

	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140 p-t-50">
		<div class="container">

			<div class="row isotope-grid">

			<?php
			while($rowProS = mysqli_fetch_array($quProS, MYSQLI_ASSOC)){ // วนลูปแสดงรายการ
				$num++;
				?>
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
						<?php
                            $proImages = '';
                            if(!empty($rowProS['images'])){
                                $proImages = 'uploads/product/'.$rowProS['images'];
                            }else{
                                $proImages = 'uploads/product/none.jpg';
                            }
                        ?>
                        	<a href="product-detail.php?id=<?php echo encode($rowProS['id'],LIAM_COINS_KEY);?>"><img src="<?php echo $proImages;?>" alt="<?php echo $rowProS['name'];?>"></a>

							<!-- <a href="product-detail.php?id=<?php echo encode($rowProS['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
								<?php echo QUICK_VIEW;?>
							</a> -->
							
							<!-- <a href="product-detail.php?id=<?php echo encode($rowProS['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
								ADD TO CART
							</a> -->

							<button tyle="button" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04" onclick="addToCart('<?php echo $rowProS['id'];?>','<?php echo $rowProS['name'];?>')">ADD TO CART</button>

						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.php?id=<?php echo encode($rowProS['id'],LIAM_COINS_KEY);?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									<?php echo $rowProS['name'];?>
								</a>

								<span class="stext-105 cl3">
									<?php echo LIAM_COINS_CURRENCY.number_format($rowProS['price'],2);?>
								</span>
							</div>

						</div>
					</div>
				</div>
				<?php
			}
			?>

			</div>

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<?php

					if($totalPro > $e_page){
						$pageN = 0;
						if(isset($_GET['page'])){
							$pageN = $_GET['page']; 
						}else{
							$pageN = 1;
						}
						page_navi($totalPro,$pageN,$e_page,$query_str);
					}
					
				?>
			</div>
		</div>
	</div>
		

	<?php include_once('footer.php');?>

	<?php include_once('modal_product.php');?>

	<?php include_once('back_to_top.php');?>

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js?version=<?php echo date("YmdHis");?>"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script src="vendor/daterangepicker/daterangepicker.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script src="js/slick-custom.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js?version=<?php echo date("YmdHis");?>"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="js/main.js?version=<?php echo date("YmdHis");?>"></script>

</body>
</html>