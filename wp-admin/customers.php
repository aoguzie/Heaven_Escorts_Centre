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
    <div id="breadcrumb"> <a href="index.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Customers</a> </div>
    <h1>Customers</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Customers List</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Register Since</th>
                  <th>Status</th>
                  <th>Email Confirmed</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sqlCustomerList = "SELECT * FROM `lc_customer` WHERE 1 ORDER BY id DESC";
                $quCustomerList = @mysqli_query($conn, $sqlCustomerList);
                $numCustomer = 1;
                
                while($rowCustomerList = mysqli_fetch_array($quCustomerList, MYSQLI_ASSOC)){

                ?>
                <tr class="gradeX">
                  <td style="vertical-align: middle;"><center><?php echo sprintf("%04d",$numCustomer++)?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowCustomerList['cus_fname'].' '.$rowCustomerList['cus_lname']?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowCustomerList['cus_username'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowCustomerList['cus_email'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php echo $rowCustomerList['register_date'];?></center></td>
                  <td style="vertical-align: middle;"><center><?php if($rowCustomerList['status'] == '1'){?><span class="label label-success">Enable</span><?php }else{?><span class="label label-important">Disable</span><?php }?></center></td>
                  <td style="vertical-align: middle;"><center><?php if($rowCustomerList['confirm_email'] == '1'){?><span class="label label-success">Confirmed</span><?php }else{?><span class="label label-important">Not yet confirmed</span><?php }?></center></td>
                  <td style="vertical-align: middle;">
                    <center>
                      <a href="customer_detail.php?cus_id=<?php echo encode($rowCustomerList['id'],LIAM_COINS_KEY);?>"><button type="button" class="btn btn-info btn-mini"><i class="icon-eye-open"></i></button></a>
                      <a href="customer_edit.php?cus_id=<?php echo encode($rowCustomerList['id'],LIAM_COINS_KEY);?>&mode=update"><button type="button" class="btn btn-warning btn-mini"><i class="icon-edit"></i></button></a> 
                    </center>
                  </td>
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
