<?php
include_once "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_FILES['photo']['name']) {
  $upload_ok = 0;
  // Check if file was uploaded without errors

  if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
    $allowed = array(
      "jpg" => "image/jpg",
      "jpeg" => "image/jpeg",
      "gif" => "image/gif",
      "png" => "image/png"
    );
    $filename = $_FILES["photo"]["name"];
    $filetype = $_FILES["photo"]["type"];
    $filesize = $_FILES["photo"]["size"];

    // Verify file extension

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if (!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");

    // Verify file size - 20MB maximum

    $maxsize = 20 * 1024 * 1024;
    if ($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");

    // Verify MYME type of the file

    if (in_array($filetype, $allowed)) {

      // Check whether file exists before uploading it

      if (file_exists("../../img/" . $_FILES["photo"]["name"])) {
        echo $_FILES["photo"]["name"] . " is already exists.";
      }
      else {
        move_uploaded_file($_FILES["photo"]["tmp_name"], "../../img/" . $_FILES["photo"]["name"]);
        echo "Your file was uploaded successfully.";
        $upload_ok = 1;
      }
    }
    else {
      echo "Error: There was a problem uploading your file. Please try again.";
    }
  }
  else {
    echo "Error: " . $_FILES["photo"]["error"];
  }

  $filename = "img/" . $filename;
}



