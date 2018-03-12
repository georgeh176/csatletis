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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?php count_member(1, $conn) ?></div>
                                    <div>Membrii in grupa pentru incepatori</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php count_member(2, $conn) ?></div>
                                  <div>Membrii in grupa pentru avansati</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php count_member(3, $conn) ?></div>
                                  <div>Membrii in grupa Master</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-group fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                  <div class="huge"><?php count_member(4, $conn) ?></div>
                                  <div>Membrii in toate grupele</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          Alegeti antrenamentul pentru care doriti sa vedeti participantii
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <div class="table-responsive">
                              <table class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>Ziua</th>
                                      <th>Ora</th>
                                      <th>Caracteristica</th>
                                      <th>Detalii</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                        <?php
                                            $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE()  ORDER BY p_date ASC, p_hour ASC ";
                                            $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                          // output data of each row

                                          while($row = mysqli_fetch_assoc($result)) {
                                            $antrenament=$row['id'];
                                         ?>
                                         <tr bgcolor="<?php color_cell($row['level']) ?>" onclick="window.location='info_prezenta.php?antrenament=<?php echo $antrenament ?>';" height="50">
                                        <th>
                                          <?php

                                          write_day($row["p_date"]);
                                          $data = strtotime($row["p_date"]);
                                          $data = date('d.m.Y', $data);
                                          echo " ".$data;

                                          ?>
                                        </th>
                                          <th>
                                            <?php echo $row['p_hour'] ?>
                                          </th>
                                          <th>
                                            <font color = "red" size = "5">
                                            <?php
                                            echo_caracter($row['caracter']);
                                            ?>
                                          </font>
                                          </th>
                                          <th>
                                            <?php echo $row['info'] ?>
                                          </th>
                                        </tr>
                                        <?php } } ?>
                                        <tr>
                                          <td>
                                            <p><font color = "#ff6666" size = "5"> &#9632;</font> - Toti Membri
                                            <p><font color = "#ffff4d" size = "5"> &#9632;</font> - Grupa Incepatori
                                            <p><font color = "#cece7e" size = "5"> &#9632;</font> - Grupa Avansati
                                            <p><font color = "#80bfff" size = "5"> &#9632;</font> - Grupa Master
                                          </td>
                                          <td>
                                            <p><font color = "#ff0000" size = "4"> &#8599;</font> - Tempo Progresiv
                                            <p><font color = "#ff0000" size = "4"> &#8597;</font> - Fartlek
                                            <p><font color = "#ff0000" size = "4"> &#8801;</font> - Repetari
                                            <p><font color = "#ff0000" size = "4"> R </font> - Volum
                                          </td>
                                          <td>
                                            <p><font color = "#ff0000" size = "4"> &#137;</font> - Panta
                                            <p><font color = "#ff0000" size = "5"> &#8368;</font> - Teren Variat
                                            <p><font color = "#ff0000" size = "4"> &#10227;</font> - Traseu Inchis
                                            <p><font color = "#ff0000" size = "4"> &#10132;</font> - Traseu intr-o singura directie
                                          </td>
                                          <td>

                                          </td>
                                        </tr>
                                  </tbody>
                                  <script>
                                  jQuery(document).ready(function($) {
                                    $(".clickable-row").click(function() {
                                        window.location = $(this).data("href");
                                      });
                                    });
                                </script>
                              </table>
                              <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=1';">Creare antrenament</button>
                              <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=2';">Modificare antrenament</button>
                              <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=3';">Repetare antrenament</button>
                              <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=4';">Stergere antrenament</button>                           <!-- /.table-responsive -->

                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row-->

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
                                      <th width="10">Id Membru</th>
                                      <th>Prenume</th>
                                      <th>Nume</th>
                                      <th>Grupa</th>
                                      <th>Telefon</th>
                                      <th width="20">Email</th>
                                      <th>Data nasterii</th>
                                      <th>Adresa</th>
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
                                     <tr>
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
                                               echo "Fara grupa !";
                                               break;
                                           }
                                           ?>
                                         </td>
                                         <td><?php echo $row['phone']; ?></td>
                                         <td><?php echo $row['email']; ?></td>
                                         <td>
                                         <?php
                                         $data = strtotime($row["birth_date"]);
                                         $data = date('d.m.Y', $data);
                                         echo " ".$data;
                                         ?>
                                         </td>
                                         <td><?php echo $row['address'] ?></td>
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
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

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
