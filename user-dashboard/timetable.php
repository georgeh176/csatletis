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

    <!-- DataTables CSS -->
    <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

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

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Programul sedintelor de antrenament</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="col-lg-12">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          Pentru a va intregistra apasati pe ziua in care doriti sa participati la antrenament.
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                        <?php if(isset($_GET['status'])){
                                if($_GET['status']==1){ ?>
                                  <div class="alert alert-danger alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      Ati aplicat deja odata pentru acest antrenament. <a href="include/prezenta.php?option=2&antrenament=<?php echo $_GET['antrenament']; ?>" class="alert-link">Vreau sa ma retrag !</a>.
                                  </div>
                              <?php }
                                if ($_GET['status']==2) { ?>
                                  <div class="alert alert-success alert-dismissable">
                                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                      Ati fost inregistrat pentru antrenament. <a href="include/prezenta.php?option=2&antrenament=<?php echo $_GET['antrenament']; ?>" class="alert-link">Anuleaza !</a>
                                  </div>
                              <?php  }} ?>
                              <?php
                              if (isset($_GET['status']) && $_GET['status']==3) { ?>
                                <div class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    Antrenamentul selectat a fost anulat. Pentru inregistrare selectati antrenamentul dorit.
                                </div>
                            <?php  } ?>
                              <?php if(!isset($_GET['show']))
                                      $_GET['show']=1;
                                      if($_GET['show']==1){ ?>
                              <div class="alert alert-info alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  Programul antrenamentelor recomandate pentru dumneavoastra. <a href="?show=0" class="alert-link">Arata toate antrenamentele</a>.
                              </div>
                            <?php } else{ ?>
                              <div class="alert alert-info alert-dismissable">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  Sunt afisate toate antrenamentele disponibile. <a href="?show=1" class="alert-link">Arata antrenamentele recomandate</a>.
                              </div>
                            <?php } ?>
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

                                        switch ($user['level']) {
                                          case 1:
                                            $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE() and (level = 1 or level = 2)  ORDER BY p_date ASC, p_hour ASC";
                                            break;
                                          case 2:
                                            $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE() and (level = 1 or level = 3) ORDER BY p_date ASC, p_hour ASC ";
                                            break;
                                          case 3:
                                            $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE() and (level = 1 or level = 4)  ORDER BY p_date ASC, p_hour ASC ";
                                            break;

                                          default:
                                            $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE()  ORDER BY p_date ASC, p_hour ASC ";
                                            break;
                                        }
                                        if($_GET['show']==0){
                                          $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE()  ORDER BY p_date ASC, p_hour ASC ";
                                        }
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                          // output data of each row

                                          while($row = mysqli_fetch_assoc($result)) {
                                            $antrenament=$row['id'];
                                         ?>
                                         <tr bgcolor="<?php color_cell($row['level']) ?>" onclick="window.location='include/prezenta.php?option=1&antrenament=<?php echo $antrenament ?>';" height="50">
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
                          </div>
                          <!-- /.table-responsive -->

                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

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
