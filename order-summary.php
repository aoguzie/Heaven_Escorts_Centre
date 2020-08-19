<?php 
	include_once("include/include_app.php");

	if(isset($_GET['orderID']) && $_GET['orderID'] != ""){

		$orderID = decode($_GET['orderID'],LIAM_COINS_KEY);

		$sqlCusOrder = "SELECT * FROM `lc_order` WHERE `order_number` = '".$orderID."' LIMIT 1";
		$quCusOrder = mysqli_query($conn,$sqlCusOrder);
		$rowCusOrder = mysqli_fetch_array($quCusOrder, MYSQLI_ASSOC);

		if($rowCusOrder['id'] === ""){
			header("Location:index.php");
		}

	}else{
		header("Location:index.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Order Summary</title>
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
				Order Summary
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">

					<div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
						<div class="m-l-25 m-r--38 m-lr-0-xl">

							<h4 class="mtext-109 cl2 p-b-40 text-center p-t-20">
								Thank you. Your order has been received.
							</h4>

							<div class="wrap-table-shopping-cart">
								<table class="table-shopping-cart">
									<tr class="table_head">
										<th class="column-1 text-center" style="width: 20%;">ORDER NUMBER</th>
										<th class="column-2 text-center" style="width: 20%;">DATE</th>
										<th class="column-3 text-center" style="width: 20%;">EMAIL:</th>
										<th class="column-4 text-center" style="width: 20%;">TOTAL</th>
										<th class="column-5 text-center" style="width: 20%;">PAYMENT METHOD</th>
									</tr>

									<tr class="table_row" style="height: 60px;">
										<td class="column-1 text-center" style="padding-bottom: 0px;"><?php echo $orderID;?></td>
										<td class="column-2 text-center" style="padding-bottom: 0px;"><?php echo substr($rowCusOrder['order_date'],0,10);?></td>
										<td class="column-3 text-center" style="padding-bottom: 0px;"><?php echo $rowCusOrder['bill_email'];?></td>
										<td class="column-4 text-center" style="padding-bottom: 0px;"><?php echo number_format($rowCusOrder['order_total'],2);?></td>
										<td class="column-5 text-center" style="padding-bottom: 0px;"><?php echo 'PayPal';?></td>
									</tr>

								</table>
							</div>

							<h4 class="mtext-109 cl2 p-b-40 text-center p-t-70">
								Order Details
							</h4>
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
									$sqlOrderDetail = "SELECT * FROM `lc_order_detail` WHERE `order_id` = '".$rowCusOrder['id']."' ORDER BY `id` ASC";
									$qyOrderDetail = mysqli_query($conn,$sqlOrderDetail);
									while ($rowOrderDetail = mysqli_fetch_assoc($qyOrderDetail)){

											$total_price = ((float)$total_price + ((float)$rowOrderDetail['pro_price']*(float)$rowOrderDetail['pro_qty']));
										
											$proImages = '';
											if(!empty($rowOrderDetail['pro_img'])){
												$proImages = 'uploads/product/'.$rowOrderDetail['pro_img'];
											}else{
												$proImages = 'uploads/product/none.jpg';
											}
											?>

											<tr class="table_row">
												<td class="column-1">
													<img src="<?php echo $proImages;?>" alt="<?php echo $rowOrderDetail['pro_name'];?>" width="60">
												</td>
												<td class="column-2">	
													<a href="product-detail.php?id=<?php echo encode($rowOrderDetail['id'],LIAM_COINS_KEY);?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04"><?php echo $rowOrderDetail['pro_name'];?></a>
												</td>
												<td class="column-3 text-center"><?php echo LIAM_COINS_CURRENCY.number_format($rowOrderDetail['pro_price'],2);?></td>
												<td class="column-4">
													<?php echo $rowOrderDetail['pro_qty'];?>
												</td>
												<td class="column-5"><?php echo LIAM_COINS_CURRENCY.number_format((float)$rowOrderDetail['pro_price']*(float)$rowOrderDetail['pro_qty'],2);?></td>
											</tr>

											<?php 
										//}
										$num++;
									}
									?>

								</table>
							</div>

							<div class="bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="justify-content: center;">
								<div class="p-t-40 p-b-40 m-l-40 m-r-40">
									<div class="flex-w flex-t bor12 p-b-27">
										<div class="size-208">
											<span class="stext-110 cl2">
												SUBTOTAL:
											</span>
										</div>

										<div class="size-209" style="text-align: right;">
											<span class="stext-110 cl2">
												<?php echo LIAM_COINS_CURRENCY.number_format($total_price, 2); ?>
											</span>
										</div>
									</div>

									<div class="flex-w flex-t p-t-27 bor12 p-b-27">

										<div class="size-208">
											<span class="stext-101 cl2">
												PAYMENT METHOD:
											</span>
										</div>

										<div class="size-209 p-t-1" style="text-align: right;">
											<span class="stext-110 cl2">
												PayPal
											</span>
										</div>

									</div>

									<div class="flex-w flex-t p-t-27 bor12 p-b-27">

										<div class="size-208">
											<span class="stext-101 cl2">
												PAYMENT STATUS:
											</span>
										</div>

										<div class="size-209 p-t-1" style="text-align: right;">
											<span class="stext-110 cl2">
												<?php 
													if($rowCusOrder['payment_status'] == 'Completed'){
														echo '<span style="color: #0d7d00;">'.$rowCusOrder['payment_status'].'<span>';
													}else if($rowCusOrder['payment_status'] == 'Pending'){
														echo '<span style="color: #0d31b7;">'.$rowCusOrder['payment_status'].'<span>';
													}else{
														echo '<span style="color: #ff0000;">'.$rowCusOrder['payment_status'].'<span>';
													}
												?>
											</span>
										</div>

									</div>

									<div class="flex-w flex-t p-t-27 bor12 p-b-27">
										<div class="size-208">
											<span class="stext-101 cl2">
												TOTAL:
											</span>
										</div>

										<div class="size-209 p-t-1" style="text-align: right;">
											<span class="stext-110 cl2">
												<?php echo LIAM_COINS_CURRENCY.number_format($total_price, 2); ?>
											</span>
										</div>
									</div>

									<br><br>

									<div class="row">
										<div class="col-12 col-lg-6">
											<div>
												<h4 class="mtext-109 cl2 p-b-20">
													Billing Address
												</h4>
												<?php if($rowCusOrder['bill_fname'] != ""){?><p><?php echo $rowCusOrder['bill_fname'].' '.$rowCusOrder['bill_lname'];?></p><?php }?>
												<?php if($rowCusOrder['bill_company'] != ""){?><p><?php echo $rowCusOrder['bill_company'];?></p><?php }?>
												<?php if($rowCusOrder['bill_address1'] != ""){?><p><?php echo $rowCusOrder['bill_address1'].' '.$rowCusOrder['bill_address2'];?></p><?php }?>
												<?php if($rowCusOrder['bill_city'] != ""){?><p><?php echo $rowCusOrder['bill_city'];?></p><?php }?>
												<?php if($rowCusOrder['bill_country'] != ""){?><p><?php echo $rowCusOrder['bill_country'];?></p><?php }?>
												<?php if($rowCusOrder['bill_zipcode'] != ""){?><p><?php echo $rowCusOrder['bill_zipcode'];?></p><?php }?>
												<?php if($rowCusOrder['bill_phone'] != ""){?><p><?php echo $rowCusOrder['bill_phone'];?></p><?php }?>
												<?php if($rowCusOrder['bill_email'] != ""){?><p><?php echo $rowCusOrder['bill_email'];?></p><?php }?>
											</div>
										</div>
										<div class="col-12 col-lg-6">
											<div>
												<h4 class="mtext-109 cl2 p-b-20">
													Shipping Address:
												</h4>
												<?php if($rowCusOrder['ship_fname'] != ""){?><p><?php echo $rowCusOrder['ship_fname'].' '.$rowCusOrder['ship_lname'];?></p><?php }?>
												<?php if($rowCusOrder['ship_company'] != ""){?><p><?php echo $rowCusOrder['ship_company'];?></p><?php }?>
												<?php if($rowCusOrder['ship_address1'] != ""){?><p><?php echo $rowCusOrder['ship_address1'].' '.$rowCusOrder['ship_address2'];?></p><?php }?>
												<?php if($rowCusOrder['ship_city'] != ""){?><p><?php echo $rowCusOrder['ship_city'];?></p><?php }?>
												<?php if($rowCusOrder['ship_country'] != ""){?><p><?php echo $rowCusOrder['ship_country'];?></p><?php }?>
												<?php if($rowCusOrder['ship_zipcode'] != ""){?><p><?php echo $rowCusOrder['ship_zipcode'];?></p><?php }?>
												<?php if($rowCusOrder['ship_phone'] != ""){?><p><?php echo $rowCusOrder['ship_phone'];?></p><?php }?>
												<?php if($rowCusOrder['ship_email'] != ""){?><p><?php echo $rowCusOrder['ship_email'];?></p><?php }?>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
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