<?php
include_once "database.php";
include_once "info-site.php";
include_once "function.php";

if(isset($_GET['option'])){
//functie pentru sterderea de email-uri
  if($_GET['option'] == "delete_mail"){
    $sql = "UPDATE db_mail SET delete_mail = 1 WHERE id='$_GET[mail_id]'";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        header("location: ../mailbox.php?status=mail_deleted");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
  }
//*****************************************************************************************************
//functie pentru adaugarea de prezente
  if($_GET['option'] == "add_attendance"){
    $ok = 0;
    $choose = $_POST['attendance'];
    $n=count($choose);
    if($n == 0)
    header("location: ../timetable.php?status=no_practice_select");

    for ($i=0; $i < $n; $i++) {

      $sql = "SELECT * FROM db_present where id_member = '$_GET[user_id]' and id_timetable = '$choose[$i]'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        $sql = "UPDATE db_present SET cancel='0' WHERE id_member = '$_GET[user_id]' and id_timetable = '$choose[$i]'";
      } else {
        $sql = "INSERT INTO db_present (id_member, id_timetable)
                VALUES ('$_GET[user_id]', '$choose[$i]')";
      }
        if (mysqli_query($conn, $sql)) {
            $ok++;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if($ok == $n)
    header("location: ../timetable.php?status=success_attendance&show=all");
  }
//**************************************************************************************************************
// functie pentru anularea prezentelor
if($_GET['option'] == "cancel_attendance"){
  $ok = 0;
  $choose = $_POST['attendance'];
  $n=count($choose);
  if($n == 0)
  header("location: ../timetable.php?status=no_practice_select");
  for ($i=0; $i < $n; $i++) {

    $sql = "UPDATE db_present SET cancel='1' WHERE id_member = '$_GET[user_id]' and id_timetable = '$choose[$i]'";

      if (mysqli_query($conn, $sql)) {
          $ok++;
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
  }
  if($ok == $n)
  header("location: ../timetable.php?status=success_cancel_attendance&show=all");
}
//*****************************************************************************************************
//functie pentru adaugat antrenamente
if($_GET['option'] == "add_new_timetable_data"){
$caracter = 0;
  for ($i=1; $i <= 8; $i++) {
    if(isset($_POST['crt'.$i])){
      $caracter = $caracter * 10 + $_POST['crt'.$i];
    }
  }

  $sql = "INSERT INTO db_timetable (p_date, p_hour, level, section_id, caracter, info, trainer_id)
          VALUES ('$_POST[practice_date]', '$_POST[practice_hour]', '$_POST[level]', '$_POST[section_id]', '$caracter', '$_POST[info]', '$_POST[trainer_id]')";

  if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      header("location: ../timetable.php?option=add_data_timetable&status=success_add_data_timetable");
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}
//****************************************************************************************************
//functie pentru editat antrenamente
if($_GET['option'] == "edit_data_timetable"){
$caracter = 0;
  for ($i=1; $i <= 8; $i++) {
    if(isset($_POST['crt'.$i])){
      $caracter = $caracter * 10 + $_POST['crt'.$i];
    }
  }

  $sql = "UPDATE db_timetable SET p_date = '$_POST[practice_date]', p_hour = '$_POST[practice_hour]', level = '$_POST[level]', section_id = '$_POST[section_id]', caracter = '$caracter', info = '$_POST[info]', trainer_id = '$_POST[trainer_id]' WHERE id='$_GET[practice_id]'";

  if (mysqli_query($conn, $sql)) {
      echo "Record updated successfully";
      header("location: ../timetable.php?status=success_edited_timetable");
  } else {
      echo "Error updating record: " . mysqli_error($conn);
  }

}
//*****************************************************************************************************
//functie pentru editat antrenamente
if($_GET['option'] == "delete_data_timetable"){
  $ok = 0;
  $choose = $_POST['attendance'];
  $n=count($choose);
  if($n == 0)
  header("location: ../timetable.php?status=no_practice_select");
  for ($i=0; $i < $n; $i++) {
    $sql = "DELETE FROM db_timetable WHERE id='$choose[$i]'";

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
        header("location: ../timetable.php?&status=success_delete_data_timetable");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
  }
  if($ok == $n)
  header("location: ../timetable.php?status=success_attendance&show=all");
}
//*****************************************************************************************************


} //inchiderea $_GET['option']


 ?>
