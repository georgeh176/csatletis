
<?php
include_once 'database.php';
include_once 'function.php';

session_start();
login_test($conn);
$user = user_data($conn);
admin_test($conn, $user);

// modificarea unui antrenament selectat

if (isset($_POST['sub_edit'])) {
	$caracter = 0;
	for ($i = 1; $i <= 8; $i++) {
		if (isset($_POST['crt' . $i])) $caracter = $caracter * 10 + $_POST['crt' . $i];
	}

	$sql = "UPDATE db_timetable SET p_date = '$_POST[data_antr]', p_hour = '$_POST[ora]', level = '$_POST[grupa]', caracter = '$caracter', info = '$_POST[info_a]' WHERE id = '$_GET[antrenament]'";
	if (mysqli_query($conn, $sql)) {
		header('location: ../edit_orar.php?status=1&option=2');
	}
	else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}

// adaugarea unui antrenament

$caracter = 0;

if (isset($_POST['sub_add'])) {
	for ($i = 1; $i <= 8; $i++) {
		if (isset($_POST['crt' . $i])) $caracter = $caracter * 10 + $_POST['crt' . $i];
	}

	$sql = "SELECT * FROM db_timetable WHERE p_date = '$_POST[data_antr]'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {

		// output data of each row

		while ($row = mysqli_fetch_assoc($result)) {
			if ($row['p_hour'] == ($_POST['ora'] . ":00")) {
				if ($row['level'] == $_POST['grupa'])
				if ($row['caracter'] == $caracter) {
					header('location: ../edit_orar.php?option=1&status=0&data=' . $_POST['data_antr'] . '&ora=' . $_POST['ora'] . '&grupa=' . $_POST['grupa'] . '&caracter=' . $caracter . '&info_a=' . $_POST['info_a']);
				}
			}
			else {
				$sql = "INSERT INTO db_timetable (p_date, p_hour, level, caracter, info)
              VALUES ('$_POST[data_antr]', '$_POST[ora]', '$_POST[grupa]', '$caracter', '$_POST[info_a]')";
				if (mysqli_query($conn, $sql)) {
					header('location: ../edit_orar.php?option=1');
				}
				else {
					echo "Error: " . $sql . "<br />" . mysqli_error($conn);
				}
			}
		}
	}
	else {
		$sql = "INSERT INTO db_timetable (p_date, p_hour, level, caracter, info)
            VALUES ('$_POST[data_antr]', '$_POST[ora]', '$_POST[grupa]', '$caracter', '$_POST[info_a]')";
		if (mysqli_query($conn, $sql)) {
			header('location: ../edit_orar.php?option=1');
		}
		else {
			echo "Error: " . $sql . "<br />" . mysqli_error($conn);
		}
	}
}

if (isset($_GET['status']) && ($_GET['status'] == 2)) {
	$sql = "INSERT INTO db_timetable (p_date, p_hour, level, caracter, info)
            VALUES ('$_GET[data]', '$_GET[ora]', '$_GET[grupa]', '$_GET[caracter]', '$_GET[info_a]')";
	$result = mysqli_query($conn, $sql);
}

// repetare unui antrenament

if (isset($_GET['sub_rep'])) {
	for ($i = 1; $i <= $_GET['i']; $i++) {
		$rep = "rep" . $i;
		if (isset($_GET[$rep])) {
			$sql = "SELECT * FROM db_timetable WHERE id='$_GET[$rep]'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
			$date = $row['p_date'];
			for ($j = 1; $j <= $_GET['repeat']; $j++) {
				$date = strtotime($date);
				$date = strtotime('+7 day', $date);
				$date = date("Y-m-d", $date);
				$sql = "INSERT INTO db_timetable (p_date, p_hour, level, caracter, info)
              VALUES ('$date', '$row[p_hour]', '$row[level]', '$row[caracter]', '$row[info]')";
				$result = mysqli_query($conn, $sql);
			}
		}
	}

	header('location: ../edit_orar.php?status=4&option=3');
}

// stergerea unui antrenament

if (isset($_GET['sub_del'])) {
	for ($i = 1; $i <= $_GET['i']; $i++) {
		$rep = "rep" . $i;
		if (isset($_GET[$rep])) {
			$sql = "DELETE FROM db_timetable WHERE id='$_GET[$rep]'";
			$result = mysqli_query($conn, $sql);
		}
	}

	header('location: ../edit_orar.php?status=5&option=4');
}

// adaugarea unui membru

