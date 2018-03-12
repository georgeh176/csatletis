<?php
include_once "database.php";
include_once "function.php";

if ($_GET['option'] == "edit_member_benefits"){
  $sql = "UPDATE site_member_section SET content = '$_POST[benefits_content]' WHERE section = 'benefits'";

if (mysqli_query($conn, $sql)) {
    header("location: ../edit_members_section.php?option=benefits");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}

if ($_GET['option'] == "edit_member_statute"){
  $sql = "UPDATE site_member_section SET content = '$_POST[benefits_content]' WHERE section = 'statute'";

if (mysqli_query($conn, $sql)) {
    header("location: ../edit_members_section.php?option=statute");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

}
if ($_GET['option'] == "edit_member_pay-dues"){
  $sql = "UPDATE site_member_section SET content = '$_POST[benefits_content]' WHERE section = 'pay-dues'";

if (mysqli_query($conn, $sql)) {
    header("location: ../edit_members_section.php?option=pay-dues");
} else {
    echo "Error updating record: " . mysqli_error($conn);
}
}

 ?>
