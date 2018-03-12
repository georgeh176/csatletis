<?php

include_once 'include/database.php';
include_once 'include/function.php';
include_once '../include/site_info.php';

session_start();

  login_test($conn);
  $user = user_data($conn);
  admin_test($conn, $user);

 if(!isset($_SESSION['user_id'])){
   header('location: login.php');
 }else{

    $sql = "SELECT * FROM members WHERE member_id = $_SESSION[user_id]";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
 }
 }

  $sql = "SELECT * FROM db_timetable WHERE id='$_GET[antrenament]'  ORDER BY p_date ASC, p_hour ASC ";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) ==1)
    $row = mysqli_fetch_assoc($result);
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
                         <h1 class="page-header">Lista pentru participare</h1>
                     </div>
                     <!-- /.col-lg-12 -->
                 </div>
                 <!-- /.row -->
                 <div class="row">
                     <div class="col-lg-12">
                         <div class="panel panel-default">
                             <div class="panel-heading">
                                 Lista participantilor la antrenamentul de
                                 <?php

                                 write_day($row["p_date"]);
                                 $data = strtotime($row["p_date"]);
                                 $data = date('d.m.Y', $data);
                                 echo " ".$data;

                                 ?>
                                 ora <?php echo $row['p_hour'] ?>
                             </div>
                             <!-- /.panel-heading -->
                             <div class="panel-body">
                                 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                     <thead>
                                         <tr>
                                             <th>Id Membru</th>
                                             <th>Prenume</th>
                                             <th>Nume</th>
                                             <th>Grupa</th>
                                             <th>Telefon</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                       <?php
                                        $sql = "SELECT * FROM db_present WHERE id_timetable = $_GET[antrenament]";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            // output data of each row
                                            while($row = mysqli_fetch_assoc($result)) {
                                              $sql_p = "SELECT * FROM members WHERE member_id = $row[id_member]";
                                              $result_p = mysqli_query($conn, $sql_p);
                                              $row_p = mysqli_fetch_assoc($result_p);
                                              ?>
                                              <tr>
                                                  <td>
                                                    <?php
                                                      echo $row_p['member_id'];
                                                      if($row['cancel'] == 1)
                                                      echo " (Anulat)";
                                                    ?>
                                                  </td>
                                                  <td><?php echo $row_p['first_name'] ?></td>
                                                  <td><?php echo $row_p['last_name'] ?></td>
                                                  <td>
                                                    <?php
                                                    switch ($row_p['level']) {
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
                                                        echo "Nu s-a putut identifica grupa !";
                                                        break;
                                                    }
                                                    ?>
                                                  </td>
                                                  <td><?php echo $row_p['phone'] ?></td>
                                              </tr>
                                            <?php }
                                        } else {
                                            echo "0 results";
                                        }
                                        ?>
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
