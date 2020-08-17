<?php 
  include_once("include/include_app.php");

  if(!isset($_SESSION['staff_id'])){
    header("Location:login.php");
  }else{
    if(!Login::check($_SESSION['staff_id'])){
      header("Location:login.php");
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
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Orders</a> </div>
    <h1>Orders</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Orders List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Order Number</th>
                  <th>Date</th>
                  <th>Total</th>
                  <th>Payment Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sqlOrderList = "SELECT * FROM `lc_order` WHERE 1 ORDER BY id DESC";
                $quOrderList = @mysqli_query($conn, $sqlOrderList);
                $numOrder = 1;
                
                while($rowOrderList = mysqli_fetch_array($quOrderList, MYSQLI_ASSOC)){

                ?>
                <tr class="gradeX">
                  <td style="vertical-align: middle;"><center><?php echo sprintf("%04d",$numOrder++)?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowOrderList['order_number']?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowOrderList['order_date'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowOrderList['order_total'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowOrderList['payment_status'];?></center></td>
                  <td style="vertical-align: middle;">
                    <center>
                      <a href="order_detail.php?order_id=<?php echo encode($rowOrderList['id'],LIAM_COINS_KEY);?>"><button type="button" class="btn btn-warning btn-mini"><i class="icon-eye-open"></i></button></a> 
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
