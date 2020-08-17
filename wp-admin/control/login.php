<?php
    include_once("../include/include_app.php");
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['username'],$_POST['password'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){
                $username = $_POST['username'];
                $passwordT = encode($_POST['password'],LIAM_COINS_KEY);
                
                $sqlStaff = "SELECT * FROM `lc_user_staff` WHERE `account` = '".$username."' AND `passwd` = '".$passwordT."' AND `status` = '1' LIMIT 1";
                $quStaff = mysqli_query($conn,$sqlStaff);
                $rowStaff = mysqli_fetch_array($quStaff, MYSQLI_ASSOC);

                if($rowStaff['id']){

                    $_SESSION['staff_id'] = $rowStaff['id'];
                    $_SESSION['staff_name'] = $rowStaff['name'];
                    $_SESSION['staff_account'] = $rowStaff['account'];

                    header("Location:../index.php?action=success");

                }else{
                    header("Location:../login.php?action=failure");
                    die();
                }

            }else{
                die();
            }
        }
    }else{
        die();
    }
?>