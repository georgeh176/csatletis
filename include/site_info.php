<?php
include_once 'database.php';

header("Content-Type: text/html;charset=utf-8");
$sql = "SELECT * FROM site_option";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      switch ($row['option_name']) {
        case 'site_title':
          $site_info['site_title'] = $row['option_value'];
          break;
        case 'site_description':
          $site_info['site_description'] = $row['option_value'];
          break;
        case 'long_title':
          $site_info['long_title'] = $row['option_value'];
          break;
        case 'long_description':
          $site_info['long_description'] = $row['option_value'];
          break;
        case 'about_logo':
          $site_info['about_logo'] = $row['option_value'];
          break;
        case 'site_adress':
          $site_info['site_adress'] = $row['option_value'];
          break;
        case 'site_phone':
          $site_info['site_phone'] = $row['option_value'];
          break;
        case 'site_email':
          $site_info['site_email'] = $row['option_value'];
          break;
        case 'slide1':
          $site_info['slide1'] = $row['option_value'];
          break;
        case 'slide2':
          $site_info['slide2'] = $row['option_value'];
          break;

        default:
          # code...
          break;
      }
    }
} else {
    echo "0 results";
}

?>
