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
          $info_site['site_title'] = $row['option_value'];
          break;
        case 'site_description':
          $info_site['site_description'] = $row['option_value'];
          break;
        case 'long_title':
          $info_site['long_title'] = $row['option_value'];
          break;
        case 'long_description':
          $info_site['long_description'] = $row['option_value'];
          break;
        case 'about_logo':
          $info_site['about_logo'] = $row['option_value'];
          break;
        case 'site_adress':
          $info_site['site_adress'] = $row['option_value'];
          break;
        case 'site_phone':
          $info_site['site_phone'] = $row['option_value'];
          break;
        case 'site_email':
          $info_site['site_email'] = $row['option_value'];
          break;
        case 'slide1':
          $info_site['slide1'] = $row['option_value'];
          break;
        case 'slide2':
          $info_site['slide2'] = $row['option_value'];
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
