<?php include_once("include/include_app.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact Us</title>
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
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Contact Us
			</span>

		</div>
	</div>

	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<!-- <div class="row p-b-148">
				<div class="col-md-12 col-lg-12">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-20 text-center">
							Get help from LiamCoins Customer Service
						</h3>

						<div class="stext-113 cl6 p-b-26">
							<p>
							LiamCoins is committed to ensuring a safe and secure online experience.  We are sorry you were unable to reset your password.  Below is useful information to help you navigate the password reset process and site.
							</p>
						</div>

					</div>
				</div>
			</div> -->
			<h3 class="mtext-111 cl2 p-b-20 text-center">
				Get help from LiamCoins Customer Service
			</h3>
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-30 p-t-30 p-b-30 p-lr-15-lg w-full-md" style="margin: 0 auto;">
				LiamCoins is committed to ensuring a safe and secure online experience.  We are sorry you were unable to reset your password.  Below is useful information to help you navigate the password reset process and site.
				</div>
			</div><br/>
			<div class="flex-w flex-tr ">
				<div class="size-210 bor10 p-lr-30 p-t-30 p-b-30 p-lr-15-lg w-full-md" style="margin: 0 auto;">
					<div id="ocsr_respDiv" class="dsd">
						<p>
							If you've been unable to reset your password using your current email address or phone number, try the following solutions:
						</p>
						<ul>
							<li style="list-style: disc;margin-left: 40px;">Make sure you're entering your username and password correctly</li>
							<li style="list-style: disc;margin-left: 40px;">Disable your browser's autocomplete feature as it may be filling in incorrect information</li>
							<li style="list-style: disc;margin-left: 40px;">If you're using a mobile device, disable predictive text</li>
							<li style="list-style: disc;margin-left: 40px;">Clear your browser's cache and cookies</li>
						</ul>
						<p>
						If you're still having issues, you'll need to register a new eBay account. When you create a new one, you'll no longer be able to access your old account, including your feedback, selling, and purchase history.
						</p>
						<p>
						If you'd like to purchase an item using Buy It Now, you can use guest checkout.</p>
						<p>
						<br>
						<strong>More actions:</strong>
						</p>
						<ul>
							<li style="list-style: disc;margin-left: 40px;"><a href="register.php" target="_blank">Register a new LiamCoins account</a></li>
						</ul>
					</div>
				</div>
			</div>
			<br/>
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-30 p-t-30 p-b-30 p-lr-15-lg w-full-md" style="margin: 0 auto;">
				<p class="p-b-20">Need more help?</p>
				<p>
				<img class="" src="images/icons/icon-email.png" alt="ICON"><span class="p-l-10"><a href="contact-us-form.php" target="_blank">Send us an email</a></span></p>
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