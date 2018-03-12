<?php
include_once 'database.php';
include_once 'function.php';
include_once 'email-content.php';

session_start();

  login_test($conn);
  $user = user_data($conn);
  admin_test($conn, $user);

// acceptare membru
if(isset($_GET['option']) && $_GET['option'] == "add"){
    $sql = "SELECT * FROM members_wait WHERE member_id = '$_GET[member_id]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

      $sql = "INSERT INTO members (first_name, last_name, email, phone, address, birth_date, level)
              VALUES ('$row[first_name]', '$row[last_name]','$row[email]', '$row[phone]','$row[address]','$row[birth_date]', '$row[level]')";
      $sql2 = "INSERT INTO login_users (email, password, team)
              VALUES ('$row[email]', '$row[password]','user')";
      $sql3 = "DELETE FROM members_wait WHERE member_id='$_GET[member_id]'";

    if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
        $to      = $row['email'];
        $subject = 'Raspuns cerere AtletIS';
        $message = $accept_mail_content;
        $from = "admin@csatletis.xyz";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        header('location: ../index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

if(isset($_GET['option']) && $_GET['option'] == "reject"){
    $sql = "DELETE FROM members_wait WHERE member_id='$_GET[member_id]'";

    if (mysqli_query($conn, $sql)) {
        header('location: ../index.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

 ?>
