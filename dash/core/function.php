<?php
include_once 'database.php';
session_start();
// afisare ziua saptamani
function write_day($data)
{
  $day = date('l', strtotime($data));

  switch ($day) {
    case 'Monday':
      return "Luni";
      break;

    case 'Tuesday':
      return "Marti";
      break;

    case 'Wednesday':
      return "Miercuri";
      break;

    case 'Thursday':
      return "Joi";
      break;
      case 'Friday':
        return "Vineri";
        break;

    case 'Saturday':
      return "Sambata";
      break;

    case 'Sunday':
      return "Duminica";
      break;

    default:
      # code...
      break;

  }
}

function write_level($conn,$level){
  $sql = "SELECT * FROM db_level where level_id = '$level'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['level_name'];

}

function lc_write_day($data)
{
  $day = date('l', strtotime($data));

  switch ($day) {
    case 'Monday':
      echo "luni";
      break;

    case 'Tuesday':
      echo "marti";
      break;

    case 'Wednesday':
      echo "miercuri";
      break;

    case 'Thursday':
      echo "joi";
      break;
      case 'Friday':
        echo "vineri";
        break;

    case 'Saturday':
      echo "sambata";
      break;

    case 'Sunday':
      echo "duminica";
      break;

    default:
      # code...
      break;

  }
}

//******************************************************************************************************
//reurneaza daca utilizatorul este antrenor
function return_trainer_test($conn,$trainer_id){
  $sql = "SELECT * FROM db_trainers WHERE member_id = '$trainer_id'";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0)
    return 1;
  else
    return 0;
}
//******************************************************************************************************
// functie care testeaza antrenorii
function return_trainer($conn,$trainer_id){
  $sql = "SELECT * FROM members WHERE member_id = '$trainer_id'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row['first_name']." ".$row['last_name'];
}
//***************************************************************************************************
//afisam caracterele antrenamentului
function echo_caracter(int $caracter){
  while ($caracter > 0) {
    $c = $caracter % 10;
    $caracter = (int)($caracter/10);
    switch ($c) {
      case 1:
        echo "&#8599 &#160 ";
        break;
      case 2:
        echo "&#8597; &#160";
        break;
      case 3:
        echo "&#8801; &#160";
        break;
      case 4:
        echo "R &#160";
        break;
      case 5:
        echo "&#137 &#160";
        break;
      case 6:
        echo "&#8368 &#160";
        break;
      case 7:
        echo "&#10227 &#160";
        break;
      case 8:
        echo "&#10132 &#160";
        break;

      default:
        echo "Fara caz". $caracter;
        break;
    }
  }
}

//coloram tabelul in functie de grupa de antrenament
function color_cell($tip){
  switch ($tip) {
    case 1:
      echo "#ff6666";
      break;
    case 2:
      echo "#ffff4d";
      break;
    case 3:
      echo "#cece7e";
      break;
    case 4:
      echo "#80bfff";
      break;
  }
}

//functie ce numara membrii din baza de date
function count_member($type, $conn){
  switch ($type) {
    case 1:
      $sql = "SELECT COUNT(member_id) AS nr_m FROM members WHERE level = 1";
      break;
    case 2:
      $sql = "SELECT COUNT(member_id) AS nr_m FROM members WHERE level = 2";
      break;
    case 3:
      $sql = "SELECT COUNT(member_id) AS nr_m FROM members WHERE level = 3";
      break;
    default:
    $sql = "SELECT COUNT(member_id) AS nr_m FROM members ;";
      break;
  }
  $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row['nr_m'];
    }
}


//functie ce verifica daca sunt membrii ce asteapta sa fie acceptati
function member_alert($conn){
  $sql = "SELECT * FROM members_wait";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) >= 1)
      return 1;
    else
      return 0;
}


function message_alert($conn){
  $sql = "SELECT id FROM site_messages WHERE seen = '0'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) >= 1)
      return 1;
    else
      return 0;
}

