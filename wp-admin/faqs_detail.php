<?php 
  include_once("include/include_app.php");
  
  $typeMode = '';
  $mode = '';
  $faqs_id = '';

  if(isset($_GET['mode']) && $_GET['mode'] === "update"){
    if(isset($_GET['faqs_id']) && $_GET['faqs_id'] != ""){

      $typeMode = 'Update';
      $mode = 'update';
      $faqs_id = decode($_GET['faqs_id'],LIAM_COINS_KEY);
      
      $sqlProE = "SELECT * FROM `lc_faqs` WHERE `id` = '".$faqs_id."' LIMIT 1";
      $quProE = mysqli_query($conn,$sqlProE);
      $rowProE = mysqli_fetch_array($quProE, MYSQLI_ASSOC);

    }else{
      header("Location:faqs.php");
    }
  }else if(isset($_GET['mode']) && $_GET['mode'] === "add"){
    $typeMode = 'Add';
    $mode = 'add';
  }else{
    header("Location:faqs.php");
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
  <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="faqs.php" class="tip-bottom">Model</a> <a href="#" class="current"><?php echo $typeMode;?> Model</a> </div>
  <h1><?php echo $typeMode;?> Model</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>FAQs Info</h5>
        </div>
        <div class="widget-content nopadding">
          <form class="form-horizontal" name="frm1" id="frm1" method="post" action="control/faqs.php" enctype="multipart/form-data">
            <div class="control-group">
              <label class="control-label">Question :</label>
              <div class="controls">
                <input type="text" class="span11" name="faq_question" placeholder="Question" value="<?php if(isset($rowProE['question'])){echo $rowProE['question'];}?>">
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Answer :</label>
              <div class="controls">
              <textarea class="span11" name="faq_answer" placeholder="Answer"><?php if(isset($rowProE['answer'])){echo strip_tags(stripslashes($rowProE['answer']));}?></textarea>
                <!-- <input type="text" class="span11" name="faq_answer" placeholder="" value="<?php if(isset($rowProE['answer'])){echo $rowProE['answer'];}?>"> -->
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="faq_status">
                  <option value="1" <?php if(isset($rowProE['status']) && $rowProE['status'] == '1'){echo 'selected';}?>>Enable</option>
                  <option value="0" <?php if(isset($rowProE['status']) && $rowProE['status'] == '0'){echo 'selected';}?>>Disable</option>
                </select>
              </div>
            </div>
            <div class="form-actions">
              <input type="hidden" name="_token" value="<?php echo Token::generate();?>"/>
              <input type="hidden" name="mode" value="<?php echo $mode;?>"/>
              <input type="hidden" name="faqs_id" value="<?php if($faqs_id != ""){echo encode($faqs_id,LIAM_COINS_KEY);}?>"/>
              <a href="faqs.php"><button type="button" class="btn btn-danger">Cancel</button></a>
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