if (isset($_POST['sign_up'])) {
	$sql = "INSERT INTO members_wait (first_name, last_name, email, phone, address, birth_date, level, password, team)
          VALUES ('$_POST[first_name]', '$_POST[last_name]','$_POST[email]', '$_POST[phone]','$_POST[address]','$_POST[birth_date]', '$_POST[level]', '$_POST[password]', 'user')";
	if (mysqli_query($conn, $sql)) {
		header('location: ../sign_up.php?status=1');
	}
	else {
		echo "Error: " . $sql . "<br />" . mysqli_error($conn);
	}
}

if (isset($_POST['edit_m'])) {
	$sql = "SELECT email FROM members WHERE member_id = '$_GET[user_id]'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "UPDATE members SET first_name='$_POST[prenume]', last_name='$_POST[nume]', phone='$_POST[telefon]', email='$_POST[mail]', level='$_POST[grupa]' WHERE member_id='$_GET[user_id]'";
	$sql2 = "UPDATE login_users SET email='$_POST[mail]' WHERE email='$row[email]'";
	if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
		header('location: ../edit_membrii.php?option=2&status=3');
	}
	else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}

if (isset($_GET['option']) && $_GET['option'] == 3) {
	$sql = "SELECT email FROM members WHERE member_id='$_GET[user_id]'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "DELETE FROM db_present WHERE id_member='$_GET[user_id]'";
	$sql2 = "DELETE FROM members WHERE member_id='$_GET[user_id]'";
	$sql3 = "DELETE FROM login_users WHERE email='$row[email]'";
	if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2) && mysqli_query($conn, $sql3)) {
		header('location: ../edit_membrii.php?option=3&status=4');
	}
	else {
		echo "Error deleting record: " . mysqli_error($conn);
	}
}

if (isset($_POST['edit_user'])) {
	$sql = "SELECT * FROM members WHERE member_id='$_GET[user_id]'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$sql = "SELECT * FROM login_users WHERE email='$row[email]'";
	$result = mysqli_query($conn, $sql);
	$row2 = mysqli_fetch_assoc($result);
	if (!empty($_POST['old_pass'])) {
		if ($_POST['old_pass'] == $row2['password']) {
			$sql = "UPDATE members SET first_name='$_POST[prenume]', last_name='$_POST[nume]', phone='$_POST[telefon]', email='$_POST[mail]' WHERE member_id='$_GET[user_id]'";
			$sql2 = "UPDATE login_users SET email='$_POST[mail]', password='$_POST[new_pass]' WHERE email='$row[email]'";
		}
		else {
			header('location: ../user_profile.php?status=2');
			exit();
		}
	}
	else {
		$sql = "UPDATE members SET first_name='$_POST[prenume]', last_name='$_POST[nume]', phone='$_POST[telefon]', email='$_POST[mail]' WHERE member_id='$_GET[user_id]'";
		$sql2 = "UPDATE login_users SET email='$_POST[mail]' WHERE email='$row[email]'";
	}

	if (mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)) {
		header('location: ../user_profile.php?status=1');
	}
	else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}

if (isset($_POST['site_info_edit'])) {
	if (isset($_POST['site_title'])) $sql = "UPDATE site_option SET option_value='$_POST[site_title]' WHERE option_name='site_title'";
	if (isset($_POST['site_description'])) $sql = "UPDATE site_option SET option_value='$_POST[site_description]' WHERE option_name='site_description'";
	if (isset($_POST['long_title'])) $sql = "UPDATE site_option SET option_value='$_POST[long_title]' WHERE option_name='long_title'";
	if (isset($_POST['long_description'])) $sql = "UPDATE site_option SET option_value='$_POST[long_description]' WHERE option_name='long_description'";
	if (isset($_POST['site_adress'])) $sql = "UPDATE site_option SET option_value='$_POST[site_adress]' WHERE option_name='site_adress'";
	if (isset($_POST['site_phone'])) $sql = "UPDATE site_option SET option_value='$_POST[site_phone]' WHERE option_name='site_phone'";
	if (isset($_POST['site_email'])) $sql = "UPDATE site_option SET option_value='$_POST[site_email]' WHERE option_name='site_email'";
	if (isset($_POST['slide1'])) $sql = "UPDATE site_option SET option_value='$_POST[slide1]' WHERE option_name='slide1'";
	if (isset($_POST['slide2'])) $sql = "UPDATE site_option SET option_value='$_POST[slide2]' WHERE option_name='slide2'";
	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
		header("location: ../edit_site.php?option=edit_info_site");
	}
	else {
		echo "Error updating record: " . mysqli_error($conn);
	}
}

?>
