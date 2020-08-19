<?php 
  include_once("include/include_app.php");

  if(!isset($_SESSION['staff_id'])){
    header("Location:login.php");
  }else{
    if(!Login::check($_SESSION['staff_id'])){
      header("Location:login.php");
    }
  }


  if(isset($_GET['mode'],$_GET['faqs_id'])){
    if($_GET['mode'] === "delete" && $_GET['faqs_id'] != ""){
      $faqs_id = decode($_GET['faqs_id'],LIAM_COINS_KEY);
      @mysqli_query($conn,"DELETE FROM `lc_faqs` WHERE `id` = '".$faqs_id."'");
      header("Location:faqs.php");
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo LIAM_COINS_TITLE;?></title>
<?php include_once('header_meta.php');?>
</head>
<body>
<?php include_once('header.php');?>
<?php include_once('header_menu.php');?>
<?php include_once('sidebar_menu.php');?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">FAQs</a> </div>
    <h1>FAQs</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="">
      <div class="btn-group">
        <a href="faqs_detail.php?mode=add"><button class="btn btn-success">Add FAQs</button></a>
      </div>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>FAQs List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Question</th>
                  <th>Answer</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php


                $sqlFaqsList = "SELECT * FROM `lc_faqs` WHERE 1  ORDER BY id DESC";
                $quFaqsList = @mysqli_query($conn, $sqlFaqsList);
                $numPro = 1;
                
                while($rowFaqsList = mysqli_fetch_array($quFaqsList, MYSQLI_ASSOC)){

                ?>
                <tr class="gradeX">
                  <td style="vertical-align: middle;"><center><?php echo sprintf("%04d",$numPro++)?></center></td>
                  <td style="vertical-align: middle;"><?php echo $rowFaqsList['question'];?></td>
                  <td style="vertical-align: middle;"><?php echo $rowFaqsList['answer'];?></td>
                  <td style="vertical-align: middle;"><center><?php if($rowFaqsList['status'] == '1'){?><span class="label label-success">Enable</span><?php }else{?><span class="label label-important">Disable</span><?php }?></center></td>
                  <td style="vertical-align: middle;">
                    <center>
                      <a href="faqs_detail.php?faqs_id=<?php echo encode($rowFaqsList['id'],LIAM_COINS_KEY);?>&mode=update"><button type="button" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button></a> 
                      <a href="faqs.php?faqs_id=<?php echo encode($rowFaqsList['id'],LIAM_COINS_KEY);?>&mode=delete" onclick="return confirm('Are you sure you want to delete?')"><button type="button" class="btn btn-danger btn-mini"><i class="icon-remove"></i></button></a>
                    </center></td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include_once('footer.php');?>

<script src="js/jquery.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.ui.custom.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/bootstrap.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.uniform.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/select2.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/jquery.dataTables.min.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.js?version=<?php echo date("YmdHis");?>"></script> 
<script src="js/matrix.tables.js?version=<?php echo date("YmdHis");?>"></script>
</body>
</html>
