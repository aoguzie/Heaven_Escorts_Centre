<?php
    include_once("../include/include_app.php");
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['proSearch'],$_POST['_token'])){
            echo $_POST['_token'];
        }
    }
?>