<?php
session_start();
include_once 'database.php';

if(isset($_GET['option']) && $_GET['option']==1){

$sql = "SELECT * FROM db_present WHERE id_member = '$_SESSION[user_id]' and id_timetable = $_GET[antrenament]";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (mysqli_num_rows($result) == 1) {
  if($row['cancel']==0){
    header("location: ../timetable.php?status=1&antrenament=$_GET[antrenament]");
  }
  else{
    $sql = "UPDATE db_present SET cancel = '0' WHERE id_member = '$_SESSION[user_id]' and id_timetable = '$_GET[antrenament]'";
      if (mysqli_query($conn, $sql)) {
          header('location: ../timetable.php?status=2&antrenament=$_GET[antrenament]');
      } else {
          echo "Error updating record: " . mysqli_error($conn);
      }
  }
  }
  else {
    $sql = "INSERT INTO db_present (id_member, id_timetable)
                VALUES ('$_SESSION[user_id]', '$_GET[antrenament]')";
      if (mysqli_query($conn, $sql)) {
          header("location: ../timetable.php?status=2&antrenament=$_GET[antrenament]");
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
}

if(isset($_GET['option']) && $_GET['option']==2){
  $sql = "UPDATE db_present SET cancel = '1' WHERE id_member = '$_SESSION[user_id]' and id_timetable = '$_GET[antrenament]'";
    if (mysqli_query($conn, $sql)) {
      header('location: ../timetable.php?status=3&antrenament=$_GET[antrenament]');
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// anulare prezenta




mysqli_close($conn);


 ?>
