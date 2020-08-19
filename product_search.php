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

	if(isset($_GET['keyword']) && $_GET['keyword'] != ""){
		$sqlPro = "SELECT * FROM `lc_product` WHERE `status` = '1' AND `name` LIKE '%".$_GET['keyword']."%' ORDER BY id DESC";
		$quPro = mysqli_query($conn,$sqlPro);
		$totalPro = mysqli_num_rows($quPro);
		$query_str = '?keyword='.$_GET['keyword'];
	}else{
		header("Location:index.php");
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
		<div class="bread-crumb flex-w p-l-0 p-r-0 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">
				<?php echo PRODUCT_SEARCH;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</span>
			<span class="stext-109 cl4">
				<?php echo $_GET['keyword'];?>
			</span>
		</div>
	</div>

	
	<!-- Product -->
	<div class="bg0 m-t-23 p-b-140 p-t-50">
		<div class="container">

			<?php
			if($totalPro > 0){

				?>
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
								<img src="<?php echo $proImages;?>" alt="<?php echo $rowProS['name'];?>">

								<!-- <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
									Quick View
								</a> -->
								<a href="product-detail.php?id=<?php echo encode($rowProS['id'],LIAM_COINS_KEY);?>" class="block2-btn flex-c-m stext-103 cl2 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">
									<?php echo QUICK_VIEW;?>
								</a>
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
				<?php
			}else{
				?>
				<!-- Content page -->
				<div class="row p-b-30 p-t-30">
					<div class="col-md-12 col-lg-12">
						<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
							<h3 class="mtext-111 cl2 p-b-16 text-center">
								No products were found matching your selection.
							</h3>
						</div>
					</div>
				</div>

				<?php
			}
			?>

			

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

	<!-- <script src="js/js.scrollPagination.js?version=<?php echo date("YmdHis");?>"></script>
	<script>
		$(document).loadScrollData(0,{
			limit		:	8,
			cat_id      :   '<?php echo $_GET['cat_id'];?>',
			catsub_id   :   '<?php echo $_GET['catsub_id'];?>',
			listingId	:	"#get-list-view",
			loadMsgId	:	'#load-msg',
			ajaxUrl		:	'include/load_product.php',
			loadingMsg	:	'<div class="alert alert-warning p-1 text-center"><i class="fa fa-fw fa-spin fa-spinner"></i>Please Wait...!</div>',
		});
	</script> -->

</body>
</html>