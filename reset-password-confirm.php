<?php 
	include_once("include/include_app.php");
	$keyrecaptcha = LIAM_COINS_KEY_GOOGLE;

	$runPage = 0;

	if(isset($_GET['id']) && $_GET['id'] != ""){
		$decodeLink = decode($_GET['id'],LIAM_COINS_KEY);
		$valLink = explode('|',$decodeLink);
		$resetID = $valLink[0];
		$resetToken = $valLink[1];
		$cus_email = $valLink[2];

		$sqlChkReset = "SELECT * FROM `lc_reset_password` WHERE 1 AND `cus_token` = '".$resetToken."' LIMIT 1";
		$quChkReset = mysqli_query($conn,$sqlChkReset);
		$rowReset = mysqli_fetch_array($quChkReset, MYSQLI_ASSOC);

		if($rowReset['id'] != ""){

			$to_time=strtotime(date("Y-m-d H:i:s"));
			$from_time=strtotime($rowReset['datetime']); 
			$checkTime = (int)round(abs($to_time - $from_time) / 60,2);
			
			if($checkTime <= 1440){
				if($rowReset['reset_pass'] == 0){
					$emailSub = explode('@',$rowReset['cus_email']);
					$emailSubF = substr($emailSub[0],0,1);
					$emailSubB = substr($emailSub[0],-1);
					$emailSubShow = $emailSubF.'***'.$emailSubB.'@'.$emailSub[1];
		
					$sqlChkCus = "SELECT * FROM `lc_customer` WHERE `cus_email`= '".$cus_email."' LIMIT 1";
					$quChkCus = mysqli_query($conn,$sqlChkCus);
					$rowCustomer = mysqli_fetch_array($quChkCus, MYSQLI_ASSOC);
				}else{
					header("Location:reset-password-expired.php?error=2");
				}
			}else{
				header("Location:reset-password-expired.php?error=1");
			}				
		}else{
			die();
		}

	}else{
		die();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<?php include_once('head_meta.php');?>
	<script src='https://www.google.com/recaptcha/api.js?hl=en'></script>
	<script> 
		function makeaction(){
				document.getElementById('submit').disabled = false;  
		}

		function check_password(){

			var pwdChk = $('#cus_password').val();
			var Atleast8 = new RegExp("^(?=.{8,})");
			var specialCharac = new RegExp("^(?=.*[!@#\$%\^&\*])");
			var numRegex = new RegExp("^(?=.*[0-9])");

			if(!Atleast8.test(pwdChk)){
				$('#resErrors').removeClass('hide');
				$('#resErrors').html('Your input was to short (at least 8 characters).');
			}else if(!specialCharac.test(pwdChk)){
				$('#resErrors').removeClass('hide');
				$('#resErrors').html('At least one or more special characters included.');
			}else if(!numRegex.test(pwdChk)){
				$('#resErrors').removeClass('hide');
				$('#resErrors').html('At least one or more numbers included.');
			}else{
				$('#resErrors').addClass('hide');
				$('#resErrors').html('');
			}
		}

		function validateForm(){

			var passwordRegex = new RegExp("^(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
			var pwdChk = $('#cus_password').val();

			if(!passwordRegex.test(pwdChk)){
				$('#cus_password').focus();
				return false;
			}

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


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md" style="margin: 0 auto;">
					<form name="frm" method="post" action="control/reset-password-confirm.php" onsubmit="return validateForm()">
						<h4 class="mtext-105 cl2 txt-center p-b-20">
							It's really you, <?php echo $rowCustomer['cus_fname'];?>
						</h4>
						<p class="text-center p-b-20">Enter your new password below.</p>
						<?php
							/*if(isset($_GET['action']) && $_GET['action'] != ""){
								if($_GET['action'] === "failure"){
									?>
										<div class="p-b-20">
											<ul class="msg-error" role="alert">
												<li><strong><?php echo ERROR;?>:</strong> Oops, that's not a match. Try again?</li>
											</ul>
										</div>
										<?php
								}
							}*/
						?>		
						<div class="bor8 m-b-20 how-pos4-parent" style="border: none;">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" style="margin-bottom: 0px;" type="password" id="cus_password" maxlength="20" name="cus_password" placeholder="Password" required onkeyup="check_password();">
							<img class="how-pos4 pointer-none" style="top: 16px;" src="images/icons/icon-password.png" alt="ICON">
							<small style="color: red;" class="hide" id="resErrors"></small>
						</div>

						<div class="m-b-20 how-pos4-parent text-center">
							<div style="display: inline-block;" class="g-recaptcha" data-callback="makeaction" data-sitekey="<?php echo $keyrecaptcha; ?>"></div>
						</div>

						<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
						<input type="hidden" name="_token2" value="<?php echo $_GET['id'];?>">
						<button type="submit" id="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" disabled>
							Continue
						</button>

						<div class="m-b-20 m-t-20 how-pos4-parent text-center">
							<a href="contact-us.php">Contact Support</a>
						</div>

					</form>
					
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