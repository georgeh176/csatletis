<?php

include_once 'include/database.php';
include_once 'include/function.php';
include_once '../include/site_info.php';

 session_start();

 if(!isset($_SESSION['user_id'])){
   header('location: login.php');
 }else{

    $sql = "SELECT * FROM members WHERE member_id = $_SESSION[user_id]";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
 }
 }

 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $site_info['site_title']." - ".$site_info['site_description'] ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
<?php include_once 'menu.php' ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Profilul utilizatorului</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4">
                    <?php if(isset($_GET['status']) && $_GET['status']==1){ ?>
                      <div class="alert alert-success alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          Datele au fost modificate cu succes.
                      </div>
                    <?php } ?>
                    <?php if(isset($_GET['status']) && $_GET['status']==2){ ?>
                      <div class="alert alert-danger alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          Parola introdusa nu se potriveste cu cea din sistem.
                      </div>
                    <?php } ?>
                    <?php
                    $sql = "SELECT * FROM members WHERE member_id = '$_SESSION[user_id]'";
                    $result = mysqli_query($conn, $sql);
                    $row_u = mysqli_fetch_assoc($result);
                     ?>
                    <form method="post" action="include/form_action.php?edit=user_edit&user_id=<?php echo $_SESSION['user_id'] ?>">
                      <div class="form-group">
                          <label>Modificati numele membrului</label>
                          <input type="name" name="nume" required class="form-control" value="<?php echo $row_u['last_name']?>">
                      </div>
                      <div class="form-group">
                          <label>Modificati prenumele membrului</label>
                          <input type="name" name="prenume" required class="form-control" value="<?php echo $row_u['first_name']?>">
                      </div>
                      <div class="form-group">
                          <label>Modificati numarul de telefon</label>
                          <input type="tel" name="telefon" required class="form-control" value="<?php echo $row_u['phone']?>">
                      </div>
                      <div class="form-group">
                          <label>Modificati adresa de e-mail</label>
                          <input type="email" name="mail" required class="form-control" value="<?php echo $row_u['email']?>">
                      </div>
                      <div class="form-group">
                          <label>Introduceti vechea parola</label>
                          <input type="password" name="old_pass" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Introduceti noua parola</label>
                          <input type="password" name="new_pass" class="form-control">
                      </div>
                          <div class="form-group">
                              <input type="submit" name="edit_user" class="btn btn-primary btn-lg btn-block" value="Salveaza datele">
                          </div>

                    </form>
                  </div>
                </div>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

</body>

</html>
