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
        <?php include_once 'menu.php'; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">

              <?php
              if(isset($_GET['msg_id'])){
                $sql = "SELECT * FROM site_messages WHERE id = '$_GET[msg_id]'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $sql = "UPDATE site_messages SET seen='1' WHERE id='$_GET[msg_id]'";

                if (!mysqli_query($conn, $sql)) {
                    echo "Error updating record: " . mysqli_error($conn);
                  }
                ?>
              <div class="row">
                  <div class="col-lg-12">
                      <h1 class="page-header">Mesaj primit</h1>
                  </div>
                  <!-- /.col-lg-12 -->
                  <div class="col-lg-12">
                      <div class="panel panel-primary">
                          <div class="panel-heading">
                              De la: <?php echo $row['last_name']." ".$row['first_name'] ?>
                              <span class="pull-right">Telefon: <?php echo $row['phone'] ?></span><br>
                              <span class="pull-right">Email: <?php echo $row['email'] ?></span><br>
                          </div>
                          <div class="panel-body">
                              <p><?php echo $row['message']?></p>
                          </div>
                          <div class="panel-footer">
                              <?php
                              echo "Primit ";
                              lc_write_day($row['mess_date']);
                              echo " ".date('d.m.Y', strtotime($row['mess_date']))." la ora ".date('h:m', strtotime($row['mess_date']));
                               ?>
                          </div>
                      </div>
                  </div>
              </div>
            <?php } ?>
                          <!-- /.panel-body -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Mesaje</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Lista completa a mesajelor
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Expeditorul</th>
                                                <th>Mesajul</th>
                                                <th>Contact</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $sql = "SELECT * FROM site_messages";
                                          $result = mysqli_query($conn, $sql);

                                          if (mysqli_num_rows($result) > 0) {
                                              // output data of each row
                                              while($row = mysqli_fetch_assoc($result)) { ?>
                                                <tr>
                                                    <td><?php echo $row['mess_date']?></td>
                                                    <td><?php echo $row['last_name']." ".$row['first_name']?></td>
                                                    <td><?php echo limit_words($row['message'], 10)?></td>
                                                    <td><?php echo $row['phone']."<br>".$row['email'];?></td>
                                                </tr>
                                          <?php    }
                                          } else {
                                              echo "0 results";
                                          }

                                           ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->

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
