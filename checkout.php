<?php 
	include_once("include/include_app.php");

	$keyrecaptcha = LIAM_COINS_KEY_GOOGLE;

	$itemCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

	if($itemCount <= 0){
		header("Location:shoping-cart.php");
	}

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

	$tokenSet = Token::generate();

	if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){

		$sqlCusBill = "SELECT * FROM `lc_bill_addres` WHERE `cus_id` = '".$_SESSION['cus_id']."' LIMIT 1";
		$quCusBill = mysqli_query($conn,$sqlCusBill);
		$rowCusBill = mysqli_fetch_array($quCusBill, MYSQLI_ASSOC);

		$sqlCusShip = "SELECT * FROM `lc_ship_addres` WHERE `cus_id` = '".$_SESSION['cus_id']."' LIMIT 1";
		$quCusShip = mysqli_query($conn,$sqlCusShip);
		$rowCusShip = mysqli_fetch_array($quCusShip, MYSQLI_ASSOC);

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Shoping Cart</title>
	<?php include_once('head_meta.php');?>
	<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
	<script> 
		function makeaction(){
			document.getElementById('submit').disabled = false;  
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

	<script>
	function chk_shipaddress(){
		// Get the checkbox
		var checkBox = document.getElementById("chkshipaddress");
		// Get the output text
		var boxShipAdd = document.getElementById("boxShipAdd");

		// If the checkbox is checked, display the output text
		if (checkBox.checked == true){
			boxShipAdd.style.display = "block";
			document.getElementById("type_address").value= "0";

			document.getElementById("ship_fname").required = true;
			document.getElementById("ship_lname").required = true;
			document.getElementById("ship_address1").required = true;
			document.getElementById("ship_city").required = true;
			document.getElementById("ship_state").required = true;
			document.getElementById("ship_poscode").required = true;
			document.getElementById("ship_phone").required = true;
			document.getElementById("ship_email").required = true;

		} else {
			boxShipAdd.style.display = "none";
			document.getElementById("type_address").value= "1";

			document.getElementById("ship_fname").required = false;
			document.getElementById("ship_lname").required = false;
			document.getElementById("ship_address1").required = false;
			document.getElementById("ship_city").required = false;
			document.getElementById("ship_state").required = false;
			document.getElementById("ship_poscode").required = false;
			document.getElementById("ship_phone").required = false;
			document.getElementById("ship_email").required = false;
		}
	}

	function chk_login(){

		var frmLogin = document.getElementById("frmLogin");
		frmLogin.style.display = "block";
	}
	

	function chk_termcondition(){
		// Get the checkbox
		var checkBox = document.getElementById("chktermcondition");
		// Get the output text
		var btPayment = document.getElementById("btPayment");

		// If the checkbox is checked, display the output text
		if (checkBox.checked == true){
			document.getElementById("btPayment").disabled = false;
		} else {
			document.getElementById("btPayment").disabled = true;
		}
	}
	</script>
	</header>

	<?php include_once('cart.php');?>

	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Checkout
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<div class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<?php 

				if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){}
				else{
				?>
				<div class="col-lg-10 col-xl-10 m-lr-auto m-b-60">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="">
							<h5 class="mtext-109 cl2 p-t-30 p-b-30" style="text-align: center;">
								RETURNING CUSTOMER? <a href="javascript:void();" onclick="chk_login()" class="hov-cl1">CLICK HERE TO LOGIN</a>
							</h5>
							<form name="frmLogin" id="frmLogin" method="post" action="control/login.php" style="display:none;">
								<div class="row p-b-20">
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">USERNAME *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_email" placeholder="Email" required>
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">PASSWORD *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="cus_password" placeholder="Password" required>
									</div>

									<div class="m-b-20 how-pos4-parent text-center" style="inline-size: -webkit-fill-available;">
										<div style="display: inline-block;" class="g-recaptcha" data-callback="makeaction" data-sitekey="<?php echo $keyrecaptcha; ?>"></div>
									</div>

									<div class="col-12 text-center">
										<input type="hidden" name="redirect" value="checkout.php">
										<input type="hidden" name="_token" value="<?php echo $tokenSet;?>">
										<button type="submit" id="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer"  style="width: 250px;justify-content: center;margin: 0 auto;" disabled>
											Login
										</button>
									</div>
								</div>
							</form>
							<?php
								if(isset($_GET['action']) && $_GET['action'] != ""){
									if($_GET['action'] === "failure"){
										?>
										<ul class="msg-error" role="alert">
											<li><strong><?php echo ERROR;?>:</strong> <?php echo LOGIN_ERROR_MSG;?></li>
										</ul>
										<?php
									}
								}
							?>
						</div>
					</div>
				</div>
				<?php
				}
				?>

				<form name="frmOrder" method="post" action="control/checkout.php" name="checkoutForm">
					<div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
						<div class="m-l-25 m-r--38 m-lr-0-xl">

							<h4 class="mtext-109 cl2 p-b-30" style="text-align: center;">
								Billing details
							</h4>

							<div class="row">
								<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
									<label class="">FIRST NAME *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_fname" placeholder="FIRST NAME" required value="<?php if(isset($rowCusBill['fname'])){echo $rowCusBill['fname'];}?>">
								</div>
								<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
									<label class="">LAST NAME *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_lname" placeholder="LAST NAME" required value="<?php if(isset($rowCusBill['lname'])){echo $rowCusBill['lname'];}?>">
								</div>
								<div class="col-12">
									<label class="">COMPANY NAME (OPTIONAL)</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_company_name" placeholder="" value="<?php if(isset($rowCusBill['company'])){echo $rowCusBill['company'];}?>">
								</div>
								<div class="col-12">
									<label class="">STREET ADDRESS *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_address1" placeholder="House number and street name" required value="<?php if(isset($rowCusBill['address1'])){echo $rowCusBill['address1'];}?>">
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($rowCusBill['address2'])){echo $rowCusBill['address2'];}?>">
								</div>
								<div class="col-12">
									<label class="">TOWN / CITY *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_city" placeholder="" required value="<?php if(isset($rowCusBill['city'])){echo $rowCusBill['city'];}?>">
								</div>
								<div class="col-12">
									<label class="">STATE / COUNTY *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_state" placeholder="" required value="<?php if(isset($rowCusBill['country'])){echo $rowCusBill['country'];}?>">
								</div>
								<div class="col-12">
									<label class="">POSTCODE / ZIP *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_poscode" placeholder="" required value="<?php if(isset($rowCusBill['zipcode'])){echo $rowCusBill['zipcode'];}?>">
								</div>
								<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
									<label class="">PHONE *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_phone" placeholder="" required value="<?php if(isset($rowCusBill['phone'])){echo $rowCusBill['phone'];}?>">
								</div>
								<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
									<label class="">EMAIL ADDRESS *</label>
									<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="bill_email" placeholder="" required value="<?php if(isset($rowCusBill['email'])){echo $rowCusBill['email'];}?>">
								</div>
								
							</div>

							<div class="col-12 text-center p-t-30 p-b-30">
								<input type="checkbox" name="chkshipaddress" id="chkshipaddress" onclick="chk_shipaddress()" value="1" style="display: inline-block;"> <label style="display: inline-block;">Ship to a different address?</label>
							</div>

							<div id="boxShipAdd" style="display:none">
								<?php 
								
									$fname = '';
									$lname = '';
									$company = '';
									$address1 = '';
									$address2 = '';
									$city = '';
									$zipcode = '';
									$country = '';
									$phone = '';
									$email = '';

									if(isset($rowCusShip['id']) && $rowCusShip['id'] != ""){
										$fname = $rowCusShip['fname'];
										$lname = $rowCusShip['lname'];
										$company = $rowCusShip['company'];
										$address1 = $rowCusShip['address1'];
										$address2 = $rowCusShip['address2'];
										$city = $rowCusShip['city'];
										$zipcode = $rowCusShip['zipcode'];
										$country = $rowCusShip['country'];
										$phone = $rowCusShip['phone'];
										$email = $rowCusShip['email'];
									}else{
										if(isset($rowCusBill['id']) && $rowCusBill['id'] != ""){
											$fname = $rowCusBill['fname'];
											$lname = $rowCusBill['lname'];
											$company = $rowCusBill['company'];
											$address1 = $rowCusBill['address1'];
											$address2 = $rowCusBill['address2'];
											$city = $rowCusBill['city'];
											$zipcode = $rowCusBill['zipcode'];
											$country = $rowCusBill['country'];
											$phone = $rowCusBill['phone'];
											$email = $rowCusBill['email'];
										}
									}
								?>
								<div class="row">
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">FIRST NAME *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_fname" id="ship_fname" placeholder="FIRST NAME" value="<?php echo $fname;?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">LAST NAME *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_lname" id="ship_lname" placeholder="LAST NAME" value="<?php echo $lname;?>">
									</div>
									<div class="col-12">
										<label class="">COMPANY NAME (OPTIONAL)</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_company_name" placeholder="" value="<?php echo $company;?>">
									</div>
									<div class="col-12">
										<label class="">STREET ADDRESS *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_address1" id="ship_address1" placeholder="House number and street name" value="<?php echo $address1;?>">
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php echo $address2;?>">
									</div>
									<div class="col-12">
										<label class="">TOWN / CITY *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_city" id="ship_city" placeholder="" value="<?php echo $city;?>">
									</div>
									<div class="col-12">
										<label class="">STATE / COUNTY *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_state" id="ship_state" placeholder="" value="<?php echo $country;?>">
									</div>
									<div class="col-12">
										<label class="">POSTCODE / ZIP *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_poscode" id="ship_poscode" placeholder="" value="<?php echo $zipcode;?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">PHONE *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="ship_phone" id="ship_phone" placeholder="" value="<?php echo $phone;?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">EMAIL ADDRESS *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="ship_email" id="ship_email" placeholder="" value="<?php echo $email;?>">
									</div>
									
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-10 col-xl-10 m-lr-auto m-b-50">
						<div class="m-l-25 m-r--38 m-lr-0-xl">
							<h4 class="mtext-109 cl2 p-b-40 text-center p-t-20">
								Your order
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
													<img src="<?php echo $proImages;?>" alt="<?php echo $meResult['name'];?>" width="60">
													<!-- <div class="how-itemcart1">
														<img src="<?php echo $proImages;?>" alt="<?php echo $meResult['name'];?>">
													</div> -->
												</td>
												<td class="column-2">	
													<a href="product-detail.php?id=<?php echo encode($meResult['id'],LIAM_COINS_KEY);?>" class="header-cart-item-name m-b-18 hov-cl1 trans-04"><?php echo $meResult['name'];?></a>
												</td>
												<td class="column-3 text-center"><?php echo LIAM_COINS_CURRENCY.number_format($meResult['price'],2);?></td>
												<td class="column-4">
													<?php echo $_SESSION['qty'][$key];?>
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

							<div class="bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="justify-content: center;">
								<div class="p-t-40 p-b-40 m-l-40 m-r-40">
									<div class="flex-w flex-t bor12 p-b-27">
										<div class="size-208">
											<span class="stext-110 cl2">
												Subtotal:
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
												Total:
											</span>
										</div>

										<div class="size-209 p-t-1" style="text-align: right;">
											<span class="stext-110 cl2">
												<?php echo LIAM_COINS_CURRENCY.number_format($total_price, 2); ?>
											</span>
										</div>
									</div>

									<div class="flex-w flex-t p-t-27 bor12 p-b-27">

										<div class="size-208">
											<span class="stext-101 cl2">
												PAYPAL:
											</span>
										</div>

										<div class="size-209 p-t-1">
											<span class="stext-110 cl2">
												<img src="images/AM_mc_vs_dc_ae.jpg" width="180"> <br><a href="https://www.paypal.com/in/webapps/mpp/home" target="_blank" class="hov-cl1"><span>What Is PayPal?</span></a><br>
												<small>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</small>
											</span>
										</div>

									</div>

									<br><br>

									<p style="text-align: center;">
										Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="terms-and-condition.php" target="_blank" class="hov-cl1">privacy policy.</a>
									</p>

									<br><br>

									<p style="text-align: center;">
									<input type="checkbox" name="chktermcondition" id="chktermcondition" onclick="chk_termcondition()" value="1" style="display: inline-block;"> <label style="display: inline-block;">I HAVE READ AND AGREE TO THE WEBSITE<a href="terms-and-condition.php" target="_blank" class="hov-cl1">TERMS AND CONDITIONS *</a></label>
										
									</p>

									<br><br>

									<input type="hidden" name="_token" value="<?php echo $tokenSet;?>">
									<input type="hidden" id="type_address" name="type_address" value="1">
									<button id="btPayment" type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="width: 250px;justify-content: center;margin: 0 auto;" disabled>
										Proceed to Payment
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
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