<?php
include_once 'include/database.php';
include_once 'include/function.php';
include_once '../include/site_info.php';

session_start();

  login_test($conn);
  $user = user_data($conn);
  admin_test($conn, $user);

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

  <!-- DataTables CSS -->
  <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

  <!-- DataTables Responsive CSS -->
  <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">

  <!-- Custom Fonts -->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <h1 class="page-header">Management membrii</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                  <?php if(!isset($_GET['option'])){ ?>
                    <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline btn-warning btn-lg btn-block"onclick="window.location='edit_membrii.php?option=2';">Modificare date membru</button>
                        <button type="button" class="btn btn-outline btn-danger btn-lg btn-block"onclick="window.location='edit_membrii.php?option=3';">Stergere membru</button>
                    </div>
                    </div>
                  <?php } ?>

                  <?php if(isset($_GET['status']) && $_GET['status']==3){ ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Datele au fost modificate cu succes.
                    </div>
                  <?php } ?>

                  <?php if(isset($_GET['status']) && $_GET['status']==4){ ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Utilizatorul a fost sters complet din sistem.
                    </div>
                  <?php } ?>

                  <?php if(isset($_GET['option']) && $_GET['option']==2 && isset($_GET['user_id'])){ ?>
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                      <?php
                      $sql = "SELECT * FROM members WHERE member_id = '$_GET[user_id]'";
                      $result = mysqli_query($conn, $sql);
                      $row_u = mysqli_fetch_assoc($result);
                       ?>
                      <form method="post" action="include/form_action.php?user_id=<?php echo $_GET['user_id'] ?>">
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
                            <label>Modificati grupa</label>
                            <select name="grupa" class="form-control" required value="<?php echo $row_u['level']?>">
                                <option value="1" <?php if($row_u['level']==1) echo 'selected="selected"'?>>Grupa Incepatori</option>
                                <option value="2" <?php if($row_u['level']==2) echo 'selected="selected"'?>>Grupa Avansati</option>
                                <option value="3" <?php if($row_u['level']==3) echo 'selected="selected"'?>>Grupa Master</option>
                                <option value="99" <?php if($row_u['level']==99) echo 'selected="selected"'?>>Admin</option>
                            </select>
                        </div>
                            <div class="form-group">
                                <input type="submit" name="edit_m" required class="btn btn-primary btn-lg btn-block" value="Salveaza datele">
                            </div>

                      </form>
                    </div>
                  </div>
                  <?php } ?>


                  <?php if(isset($_GET['option']) && $_GET['option']=="info" && isset($_GET['member_id'])){ ?>
                  <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4">
                      <?php
                      $sql = "SELECT * FROM members_wait WHERE member_id = '$_GET[member_id]'";
                      $result = mysqli_query($conn, $sql);
                      $row_u = mysqli_fetch_assoc($result);
                       ?>
                       <h3> Nume: <?php echo $row_u['first_name']." ".$row_u['last_name']; ?> </h3>
                       <h3> Telefon: <?php echo $row_u['phone']; ?> </h3>
                       <h3> Email: <?php echo $row_u['email']; ?> </h3>
                       <h3> Grupa: <?php level($row_u['level']); ?> </h3>
                       <h3> Data nasterii: <?php echo date('d.m.Y',strtotime($row_u["birth_date"])); ?> </h3>
                       <h3> Adresa: <?php echo $row_u['address']; ?> </h3>
                       <button type="button" class="btn btn-success" onclick="window.location.href='include/button_action.php?option=add&member_id=<?php echo $row_u['member_id']?>'">Accepta</button>
                       <button type="button" class="btn btn-danger" onclick="window.location.href='include/button_action.php?option=reject&member_id=<?php echo $row_u['member_id']?>'">Respinge</button>
                    </div>
                  </div>
                  <?php } ?>


                  <?php if(isset($_GET['option']) && ($_GET['option'] == 2 || $_GET['option'] == 3)){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                  Lista tuturor membrilor
                              </div>
                              <!-- /.panel-heading -->
                              <div class="panel-body">
                                  <div class="table-responsive">
                                      <table class="table table-bordered table-hover" id="dataTables-example">
                                      <thead>
                                          <tr>
                                              <th>Id Membru</th>
                                              <th>Prenume</th>
                                              <th>Nume</th>
                                              <th>Grupa</th>
                                              <th>Telefon</th>
                                              <th>Email</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                             $sql = "SELECT * FROM members";
                                             $result = mysqli_query($conn, $sql);

                                             if (mysqli_num_rows($result) > 0) {
                                              // output data of each row
                                              while($row = mysqli_fetch_assoc($result)) {
                                             ?>
                                             <?php if(isset($_GET['option']) && $_GET['option'] == 2){ ?>
                                               <tr onclick="window.location='edit_membrii.php?option=2&user_id=<?php echo $row['member_id'] ?>';">
                                           <?php } if(isset($_GET['option']) && $_GET['option'] == 3){ ?>
                                              <tr onclick="window.location='include/form_action.php?option=3&user_id=<?php echo $row['member_id'] ?>';">
                                           <?php } ?>
                                                 <td>
                                                   <?php
                                                     echo $row['member_id'];
                                                     ?>
                                                 </td>
                                                 <td><?php echo $row['first_name'] ?></td>
                                                 <td><?php echo $row['last_name'] ?></td>
                                                 <td>
                                                   <?php
                                                   switch ($row['level']) {
                                                     case 1:
                                                       echo "Incepatori";
                                                       break;
                                                     case 2:
                                                       echo "Avantati";
                                                       break;
                                                     case 3:
                                                       echo "Master";
                                                       break;

                                                     default:
                                                       echo "Admin";
                                                       break;
                                                   }
                                                   ?>
                                                 </td>
                                                 <td><?php echo $row['phone']; ?></td>
                                                 <td><?php echo $row['email']; ?></td>
                                             </tr>
                                          <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!--/.row-->
                </div>
                  <?php } ?>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
