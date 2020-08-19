<?php
	include_once("include/include_app.php");

	if(isset($_GET['id']) && $_GET['id'] != ""){

		$pID = decode($_GET['id'],LIAM_COINS_KEY);
	  
		$quPro = mysqli_query($conn, "SELECT * FROM `lc_product` WHERE `id` = '".$pID."' AND `status` = '1' LIMIT 1");
		$rowPro = mysqli_fetch_array($quPro, MYSQLI_ASSOC);
		if($rowPro){
		  $pro_id= $rowPro['id'];
		}else{
		  header("Location:index.php?action=failed");
		}
	  }else{
		header("Location:index.php?action=failed");
	  }
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Product Detail - <?php echo $rowPro['name'];?></title>
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
		<div class="bread-crumb flex-w p-l-0 p-r-0 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<a href="product.php?cat_id=<?php echo encode($rowPro['category'],LIAM_COINS_KEY);?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo get_category_name($conn,$rowPro['category']);?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<!-- <a href="product.php?cat_id=<?php echo encode($rowPro['category'],LIAM_COINS_KEY);?>&catsub_id=<?php echo encode($rowPro['category_sub'],LIAM_COINS_KEY);?>" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo get_category_sub_name($conn,$rowPro['category_sub']);?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a> -->

			<span class="stext-109 cl4">
				<?php echo $rowPro['name'];?>
			</span>
		</div>
	</div>
		

	<!-- Product Detail -->
	<section class="sec-product-detail bg0 p-t-65 p-b-60">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-lg-7 p-b-30">
					<div class="p-l-25 p-r-30 p-lr-0-lg">
						<div class="wrap-slick3 flex-sb flex-w">
							<div class="wrap-slick3-dots"></div>
							<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

							<?php 
								$proImages = '';
								if(!empty($rowPro['images'])){
									$proImages = 'uploads/product/'.$rowPro['images'];
								}else{
									$proImages = 'uploads/product/none.jpg';
								}
							?>

							<div class="slick3 gallery-lb">
								<div class="item-slick3" data-thumb="<?php echo $proImages;?>">
									<div class="wrap-pic-w pos-relative">
										<img src="<?php echo $proImages;?>" alt="<?php echo $rowPro['name'];?>">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="<?php echo $proImages;?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<!-- <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>

								<div class="item-slick3" data-thumb="images/product-01.jpg">
									<div class="wrap-pic-w pos-relative">
										<img src="images/product-01.jpg" alt="IMG-PRODUCT">

										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
					
				<div class="col-md-6 col-lg-5 p-b-30">
					<div class="p-r-50 p-t-5 p-lr-0-lg">
						<h4 class="mtext-105 cl2 js-name-detail p-b-14">
							<?php echo $rowPro['name'].", ".$rowPro['age'];?>
						</h4>

						<span class="mtext-106 cl2">
							<?php //echo LIAM_COINS_CURRENCY.number_format($rowPro['price'],2);?>
						</span>

						<p class="stext-102 cl3 p-t-23">
							<?php echo stripslashes($rowPro['description']);?>
                        </p>

						<!--  -->
						<div class="p-t-33">
							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<!-- <div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div> -->

									<!-- <button tyle="button" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04" onclick="addToCart('<?php echo $rowPro['id'];?>','<?php echo $rowPro['name'];?>')">
										<?php echo ADD_TO_CART;?>
									</button> -->
								</div>
							</div>	
						</div>

					</div>
				</div>
			</div>

			<div class="bor10 m-t-50 p-t-43 p-b-40">
				<!-- Tab01 -->
				<div class="tab01">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item p-b-10">
							<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
						</li>

						<!-- <li class="nav-item p-b-10">
							<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
						</li> -->
					</ul>

					<!-- Tab panes -->
					<div class="tab-content p-t-43">
						<!-- - -->
						<div class="tab-pane fade show active" id="description" role="tabpanel">
							<div class="how-pos2 p-lr-15-md">
								<?php echo stripslashes($rowPro['detail']);?>
							</div>
						</div>

						
						<!-- - -->
						<div class="tab-pane fade" id="reviews" role="tabpanel">
							<div class="row">
								<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
									<div class="p-b-30 m-lr-15-sm">
										<!-- Review -->
										<!-- <div class="flex-w flex-t p-b-68">
											<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
												<img src="images/avatar-01.jpg" alt="AVATAR">
											</div>

											<div class="size-207">
												<div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														Ariana Grande
													</span>

													<span class="fs-18 cl11">
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star"></i>
														<i class="zmdi zmdi-star-half"></i>
													</span>
												</div>

												<p class="stext-102 cl6">
													Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
												</p>
											</div>
										</div> -->
										
										<!-- Add review -->
										<!-- <form class="w-full">
											<h5 class="mtext-108 cl2 p-b-7">
												Add a review
											</h5>

											<p class="stext-102 cl6">
												Your email address will not be published. Required fields are marked *
											</p>

											<div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>

												<span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rating">
												</span>
											</div>

											<div class="row p-b-25">
												<div class="col-12 p-b-5">
													<label class="stext-102 cl3" for="review">Your review</label>
													<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="name">Name</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
												</div>

												<div class="col-sm-6 p-b-5">
													<label class="stext-102 cl3" for="email">Email</label>
													<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
												</div>
											</div>

											<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
												Submit
											</button>
										</form> -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
			<span class="stext-107 cl6 p-lr-25">
				SKU: JAK-01
			</span>

			<span class="stext-107 cl6 p-lr-25">
				Categories: Jacket, Men
			</span>
		</div> -->
	</section>

	<?php include_once('related_products.php');?>
	
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