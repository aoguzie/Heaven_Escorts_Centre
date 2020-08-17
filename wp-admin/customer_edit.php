<?php 
  include_once("include/include_app.php");
  
  $typeMode = '';
  $mode = '';
  $cus_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    if(isset($_GET['cus_id']) && $_GET['cus_id'] != ""){

      $typeMode = 'Update';
      $mode = 'update';
      $cus_id = decode($_GET['cus_id'],LIAM_COINS_KEY);
      
      $sqlCusE = "SELECT * FROM `lc_customer` WHERE `id` = '".$cus_id."' LIMIT 1";
      $quCusE = mysqli_query($conn,$sqlCusE);
      $rowCusE = mysqli_fetch_array($quCusE, MYSQLI_ASSOC);

    }else{
      header("Location:customers.php");
    }
  }else{
    header("Location:customers.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<meta charset="UTF-8" />
<?php include_once('header_meta.php');?>

<script>
function isNumberKey(evt){
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 
    && (charCode < 48 || charCode > 57))
      return false;

  return true;
}

</script>

</head>
<body>

<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="customers.php" class="tip-bottom">Customers</a> <a href="#" class="current"><?php echo $typeMode;?> Customers</a> </div>
  <h1><?php echo $typeMode;?> Customers</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <?php 
        if(isset($_GET['error']) && $_GET['error'] != ""){
          $errorMSG = '';
          if($_GET['error'] === "username"){$errorMSG = "This Username : ".$_GET['val']." already exists";}
          else if($_GET['error'] === "email"){$errorMSG = "This Email : ".$_GET['val']." already exists";}
          ?>
          <div class="alert alert-error alert-block"> 
            <a class="close" data-dismiss="alert" href="#">×</a>
            <h4 class="alert-heading">Error!</h4>
            <?php echo $errorMSG;?>
          </div>
          <?php
        }
      ?>
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Customers Info</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/customers.php" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Username :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_username" placeholder="Username" value="<?php if(isset($rowCusE['cus_username'])){echo $rowCusE['cus_username'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Company :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_company" placeholder="Company" value="<?php if(isset($rowCusE['cus_company'])){echo $rowCusE['cus_company'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Title</label>
              <div class="controls">
                <select name="cus_title">
                  <option value="Mr" <?php if(isset($rowCusE['cus_title']) && $rowCusE['cus_title'] == 'Mr'){echo 'selected';}?>>Mr</option>
                  <option value="Ms" <?php if(isset($rowCusE['cus_title']) && $rowCusE['cus_title'] == 'Ms'){echo 'selected';}?>>Ms</option>
                  <option value="Dr" <?php if(isset($rowCusE['cus_title']) && $rowCusE['cus_title'] == 'Dr'){echo 'selected';}?>>Dr</option>
                  <option value="Prof" <?php if(isset($rowCusE['cus_title']) && $rowCusE['cus_title'] == 'Prof'){echo 'selected';}?>>Prof</option>
                  <option value="Prof. Dr" <?php if(isset($rowCusE['cus_title']) && $rowCusE['cus_title'] == 'Prof. Dr'){echo 'selected';}?>>Prof. Dr</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">First name :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_fname" placeholder="First name" value="<?php if(isset($rowCusE['cus_fname'])){echo $rowCusE['cus_fname'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Last name :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_lname" placeholder="Last name" value="<?php if(isset($rowCusE['cus_lname'])){echo $rowCusE['cus_lname'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Phone :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_phone" placeholder="Phone" value="<?php if(isset($rowCusE['cus_phone'])){echo $rowCusE['cus_phone'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_email" placeholder="Email" value="<?php if(isset($rowCusE['cus_email'])){echo $rowCusE['cus_email'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">References :</label>
              <div class="controls">
                <textarea class="span11" name="cus_references"><?php if(isset($rowCusE['cus_references'])){echo strip_tags(stripslashes($rowCusE['cus_references']));}?></textarea>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="cus_status">
                  <option value="1" <?php if(isset($rowCusE['status']) && $rowCusE['status'] == '1'){echo 'selected';}?>>Enable</option>
                  <option value="0" <?php if(isset($rowCusE['status']) && $rowCusE['status'] == '0'){echo 'selected';}?>>Disable</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Confirm Email</label>
              <div class="controls">
                <select name="confirm_email">
                  <option value="1" <?php if(isset($rowCusE['confirm_email']) && $rowCusE['confirm_email'] == '1'){echo 'selected';}?>>Confirmed</option>
                  <option value="0" <?php if(isset($rowCusE['confirm_email']) && $rowCusE['confirm_email'] == '0'){echo 'selected';}?>>Not yet Confirm</option>
                </select>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Changes Password :</label>
              <div class="controls">
                <input type="text" class="span11" name="cus_password" placeholder="" value="">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Customer Banned</label>
              <div class="controls">
                <select name="cus_lock">
                  <option value="1" <?php if(isset($rowCusE['cus_lock']) && $rowCusE['cus_lock'] == '1'){echo 'selected';}?>>Banned</option>
                  <option value="0" <?php if(isset($rowCusE['cus_lock']) && $rowCusE['cus_lock'] == '0'){echo 'selected';}?>>Unbanned<option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="cus_id" value="<?php if($cus_id != ""){echo encode($cus_id,LIAM_COINS_KEY);}?>"/>
              <a href="customers.php"><button type="button" class="btn btn-danger">Cancel</button></a>
              <button type="submit" class="btn btn-success"> Save </button></a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div></div>

<?php include_once("footer.php");?>

<script src="js/jquery.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.ui.custom.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-colorpicker.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-datepicker.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.toggle.buttons.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/masked.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.uniform.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/select2.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.form_common.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/wysihtml5-0.3.0.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.peity.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap-wysihtml5.js?version=<?php echo date("YmdHis");?>"></script> 
<script>
	$('.textarea_editor').wysihtml5();
</script>
</body>
</html>
