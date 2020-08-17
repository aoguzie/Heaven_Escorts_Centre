<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['banner_name'],$_POST['banner_detail'],$_POST['banner_status'],$_POST['mode'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $banner_name = addslashes($_POST['banner_name']);
                $banner_detail = addslashes($_POST['banner_detail']);
                $banner_link= $_POST['banner_link'];
                $banner_target = $_POST['banner_target'];
                $banner_status = $_POST['banner_status'];
                $mode = $_POST['mode'];

                if($mode === "add"){

                    $sqlPro = "INSERT INTO `lc_banner` (`id`, `name`, `detail`, `link`, `target`, `status`) 
                    VALUES (NULL, '".$banner_name."', '".$banner_detail."', '".$banner_link."', '".$banner_target."', '".$banner_status."');";
                    $quPro = mysqli_query($conn,$sqlPro);
                    $banner_id = mysqli_insert_id($conn);

                    if ($_FILES['banner_images']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['banner_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/banner/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["banner_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["banner_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_banner` SET `images` = '".$filename."' WHERE `id` = '".$banner_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[banner_images][name] != "")	

                    header("Location:../index.php?action=success");
                    
                }else if($mode === "update"){
                    
                    $banner_id = decode($_POST['banner_id'],LIAM_COINS_KEY);

                    @mysqli_query($conn,"UPDATE `lc_banner` SET `name` = '".$banner_name."', `detail` = '".$banner_detail."', `link` = '".$banner_link."', `target` = '".$banner_target."', `status` = '".$banner_status."' WHERE `id` = ".$banner_id.";");

                    if ($_FILES['banner_images']['name'] != "") { 
                        
                        @unlink("../../uploads/banner/".$_POST['banner_images_old']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['banner_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/banner/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["banner_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["banner_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_banner` SET `images` = '".$filename."' WHERE `id` = '".$banner_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[banner_images][name] != "")	

                    header("Location:../index.php?action=success");

                }else{
                    die();
                }
            }else{
                die();
            }
        }else{
            die();
        }
    }else{
        die();
    }
?>