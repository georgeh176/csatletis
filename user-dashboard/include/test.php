<?php
include_once "function.php";
include_once "database.php";

if(isset($_GET['option'])){
  if($_GET['option'] == "upload_image")
  echo "ok \n";
     if($_FILES['photo']['name'])
     echo "e pus";
}


 ?>
