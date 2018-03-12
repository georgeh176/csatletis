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
  <meta http-equiv="Content-type" content="text/html;charset=utf-8" />

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
        <?php include_once "menu.php"; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Editare site</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

            <?php if($_GET['option'] == 'edit_img'){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Adaugati imaginea
                        </div>
                              <div class="panel-body">
                                  <div class="row">
                                    <form role="form" method="post" enctype="multipart/form-data" action="include/edit_site_action.php?option=add_img_to_section">
                                      <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label>Titlu</label>
                                                  <input class="form-control" name="title">
                                              </div>
                                              <div class="form-group">
                                                  <label>Descriere</label>
                                                  <input class="form-control" name="description">
                                              </div>
                                              <div class="form-group">
                                                  <label>Alegeti imaginea</label>
                                                  <input type="file" name="photo" id="fileSelect">
                                              </div>
                                              <div class="form-group">
                                                  <label>Sectiunea</label>
                                                  <select class="form-control" name="section_id">
                                              <?php
                                              $sql = "SELECT * FROM site_section";
                                              $result = mysqli_query($conn, $sql);

                                              if (mysqli_num_rows($result) > 0) {
                                                  // output data of each row
                                                  while($row = mysqli_fetch_assoc($result)) {?>
                                                      <option value="<?php echo $row['section_id'] ?>"><?php echo $row['name'] ?></option>
                                                <?php  }
                                              } else {
                                                  echo "0 results";
                                              }
                                               ?>
                                                  </select>
                                              </div>
                                              <input type="submit" class="btn btn-info" value="Salveaza" name="add_img_to_section">
                                              <button type="reset" class="btn btn-default">Reseteaza</button>
                                      </div>
                                    </form>
                                  </div>
                                      <!-- /.col-lg-6 (nested) -->
                                  </div>
                                  <!-- /.row (nested) -->
                              </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php } ?>


            <?php if($_GET['option'] == 'edit_info_site'){ ?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Editati informatiile despre site
                        </div>
                              <div class="panel-body">
                                  <div class="row">
                                      <div class="col-lg-12">
                                              <?php

                                              $sql = "SELECT * FROM site_option";
                                              $result = mysqli_query($conn, $sql);
                                              while($row = mysqli_fetch_assoc($result)) {
                                                switch ($row['option_name']) {
                                                  case 'site_title':
                                                    ?>
                                                    <form role="form" method="post" action="include/form_action.php">
                                                    <div class="form-group">
                                                        <label>Titlu</label>
                                                        <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                    <button type="reset" class="btn btn-default">Reseteaza</button>
                                                    </div>
                                                  </form>
                                                    <?php
                                                    break;
                                                  case 'site_description':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Scurta descriere</label>
                                                      <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                  case 'long_title':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Titlul (varianta lunga)</label>
                                                      <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                  case 'long_description':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Descriere complexa (apare pe pagina "Despre noi")</label>
                                                      <textarea class="form-control" name="<?php echo $row['option_name'] ?>"><?php echo $row['option_value'] ?></textarea>
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                  case 'site_adress':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Adresa de contact</label>
                                                      <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                  case 'site_phone':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Numar de telefon</label>
                                                      <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                  case 'site_email':
                                                  ?>
                                                  <form role="form" method="post" action="include/form_action.php">
                                                  <div class="form-group">
                                                      <label>Email</label>
                                                      <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                  <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                                  </div>
                                                </form>
                                                  <?php
                                                    break;
                                                    case 'slide1':
                                                    ?>
                                                    <form role="form" method="post" action="include/form_action.php">
                                                    <div class="form-group">
                                                        <label>Mesajul de pe slide-ul 2</label>
                                                        <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                    </div>
                                                    <div class="form-group">
                                                    <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                    <button type="reset" class="btn btn-default">Reseteaza</button>
                                                    </div>
                                                  </form>
                                                    <?php
                                                      break;
                                                      case 'slide2':
                                                      ?>
                                                      <form role="form" method="post" action="include/form_action.php">
                                                      <div class="form-group">
                                                          <label>Mesajul de pe slide-ul 3</label>
                                                          <input type="name" class="form-control" name="<?php echo $row['option_name'] ?>" value="<?php echo $row['option_value'] ?>">
                                                      </div>
                                                      <div class="form-group">
                                                      <input type="submit" class="btn btn-info" value="Salveaza" name="site_info_edit">
                                                      <button type="reset" class="btn btn-default">Reseteaza</button>
                                                      </div>
                                                    </form>
                                                      <?php
                                                        break;

                                                  default:
                                                    # code...
                                                    break;
                                                }
                                              }

                                               ?>
                                      </div>
                                    </form>
                                  </div>
                                      <!-- /.col-lg-6 (nested) -->
                                  </div>
                                  <!-- /.row (nested) -->
                              </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <?php } ?>

            <?php if(isset($_GET['team_member_id'])){ ?>

              <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                  <?php
                  $sql = "SELECT * FROM members WHERE member_id = '$_GET[team_member_id]'";
                  $result = mysqli_query($conn, $sql);
                  $row_u = mysqli_fetch_assoc($result);
                   ?>
                  <form method="post" enctype="multipart/form-data" action="include/edit_site_action.php?team_member_id=<?php echo $_GET['team_member_id'] ?>">
                    <div class="form-group">
                        <label>Rolul membrului</label>
                        <input type="name" name="role" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Scurta descriere</label>
                        <input type="name" name="description" required class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Imagine de profil</label>
                        <input type="file" name="photo">
                    </div>
                        <div class="form-group">
                            <input type="submit" name="team_edit" required class="btn btn-primary btn-lg btn-block" value="Salveaza datele">
                        </div>

                  </form>
                </div>
              </div>
                <!-- /.col-lg-12 -->
            <?php } ?>



            <?php if($_GET['option'] == 'edit_team'){ ?>
              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            Alegeti un membrul pe care doriti sa-l stergeti.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Prenume</th>
                                        <th>Nume</th>
                                        <th>Telefon</th>
                                        <th width="20">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM site_team";
                                  $result = mysqli_query($conn, $sql);
                                      // output data of each row
                                      while($row = mysqli_fetch_assoc($result)) {
                                        $sql2 = "SELECT * FROM members where member_id='$row[member_id]'";
                                        $result2 = mysqli_query($conn, $sql2);
                                            // output data of each row
                                            while($row2 = mysqli_fetch_assoc($result2)) {
                                       ?>
                                       <tr onclick="window.location.href='include/edit_site_action.php?option=delete_team&team_member_id=<?php echo $row2['member_id'] ?>'">
                                           <td><?php echo $row2['first_name'] ?></td>
                                           <td><?php echo $row2['last_name'] ?></td>
                                           <td><?php echo $row2['phone']; ?></td>
                                           <td><?php echo $row2['email']; ?></td>
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

              <div class="row">
                  <div class="col-lg-12">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            Alegeti un membru pentru a fi adaugat pe site in sectiunea Echipa.
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Prenume</th>
                                        <th>Nume</th>
                                        <th>Telefon</th>
                                        <th width="20">Email</th>
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
                                       <tr onclick="window.location.href='edit_site.php?option=edit_team&team_member_id=<?php echo $row['member_id'] ?>'">
                                           <td><?php echo $row['first_name'] ?></td>
                                           <td><?php echo $row['last_name'] ?></td>
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



            <?php if($_GET['option'] == 'edit_section'){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Editati doar datele ce trebuie modificate
                        </div>
                        <?php
                        $sql = "SELECT * FROM site_section";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            // output data of each row
                            while($row = mysqli_fetch_assoc($result)) {?>
                              <div class="panel-body">
                                  <div class="row">
                                    <form role="form" method="post" enctype="multipart/form-data" action="include/edit_site_action.php?option=edit_section">
                                      <div class="col-lg-6">
                                              <div class="form-group">
                                                  <label>Numele sectiunii</label>
                                                  <input class="form-control" name="name" value="<?php echo $row['name'] ?>">
                                              </div>
                                              <div class="form-group">
                                                  <label>Scurta descriere</label>
                                                  <input class="form-control" name="description" value="<?php echo $row['description'] ?>">
                                              </div>
                                              <input type="hidden" name="section_id" value="<?php echo $row['section_id'] ?>" >
                                              <div class="form-group">
                                                  <label>Incarca o imagine reprezentativa</label>
                                                  <input type="file" name="photo" id="fileSelect">
                                              </div>
                                              <input type="submit" class="btn btn-info" value="Salveaza" name="edit">
                                              <button type="reset" class="btn btn-default">Reseteaza</button>
                                              <input type="submit" class="btn btn-danger" value="Sterge" name="delete">
                                      </div>
                                      <!-- /.col-lg-6 (nested) -->
                                      <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Descriere lunga</label>
                                                    <textarea class="form-control" rows="3" name="long_description"><?php echo $row['long_description'] ?></textarea>
                                                </div>
                                      </div>
                                    </form>
                                      <!-- /.col-lg-6 (nested) -->
                                  </div>
                                  <!-- /.row (nested) -->
                              </div>
                            <?php }
                        } else {
                            echo "0 results";
                        }
                         ?>

                         <div class="panel-body">
                             <div class="row"><div class="form-group"><h1>Sectiune noua</h1></div>
                               <form role="form" method="post" enctype="multipart/form-data" action="include/edit_site_action.php?option=edit_section&section_id=<?php echo $row['section_id'] ?>">
                                 <div class="col-lg-6">
                                         <div class="form-group">
                                             <label>Numele sectiunii</label>
                                             <input class="form-control" name="name" value="<?php echo $row['name'] ?>">
                                         </div>
                                         <div class="form-group">
                                             <label>Scurta descriere</label>
                                             <input class="form-control" name="description" value="<?php echo $row['description'] ?>">
                                         </div>
                                         <div class="form-group">
                                             <label>Incarca o imagine reprezentativa</label>
                                             <input type="file" name="photo" id="fileSelect">
                                         </div>
                                         <input type="submit" class="btn btn-info" value="Salveaza" name="add">
                                         <button type="reset" class="btn btn-default">Reseteaza</button>
                                 </div>
                                 <!-- /.col-lg-6 (nested) -->
                                 <div class="col-lg-6">
                                           <div class="form-group">
                                               <label>Descriere lunga</label>
                                               <textarea class="form-control" rows="3" name="long_description"><?php echo $row['long_description'] ?></textarea>
                                           </div>
                                     </form>
                                 </div>
                                 <!-- /.col-lg-6 (nested) -->
                             </div>
                             <!-- /.row (nested) -->
                         </div>

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
          <?php } ?>
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
    <!-- Text area rich text -->
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

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
