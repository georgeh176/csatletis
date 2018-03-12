<?php
include_once "database.php";
if(isset($_POST['submit'])){
  $sql = "INSERT INTO site_messages (first_name, last_name, phone, email, message)
              VALUES ('$_POST[first_name]', '$_POST[last_name]', $_POST[phone], '$_POST[email]', '$_POST[message]')";

if (mysqli_query($conn, $sql)) {
    header("location: ../contact.php?msj=send");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

 ?>
