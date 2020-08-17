<?php 
	include_once("include/include_app.php");

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

	

	if(isset($_SESSION['cus_id']) && $_SESSION['cus_id'] != ""){
		$sqlCustomer = "SELECT * FROM `lc_customer` WHERE `id` = '".$_SESSION['cus_id']."' LIMIT 1";
        $quCustomer = mysqli_query($conn,$sqlCustomer);
        $rowCustomer = mysqli_fetch_array($quCustomer, MYSQLI_ASSOC);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo MY_ACCOUNT;?></title>
	<?php include_once('head_meta.php');?>

	<script>
			function check_password(){

				var pwdChk = $('#cus_password_new').val();
				
				var Atleast8 = new RegExp("^(?=.{8,})");
				var specialCharac = new RegExp("^(?=.*[!@#\$%\^&\*])");
				var numRegex = new RegExp("^(?=.*[0-9])");

				console.log(Atleast8.test(pwdChk));
				
				if(Atleast8.test(pwdChk)){
					$('#p1f').addClass('hide');
					$('#p1s').removeClass('hide');
				}else{
					$('#p1f').removeClass('hide');
					$('#p1s').addClass('hide');
				}

				if(specialCharac.test(pwdChk)){
					$('#p2f').addClass('hide');
					$('#p2s').removeClass('hide');
				}else{
					$('#p2f').removeClass('hide');
					$('#p2s').addClass('hide');
				}

				if(numRegex.test(pwdChk)){
					$('#p3f').addClass('hide');
					$('#p3s').removeClass('hide');
				}else{
					$('#p3f').removeClass('hide');
					$('#p3s').addClass('hide');
				}
			}

			function check_confirmpassword(){

				var pwdChk = $('#cus_password_new').val();
				var pwdChk2 = $('#cus_password_confirm').val();

				if(pwdChk != pwdChk2){
					$('#cus_password_confirm').focus();
					$('#p4f').removeClass('hide');
					$('#p4s').addClass('hide');
				}else{
					$('#p4f').addClass('hide');
					$('#p4s').removeClass('hide');
				}

			}

			function validateForm(){

				var pwdCurrent = $('#cus_password').val();

				if(pwdCurrent.length > 0){
					var passwordRegex = new RegExp("^(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
					var pwdChk = $('#cus_password_new').val();
					var pwdChk2 = $('#cus_password_confirm').val();
			
					if(!passwordRegex.test(pwdChk)){
						$('#cus_password_new').focus();
						return false;
					}
					
					if(pwdChk != pwdChk2){
						$('#cus_password_confirm').focus();
						return false;
					}
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
	
	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				<?php echo HOME;?>
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				<?php echo MY_ACCOUNT;?>
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
							<?php echo MY_ACCOUNT;?>
						</h3>

						<?php
							if(isset($_GET['action']) && $_GET['action'] != ""){

								if($_GET['action'] === "failure"){
									$msgErrors = "";
									if(isset($_GET['error']) && $_GET['error'] != ""){
										if($_GET['error'] == 1){$msgErrors = ' Your current password is incorrect.';}
										else if($_GET['error'] == 2){$msgErrors = ' New passwords do not match.';}
										else if($_GET['error'] == 3){$msgErrors = ' After changing your password within 24 hours, your account will not be able to change anything.';}
										else{}
									}
									?>
									<ul class="msg-error" role="alert">
										<li><strong><?php echo ERROR;?>:</strong><?php echo $msgErrors;?></li>
									</ul>
									<?php
								}else if($_GET['action'] === "success"){
									?>
									<ul class="msg-success" role="alert">
										<li><strong>Account details changed successfully.</strong></li>
									</ul>
									<?php
								}
							}
						?>

						<div class="row p-t-30">
							<div class="col-md-4 col-lg-3 p-b-80">
								<?php include_once('account_menu.php')?>
							</div>
							<div class="col-md-8 col-lg-9 p-b-80">
								<form name="frmAccount" method="post" action="control/my-account.php" onsubmit="return validateForm()">
									<div class="row">
										<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
											<label class="">USER NAME</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_username" placeholder="USER NAME" required value="<?php echo $rowCustomer['cus_username'];?>" readonly>
										</div>
										<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
											<label class="">EMAIL</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_email" placeholder="EMAIL" required value="<?php echo $rowCustomer['cus_email'];?>" readonly>
										</div>
										<div class="col-12 hide">
											<label class="">COMPANY</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_company" placeholder="COMPANY NAME" required value="<?php echo $rowCustomer['cus_company'];?>">
										</div>
										<div class="col-12 p-b-20">
											<label class="">TITLE *</label>
											<select class="stext-111 cl2 plh3 size-116 p-l-30 p-r-30" style="background: none;
				border: 1px solid #dddddd;" name="cus_title" id="cus_title" required>
												<option value="Mr" <?php if($rowCustomer['cus_title'] === 'Mr'){echo 'selected';}?>>Mr</option>
												<option value="Mrs" <?php if($rowCustomer['cus_title'] === 'Mrs'){echo 'selected';}?>>Ms</option>
												<option value="Dr" <?php if($rowCustomer['cus_title'] === 'Dr'){echo 'selected';}?>>Dr</option>
												<option value="Prof" <?php if($rowCustomer['cus_title'] === 'Prof'){echo 'selected';}?>>Prof</option>
												<option value="Prof. Dr" <?php if($rowCustomer['cus_title'] === 'Prof. Dr'){echo 'selected';}?>>Prof. Dr</option>
											</select>
										</div>
										<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
											<label class="">FIRST NAME *</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_fname" placeholder="FIRST NAME" required value="<?php echo $rowCustomer['cus_fname'];?>">
										</div>
										<div class="col-12 col-sm-6 col-xl-6 col-lg-6">
											<label class="">LAST NAME *</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_lname" placeholder="LAST NAME" required value="<?php echo $rowCustomer['cus_lname'];?>">
										</div>

										<div class="col-12">
											<label class="">PHONE NUMBER *</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="cus_phone" placeholder="PHONE NUMBER" required value="<?php echo $rowCustomer['cus_phone'];?>">
										</div>

										<div class="col-12 hide">
											<label class="">REFERNCES</label>
											<textarea class="stext-111 cl2 plh3 size-124 p-lr-30 p-tb-15" name="cus_references" placeholder="REFERNCES"><?php echo stripslashes($rowCustomer['cus_references']);?></textarea>
										</div>
										
									</div>

									<h3 class="mtext-111 cl2 p-b-16 p-t-20 p-b-20">
										PASSWORD CHANGE
									</h3>

									<div class="row">
										<div class="col-12">
											<label class="">CURRENT PASSWORD (LEAVE BLANK TO LEAVE UNCHANGED)</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="cus_password" id="cus_password" placeholder="">
										</div>
										<div class="col-12 p-b-20">
											<p class="p-b-10">Choose a password meeting the following criteria</p>
											<p><span id="p1f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p1s" class="hide"><img src="images/icon_check.jpg" width="18"></span> Your input was to short (at least 8 characters).</p>
											<p><span id="p2f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p2s" class="hide"><img src="images/icon_check.jpg" width="18"></span> At least one or more special characters included.</p>
											<p><span id="p3f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p3s" class="hide"><img src="images/icon_check.jpg" width="18"></span> At least one or more numbers included.</p>
											<p><span id="p4f"><img src="images/icon_uncheck.jpg" width="18"></span><span id="p4s" class="hide"><img src="images/icon_check.jpg" width="18"></span> Confirm new password.</p>
										</div>
										<div class="col-12">
											<label class="">NEW PASSWORD (LEAVE BLANK TO LEAVE UNCHANGED)</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="cus_password_new" id="cus_password_new" placeholder="" onkeyup="check_password();">
										</div>
										<div class="col-12">
											<label class="">CONFIRM NEW PASSWORD</label>
											<input class="stext-111 cl2 plh3 size-116 p-lr-18" type="password" name="cus_password_confirm" id="cus_password_confirm" placeholder="" onkeyup="check_confirmpassword();">
										</div>
									</div>

									<input type="hidden" name="_token" value="<?php echo Token::generate();?>">
									<button id="btPayment" type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" style="width: 250px;justify-content: center;margin: 0 auto;">
										SAVE CHANGE
									</button>
								</form>

							</div>
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