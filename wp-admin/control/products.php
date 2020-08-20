<?php
    include_once("../include/include_app.php");

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['pro_name'],$_POST['pro_detail'],$_POST['pro_category'],$_POST['pro_description'],$_POST['pro_status'],$_POST['mode'],$_POST['_token'])){
            if(Token::check($_POST['_token'])){

                $pro_name = addslashes($_POST['pro_name']);
                $pro_age = $_POST['pro_age'];
                $pro_detail = addslashes($_POST['pro_detail']);
                $pro_category = $_POST['pro_category'];
                //$pro_category_sub = $_POST['pro_category_sub'];
                $pro_description = addslashes($_POST['pro_description']);
                $pro_status = $_POST['pro_status'];
                $mode = $_POST['mode'];

                if($mode === "add"){

                    $sqlPro = "INSERT INTO `lc_product` (`id`, `name`, `age`, `detail`, `description`, `category`, `status`) 
                    VALUES (NULL, '".$pro_name."', '".$pro_age."', '".$pro_detail."', '".$pro_description."', '".$pro_category."', '".$pro_status."');";
                    $quPro = mysqli_query($conn,$sqlPro);
                    $pro_id = mysqli_insert_id($conn);

                    if ($_FILES['pro_images']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images2']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images2']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images2"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images2"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images2` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images3']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images3']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images3"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images3"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images3` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images4']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images4']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images4"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images4"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images4` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images5']['name'] != "") { 

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images5']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images5"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images5"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images5` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    header("Location:../products.php?action=success");
                    
                }else if($mode === "update"){
                    
                    $pro_id = decode($_POST['pro_id'],LIAM_COINS_KEY);

                    @mysqli_query($conn,"UPDATE `lc_product` SET `name` = '".$pro_name."', `age` = '".$pro_age."', `detail` = '".$pro_detail."', `description` = '".$pro_description."', `category` = '".$pro_category."', `status` = '".$pro_status."' WHERE `id` = ".$pro_id.";");

                    if ($_FILES['pro_images']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images2']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old2']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images2']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images2"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images2"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images2` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images3']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old3']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images3']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images3"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images3"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images3` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images4']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old4']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images4']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images4"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images4"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images4` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    if ($_FILES['pro_images5']['name'] != "") { 
                        
                        @unlink("../../uploads/product/".$_POST['pro_images_old5']);

                        $mname="";
                        $mname=date("YmdHis").rand(100,999);
                        $filename = "";
                        if($filename == "")
                        $name_data=explode(".",$_FILES['pro_images5']['name']);
                        $type = $name_data[1];
                        $filename = $mname.".".$type;
                        
                        $target_dir = "../../uploads/product/";
                        $target_file = $target_dir . basename($filename);
                        $uploadOk = 1;
                        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                        // Check if image file is a actual image or fake image
                        $check = getimagesize($_FILES["pro_images5"]["tmp_name"]);
                        
                        @move_uploaded_file($_FILES["pro_images5"]["tmp_name"], $target_file);
                        $sqlImg = "UPDATE `lc_product` SET `images5` = '".$filename."' WHERE `id` = '".$pro_id."' ";
                        @mysqli_query($conn, $sqlImg);	
        
                    } // end if ($_FILES[pro_images][name] != "")	

                    header("Location:../products.php?action=success");

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