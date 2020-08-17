<?php 
  include_once("include/include_app.php");

  $cus_id = '';

  if(isset($_GET['cus_id']) && $_GET['cus_id'] != ""){

    $cus_id = decode($_GET['cus_id'],LIAM_COINS_KEY);
    
    $sqlCusD = "SELECT * FROM `lc_customer` WHERE `id` = '".$cus_id."' LIMIT 1";
    $quCusD = mysqli_query($conn,$sqlCusD);
    $rowCusD = mysqli_fetch_array($quCusD, MYSQLI_ASSOC);

    $sqlCusBill = "SELECT * FROM `lc_bill_addres` WHERE `cus_id` = '".$rowCusD['id']."' LIMIT 1";
    $quCusBill = mysqli_query($conn,$sqlCusBill);
    $rowCusBill = mysqli_fetch_array($quCusBill, MYSQLI_ASSOC);

    $sqlCusShip = "SELECT * FROM `lc_ship_addres` WHERE `cus_id` = '".$rowCusD['id']."' LIMIT 1";
    $quCusShip = mysqli_query($conn,$sqlCusShip);
    $rowCusShip = mysqli_fetch_array($quCusShip, MYSQLI_ASSOC);

  }else{
    header("Location:customers.php");
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
            <h5>Customerts Info</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Register Since</th>
                  <th>Status</th>
                  <th>Email Confirmed</th>
                </tr>
              </thead>
              <tbody>

              <tr class="gradeX">
                <td style="vertical-align: middle;"><center><?php echo $rowCusD['cus_fname'].' '.$rowCusD['cus_lname'];?></center></td>
                <td style="vertical-align: middle;"><center><?php echo $rowCusD['cus_username'];?></center></td>
                <td style="vertical-align: middle;"><center><?php echo $rowCusD['cus_email'];?></center></td>
                <td style="vertical-align: middle;"><center><?php echo $rowCusD['register_date'];?></center></td>
                <td style="vertical-align: middle;"><center><?php if($rowCusD['status'] == '1'){?><span class="label label-success">Enable</span><?php }else{?><span class="label label-important">Disable</span><?php }?></center></td>
                <td style="vertical-align: middle;"><center><?php if($rowCusD['confirm_email'] == '1'){?><span class="label label-success">Confirmed</span><?php }else{?><span class="label label-important">Not yet confirmed</span><?php }?></center></td>
              </tr>

              </tbody>
            </table>
          </div>
        </div>

        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Address Info</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>BILLING ADDRESS</th>
                  <th>SHIPPING ADDRESS</th>
                </tr>    
              </thead>
              <tbody>
                <tr class="odd gradeX">
                  <td class="center">
                    <?php 
                    ?>
                        <?php if($rowCusBill['fname'] != ""){?><p><strong>Full Name :</strong> <?php echo $rowCusBill['fname'].' '.$rowCusBill['lname'];?></p><?php }?>
												<?php if($rowCusBill['company'] != ""){?><p><strong>Company Name :</strong> <?php echo $rowCusBill['company'];?></p><?php }?>
												<?php if($rowCusBill['address1'] != ""){?><p><strong>Address :</strong> <?php echo $rowCusBill['address1'].' '.$rowCusBill['address2'];?></p><?php }?>
												<?php if($rowCusBill['city'] != ""){?><p><strong>City :</strong> <?php echo $rowCusBill['city'];?></p><?php }?>
												<?php if($rowCusBill['country'] != ""){?><p><strong>State / Country :</strong> <?php echo $rowCusBill['country'];?></p><?php }?>
												<?php if($rowCusBill['zipcode'] != ""){?><p><strong>Postcode :</strong> <?php echo $rowCusBill['zipcode'];?></p><?php }?>
												<?php if($rowCusBill['phone'] != ""){?><p><strong>Phone :</strong> <?php echo $rowCusBill['phone'];?></p><?php }?>
												<?php if($rowCusBill['email'] != ""){?><p><strong>Email :</strong> <?php echo $rowCusBill['email'];?></p><?php }?>
                  </td>
                  <td class="center">
                        <?php if($rowCusShip['fname'] != ""){?><p><strong>Full Name :</strong> <?php echo $rowCusShip['fname'].' '.$rowCusShip['lname'];?></p><?php }?>
												<?php if($rowCusShip['company'] != ""){?><p><strong>Company Name :</strong> <?php echo $rowCusShip['company'];?></p><?php }?>
												<?php if($rowCusShip['address1'] != ""){?><p><strong>Address :</strong> <?php echo $rowCusShip['address1'].' '.$rowCusShip['address2'];?></p><?php }?>
												<?php if($rowCusShip['city'] != ""){?><p><strong>City :</strong> <?php echo $rowCusShip['city'];?></p><?php }?>
												<?php if($rowCusShip['country'] != ""){?><p><strong>State / Country :</strong> <?php echo $rowCusShip['country'];?></p><?php }?>
												<?php if($rowCusShip['zipcode'] != ""){?><p><strong>Postcode :</strong> <?php echo $rowCusShip['zipcode'];?></p><?php }?>
												<?php if($rowCusShip['phone'] != ""){?><p><strong>Phone :</strong> <?php echo $rowCusShip['phone'];?></p><?php }?>
												<?php if($rowCusShip['email'] != ""){?><p><strong>Email :</strong> <?php echo $rowCusShip['email'];?></p><?php }?>
                  </td>
                </tr>
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
