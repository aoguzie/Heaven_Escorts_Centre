<!--top-Header-menu-->
<?php 
$_SESSION['staff_name'] = isset($_SESSION['staff_name']) ? $_SESSION['staff_name'] : ""; 
?>
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li class=""><a title="" href="#"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $_SESSION['staff_name'];?></span></a></li>
    <li class=""><a title="" href="logout.php"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>

<!--start-top-serch-->
<!-- <div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div> -->
<!--close-top-serch--> 