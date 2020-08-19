<?php 
	include_once("include/include_app.php");

	$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

	if (isset($_SESSION['qty'])) {
		$meQty = 0;
		foreach ($_SESSION['qty'] as $meItem) {
			$meQty = ((float)$meQty + (float)$meItem);
		}
	} else {
		$meQty = 0;
	}

	if (isset($_SESSION['cart']) && $itemCount > 0) {

		$itemIds = "";
		foreach ($_SESSION['cart'] as $itemId) {
			$itemIds = $itemIds . $itemId . ",";
		}

		$inputItems = rtrim($itemIds, ",");
		$meSql = "SELECT * FROM `lc_product` WHERE `id` in ({$inputItems})";
		$meQuery = mysqli_query($conn,$meSql);
		$meCount = mysqli_num_rows($meQuery);

	} else {
		$meCount = 0;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shoping Cart</title>
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
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				
			<?php if($itemCount >= 1){
			?>
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<form name="frmUpdateCart" method="post" action="control/updatecart.php">
						<div class="m-l-25 m-r--38 m-lr-0-xl">
							<div class="wrap-table-shopping-cart">
								<table class="table-shopping-cart">
									<tr class="table_head">
										<th class="column-1">Product</th>
										<th class="column-2"></th>
										<th class="column-3 text-center">Price</th>
										<th class="column-4">Quantity</th>
										<th class="column-5">Total</th>
									</tr>

									<?php
									$total_price = 0;
									$num = 0;
									while ($meResult = mysqli_fetch_assoc($meQuery)){

										$key = array_search($meResult['id'], $_SESSION['cart']);

										//if((float)$_SESSION['qty'][$key] > 0){

											$total_price = ((float)$total_price + ((float)$meResult['price'] * (float)$_SESSION['qty'][$key]));
										
											$proImages = '';
											if(!empty($meResult['images'])){
												$proImages = 'uploads/product/'.$meResult['images'];
											}else{
												$proImages = 'uploads/product/none.jpg';
											}
											
											?>

											<tr class="table_row <?php if((float)$_SESSION['qty'][$key] < 1){echo 'hide';}?>">
												<td class="column-1">
													<a href="control/removecart.php?itemId=<?php echo encode($meResult['id'],LIAM_COINS_KEY);?>">
														<div class="how-itemcart1">
															<img src="<?php echo $proImages;?>" alt="<?php echo $meResult['name'];?>">
														</div>
													</a>
												</td>
												<td class="column-2">	
													<a href="product-detail.php?id=<?php echo encode($meResult['id'],LIAM_COINS_KEY);?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04"><?php echo $meResult['name'];?></a>
												</td>
												<td class="column-3 text-center"><?php echo LIAM_COINS_CURRENCY.number_format($meResult['price'],2);?></td>
												<td class="column-4">
													<div class="wrap-num-product flex-w m-l-auto m-r-0">
														<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
															<i class="fs-16 zmdi zmdi-minus"></i>
														</div>
														<input class="mtext-104 cl3 txt-center num-product" style="border: none;" type="number" name="qty[<?php echo $num; ?>]" value="<?php echo $_SESSION['qty'][$key];?>">
														<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
															<i class="fs-16 zmdi zmdi-plus"></i>
														</div>
														<input type="hidden" name="arr_key_<?php echo $num; ?>" value="<?php echo $key; ?>">
													</div>
												</td>
												<td class="column-5"><?php echo LIAM_COINS_CURRENCY.number_format((float)$meResult['price']*(float)$_SESSION['qty'][$key],2);?></td>
											</tr>

											<?php 
										//}
										$num++;
									}
									?>

								</table>
							</div>

							<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="justify-content: center;">
								<!-- <div class="flex-w flex-m m-r-20 m-tb-5">
									<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
										
									<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
										Apply coupon
									</div>
								</div> -->
								<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
								<button type="submit" class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
									Update Cart
								</buttton>
							</div>
						</div>
					</form>
					</div>

					<div class="col-lg-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									<?php echo LIAM_COINS_CURRENCY.number_format($total_price, 2); ?>
								</span>
							</div>
						</div>

						<!-- <div class="flex-w flex-t bor12 p-t-15 p-b-30">
							<div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
							</div>

							<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
								<p class="stext-111 cl6 p-t-2">
									There are no shipping methods available. Please double check your address, or contact us if you need any help.
								</p>
								
								<div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>

									<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
										<select class="js-select2" name="time">
											<option>Select a country...</option>
											<option>USA</option>
											<option>UK</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>

									<div class="bor8 bg0 m-b-12">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
									</div>

									<div class="bor8 bg0 m-b-22">
										<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
									</div>
									
									<div class="flex-w">
										<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
											Update Totals
										</div>
									</div>
										
								</div>
							</div>
						</div> -->

						<div class="flex-w flex-t p-t-27 p-b-33">
							<div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
							</div>

							<div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									<?php echo LIAM_COINS_CURRENCY.number_format($total_price, 2); ?>
								</span>
							</div>
						</div>

						<a href="checkout.php"><button type="button" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout
						</button></a>
					</div>
				</div>
			<?php
			}else{
				?>
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="text-center">
						<p class="p-b-20"><img src="images/emtry_cart.png" style="width: 200px;"></p>
						<p class="p-b-20 stext-113 cl6">Your cart is currently empty.</p>
						<p class="p-b-20"><a href="index.php" class="hov-cl1">RETURN TO SHOP</a></p>
					</div>
				</div>
				
				<?php
			}?>

				
			</div>
		</div>
	</div>
		
	
	<?php include_once('footer.php');?>
	
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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js?version=<?php echo date("YmdHis");?>"></script>
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