function count_message_alert($conn){
  $nr_msg = 0;
  $user = user_data($conn);
  if(return_admin_test($conn, $user) == 1){
    $sql = "SELECT id FROM site_messages WHERE (seen = '0' and delete_mail = '0')";
    $result = mysqli_query($conn, $sql);
    $nr_msg = mysqli_num_rows($result);
  }
  $sql = "SELECT * FROM db_mail WHERE (mail_to = '$_SESSION[user_id]' and seen = '0' and delete_mail = '0')";
  $result = mysqli_query($conn, $sql);
  $nr_msg += mysqli_num_rows($result);
  return $nr_msg;
}

function count_message($conn){
  $sql = "SELECT id FROM site_messages";
  $result = mysqli_query($conn, $sql);
  return mysqli_num_rows($result);
}


//functie ce calculeaza timpul ce a trecut de la o data anume
function past_time($time){
  $time = strtotime( $time );
  $time = date( 'Y-m-d', $time );
  $time = strtotime( $time );
  $time = floor((time('Y-m-d')-$time)/(60 * 60 * 24));

  switch ($time) {
    case '0':
      echo "Astazi";
      break;
    case '1':
      echo "Ieri";
      break;
    default:
      echo "Acum ".$time." zile";
      break;
  }
}

function return_past_time($time){
  $time = strtotime( $time );
  $time = date( 'Y-m-d', $time );
  $time = strtotime( $time );
  $time = floor((time('Y-m-d')-$time)/(60 * 60 * 24));

  switch ($time) {
    case '0':
      return "astazi";
      break;
    case '1':
      return "ieri";
      break;
    default:
      return "acum ".$time." zile";
      break;
  }
}

function return_diff_time($time1, $time2){
  $time1 = strtotime( $time1 );
  $time2 = strtotime( $time2 );
  $time1 = date( 'Y-m-d h:m:s', $time1 );
  $time2 = date( 'Y-m-d h:m:s', $time2 );
  $time1 = strtotime( $time1 );
  $time2 = strtotime( $time2 );
  $time = floor(($time1-$time2));

if($time == 0)
return 1;
else
return 0;
}

//functie ce afiseaza level-ul unui user
function level($level){
  switch ($level) {
    case '1':
      echo "Incepator";
      break;
    case '2':
      echo "Avansat";
      break;
    case '3':
      echo "Master";
      break;
    case '99':
      echo "Admin";
      break;
  }
}

//functie ce returneaza datele despre utilizatorul autentificat
function user_data($conn){
  $sql = "SELECT * FROM members WHERE member_id = '$_SESSION[user_id]'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  return $row;
}
//*************************************************************************************************************
//funcetie care verifica prezenta la antrenament
function return_practice_attendance($conn, $user, $practice_id){
  $sql = "SELECT * FROM db_present where id_member = '$user[member_id]' and id_timetable = '$practice_id' and cancel = '0'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1)
    return 1;

    $sql = "SELECT * FROM db_present where id_member = '$user[member_id]' and id_timetable = '$practice_id' and cancel = '1'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1)
    return 2;

  return 0;
}
//***************************************************************************************************************
//functie ce testeaza daca user-ul este administrator cu redirect
function admin_test($conn, $user){
  $sql = "SELECT * FROM members WHERE member_id = '$user[member_id]'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $sql = "SELECT * FROM login_users WHERE email = '$row[email]'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['team'] != "admin")
    header("location: timetable.php");
}

//functie ce testeaza daca user-ul este administrator cu return de adevarat sau fals
function return_admin_test($conn, $user){
  $sql = "SELECT * FROM login_users WHERE email = '$user[email]'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if($row['team'] == "admin")
    return 1;
  else
    return 0;
}


//functie ce testeaza daca un user este conectat
function login_test($conn){
  if(!isset($_SESSION['user_id']))
    header('location: login.php');
}


//functie ce returneaza 20 de cuvinte dintr-un text
function limit_words($text,$limit)
{
      $explode = explode(' ',$text);
      $string  = '';

     $dots = '...';
      if(count($explode) <= $limit){
          $dots = '';
      }
      for($i=0;$i<$limit;$i++){
        if(!isset($explode[$i]))
        break;
          $string .= $explode[$i]." ";
      }
      if ($dots) {
          $string = substr($string, 0, strlen($string));
      }

     return $string.$dots;
}
?>