if (isset($_GET['option'])) { // verificam daca este setata optiunea
  if ($_GET['option'] == "add_img_to_section") { // verificam daca este setat optiunea de a adauga o noua imagine

    $sql = "INSERT INTO site_photo (section_id, photo_link, title, description)
                VALUES ('$_POST[section_id]', '$filename', '$_POST[title]', '$_POST[description]')";

      if (mysqli_query($conn, $sql)) {
          header("location: edit_site.php?option=edit_img");
      } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

  }

  if ($_GET['option'] == "edit_section") { // editam o sectiune sportiva
    if(isset($filename) && $filename != "img/")
      $sql = "UPDATE site_section SET name='$_POST[name]', description='$_POST[description]', long_description='$_POST[long_description]', image_link='$filename' WHERE section_id='$_POST[section_id]'";
    else
      $sql = "UPDATE site_section SET name='$_POST[name]', description='$_POST[description]', long_description='$_POST[long_description]' WHERE section_id='$_POST[section_id]'";
    //update section
    if (mysqli_query($conn, $sql)) {
        header("location: ../edit_site.php?option=edit_section&status=success");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

  }

  if ($_GET["option"] == "add_news") {
    if (isset($filename) && $filename != "img/") {
      $sql = "INSERT INTO site_post (post_author, post_title, post_content, post_section, image_link)
                  VALUES ('$_SESSION[user_id]', '$_POST[post_title]', '$_POST[post_content]', '$_POST[section]', '$filename')";
    } else {
      $sql = "INSERT INTO site_post (post_author, post_title, post_content, post_section)
                  VALUES ('$_SESSION[user_id]', '$_POST[post_title]', '$_POST[post_content]', '$_POST[section]')";
    }
    switch ($_POST['section']) {
      case 1:
        $section = "news_info";
        break;
      case 2:
        $section = 'news_media';
        break;
      case 3:
        $section = 'events';
          break;
    }
    if (mysqli_query($conn, $sql)) {
        header("location: ../edit_news.php?option=$section&status=success_insert");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
  }

  if (isset($_POST['save_news'])) {
    if (isset($filename) && $filename != "img/") {
      $sql = "UPDATE site_post SET post_title='$_POST[post_title]', post_content='$_POST[post_content]', image_link='$filename' WHERE post_id='$_POST[post_id]'";
    } else {
    $sql = "UPDATE site_post SET post_title='$_POST[post_title]', post_content='$_POST[post_content]' WHERE post_id='$_POST[post_id]'";
  }

  switch ($_POST['section']) {
    case 1:
      $section = "news_info";
      break;
    case 2:
      $section = 'news_media';
      break;
    case 3:
      $section = 'events';
        break;
  }

    if (mysqli_query($conn, $sql)) {
        header("location: ../edit_news.php?option=$section&status=success_edit");
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

//add new section
if (isset($_POST["add"])) {

  $sql = "INSERT INTO site_section (name, description, long_description, image_link)
              VALUES ('$_POST[name]', '$_POST[description]', '$_POST[long_description]', '$filename')";

  if (mysqli_query($conn, $sql)) {
      $all_ok = 2;
  } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

if (isset($all_ok) && $all_ok == 2) {
header("location: ../edit_site.php?status=1");
}

}// iesire din zona de incarcare fisiere

    if (isset($_POST["delete"])) {
      // sql to delete a record
      $sql = "DELETE FROM site_section WHERE section_id='$_GET[section_id]'";

      if (mysqli_query($conn, $sql)) {
          header("location: ../edit_site.php?status=2");
      } else {
          echo "Error deleting record: " . mysqli_error($conn);
      }
    }

// new image on site

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_image'])){

        // Check if file was uploaded without errors

        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

            $filename = $_FILES["photo"]["name"];

            $filetype = $_FILES["photo"]["type"];

            $filesize = $_FILES["photo"]["size"];



            // Verify file extension

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");



            // Verify file size - 20MB maximum

            $maxsize = 20 * 1024 * 1024;

            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");



            // Verify MYME type of the file

            if(in_array($filetype, $allowed)){

                // Check whether file exists before uploading it

                if(file_exists("../../img/" . $_FILES["photo"]["name"])){

                    echo $_FILES["photo"]["name"] . " is already exists.";

                } else{

                    move_uploaded_file($_FILES["photo"]["tmp_name"], "../../img/" . $_FILES["photo"]["name"]);

                    echo "Your file was uploaded successfully.";

                    $all_ok=1;

                }

            } else{

                echo "Error: There was a problem uploading your file. Please try again.";

            }

        } else{

            echo "Error: " . $_FILES["photo"]["error"];

        }

        $filename = "img/".$filename;

          // sql to delete a record
          $sql = "INSERT INTO site_photo (section_id, photo_link, title, description)
                      VALUES ('$_POST[section_id]', '$filename','$_POST[title]', '$_POST[description]')";

          if (mysqli_query($conn, $sql)) {
              $all_ok = 2;
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        if ($all_ok == 2) {
          header("location: ../edit_site.php?option=edit_img&status=1");
        }
    }


//adaugare membru in echipa de la site
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['team_edit'])){

        // Check if file was uploaded without errors

        if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){

            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");

            $filename = $_FILES["photo"]["name"];

            $filetype = $_FILES["photo"]["type"];

            $filesize = $_FILES["photo"]["size"];



            // Verify file extension

            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");



            // Verify file size - 20MB maximum

            $maxsize = 20 * 1024 * 1024;

            if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");



            // Verify MYME type of the file

            if(in_array($filetype, $allowed)){

                // Check whether file exists before uploading it

                if(file_exists("../../img/" . $_FILES["photo"]["name"])){

                    echo $_FILES["photo"]["name"] . " is already exists.";

                } else{

                    move_uploaded_file($_FILES["photo"]["tmp_name"], "../../img/" . $_FILES["photo"]["name"]);

                    echo "Your file was uploaded successfully.";

                    $all_ok=1;

                }

            } else{

                echo "Error: There was a problem uploading your file. Please try again.";

            }

        } else{

            echo "Error: " . $_FILES["photo"]["error"];

        }

        $filename = "img/".$filename;

          // sql to delete a record
          $sql = "INSERT INTO site_team (member_id, role, description, photo_link)
                      VALUES ('$_GET[team_member_id]', '$_POST[role]','$_POST[description]', '$filename')";

          if (mysqli_query($conn, $sql)) {
              $all_ok = 2;
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
          }
        if ($all_ok == 2) {
          header("location: ../edit_site.php?option=edit_team&status=1");
        }
    }


    if (isset($_GET['option'])&&$_GET['option']=="delete_team") {
      // sql to delete a record
      $sql = "DELETE FROM site_team WHERE member_id='$_GET[team_member_id]'";

      if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";
          header("location: ../edit_site.php?option=edit_team&status=2");
      } else {
          echo "Error deleting record: " . mysqli_error($conn);
      }
    }


    if (isset($_POST["delete_news"])) {
      // sql to delete a record
      $sql = "DELETE FROM site_post WHERE post_id='$_POST[post_id]'";

      if (mysqli_query($conn, $sql)) {
          header("location: ../edit_news.php?option=$_GET[option]&status=delete_done");
      } else {
          echo "Error deleting record: " . mysqli_error($conn);
      }
    }
    ?>
