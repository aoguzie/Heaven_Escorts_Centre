<?php 
  include_once("include/include_app.php");
  
  $typeMode = '';
  $mode = '';
  $page_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    if(isset($_GET['page_id']) && $_GET['page_id'] != ""){

      $typeMode = 'Update';
      $mode = 'update';
      $page_id = decode($_GET['page_id'],LIAM_COINS_KEY);
      
      $sqlPageE = "SELECT * FROM `lc_page` WHERE `id` = '".$page_id."' LIMIT 1";
      $quPageE = mysqli_query($conn,$sqlPageE);
      $rowPageE = mysqli_fetch_array($quPageE, MYSQLI_ASSOC);

    }else{
      header("Location:pages.php");
    }
  }else{
    header("Location:pages.php");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<meta charset="UTF-8" />
<?php include_once('header_meta.php');?>

</head>
<body>

<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="pages.php" class="tip-bottom">Products</a> <a href="#" class="current"><?php echo $typeMode;?> Products</a> </div>
  <h1><?php echo $typeMode;?> Pages</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5><?php echo $rowPageE['name'];?></h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/pages.php">
            <div class="control-group">
              <label class="control-label">Description :</label>
              <div class="controls">
                <textarea class="textarea_editor span11" rows="20" name="page_description" placeholder="Enter text ..."><?php if(isset($rowPageE['detail'])){echo stripslashes($rowPageE['detail']);}?></textarea>
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="page_id" value="<?php if($page_id != ""){echo encode($page_id,LIAM_COINS_KEY);}?>"/>
              <a href="pages.php"><button type="button" class="btn btn-danger">Cancel</button></a>
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
