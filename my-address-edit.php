<?php include_once("include/include_app.php");

if(!Login::check($_SESSION['cus_id'])){
	header("Location:login.php");
}else{
	if(isset($_SESSION['cus_token']) && $_SESSION['cus_token'] != ""){
		if(getTokenLogin($conn,$_SESSION['cus_id']) != $_SESSION['cus_token']){
			unset($_SESSION['cus_token']);
			header("Location:logout.php");
		}
	}
}

if(isset($_GET['action']) && $_GET['action'] != ""){

	$actionAdd = decode($_GET['action'],LIAM_COINS_KEY);
	$titlAdd = "";
	$tableDB = "";

	if($actionAdd === "bill" || $actionAdd === "ship"){

		$sqlCustomer = "SELECT * FROM `lc_customer` WHERE `id` = '".$_SESSION['cus_id']."' LIMIT 1";
		$quCustomer = mysqli_query($conn,$sqlCustomer);
		$rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);


		if($actionAdd === "bill"){
			$titlAdd = "Billing address";
			$tableDB = "lc_bill_addres";
		}

		if($actionAdd === "ship"){
			$titlAdd = "Shipping address";
			$tableDB = "lc_ship_addres";
		}

		$sqlCusAdd = "SELECT * FROM `".$tableDB."` WHERE `cus_id` = '".$rowCustomer['id']."' LIMIT 1";
		$quCusAdd = mysqli_query($conn,$sqlCusAdd);
		$rowCusAdd = mysqli_fetch_array($quCusAdd, MYSQLI_ASSOC);
		
	}else{
		header("Location:my-address.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo SHIP_ADDRESS;?></title>
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
			<a href="my-address.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo SHIP_ADDRESS;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>
			<span class="stext-109 cl4">
				<?php echo $titlAdd;?>
			</span>



		</div>
	</div>

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="">
						<h3 class="mtext-111 cl2 p-b-16 text-center">
							<?php echo $titlAdd;?>
						</h3>

						<div class="row p-t-30">
							<div class="col-md-4 col-lg-3 p-b-80">
								<?php include_once('account_menu.php')?>
							</div>
							<div class="col-md-8 col-lg-9 p-b-80">
							
							<form name="frmOrder" method="post" action="control/my-address.php">

								<div class="row">
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">FIRST NAME *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_fname" placeholder="FIRST NAME" required value="<?php if(isset($rowCusAdd['fname'])){echo $rowCusAdd['fname'];}?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">LAST NAME *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_lname" placeholder="LAST NAME" required value="<?php if(isset($rowCusAdd['lname'])){echo $rowCusAdd['lname'];}?>">
									</div>
									<div class="col-12">
										<label class="">COMPANY NAME (OPTIONAL)</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_company_name" placeholder="" value="<?php if(isset($rowCusAdd['company'])){echo $rowCusAdd['company'];}?>">
									</div>
									<div class="col-12">
										<label class="">STREET ADDRESS *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_address1" placeholder="House number and street name" required value="<?php if(isset($rowCusAdd['address1'])){echo $rowCusAdd['address1'];}?>">
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_address2" placeholder="Apartment, suite, unit etc. (optional)" value="<?php if(isset($rowCusAdd['address2'])){echo $rowCusAdd['address2'];}?>">
									</div>
									<div class="col-12">
										<label class="">TOWN / CITY *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_city" placeholder="" required value="<?php if(isset($rowCusAdd['city'])){echo $rowCusAdd['city'];}?>">
									</div>
									<div class="col-12 p-b-20">
										<label class="">COUNTY *</label>
										<select class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="background: none;
			border: 1px solid #dddddd;" name="bill_state" id="bill_state" required>
											<option value="Germany">Germany</option>
										</select>
									</div>
									<div class="col-12">
										<label class="">POSTCODE / ZIP *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_poscode" placeholder="" required value="<?php if(isset($rowCusAdd['zipcode'])){echo $rowCusAdd['zipcode'];}?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">PHONE *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="bill_phone" placeholder="" required value="<?php if(isset($rowCusAdd['phone'])){echo $rowCusAdd['phone'];}?>">
									</div>
									<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
										<label class="">EMAIL ADDRESS *</label>
										<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="email" name="bill_email" placeholder="" required value="<?php if(isset($rowCusAdd['email'])){echo $rowCusAdd['email'];}?>">
									</div>

									<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
									<input type="hidden" name="type_add" value="<?php echo $actionAdd;?>">
									<button id="btPayment" type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="width: 250px;justify-content: center;margin: 0 auto;">
										SAVE CHANGE
									</button>
									
								</div>
							</div>
						</form>
						</div>

					</div>
				</div>
			</div>
		</div>
	</section>	
	
		

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