<?php
include_once 'database.php';

// afisare ziua saptamani
function write_day($data)
{
  $day = date('l', strtotime($data));

  switch ($day) {
    case 'Monday':
      echo "Luni";
      break;

    case 'Tuesday':
      echo "Marti";
      break;

    case 'Wednesday':
      echo "Miercuri";
      break;

    case 'Thursday':
      echo "Joi";
      break;
      case 'Friday':
        echo "Vineri";
        break;

    case 'Saturday':
      echo "Sambata";
      break;

    case 'Sunday':
      echo "Duminica";
      break;

    default:
      # code...
      break;

  }
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
  $sql = "SELECT * FROM site_messages WHERE seen = '0'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) >= 1)
      return 1;
    else
      return 0;
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
  $sql = "SELECT * FROM members WHERE member_id = '$user[member_id]'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $sql = "SELECT * FROM login_users WHERE email = '$row[email]'";
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
          $string .= $explode[$i]." ";
      }
      if ($dots) {
          $string = substr($string, 0, strlen($string));
      }

     return $string.$dots;
}
?>
