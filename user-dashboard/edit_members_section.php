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
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Editatie datele de mai jos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <?php if($_GET['option'] == 'benefits'){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Editati datele
                                </div>
                                      <div class="panel-body">
                                          <div class="row">
                                            <form role="form" method="post" enctype="multipart/form-data" action="include/action2.php?option=edit_member_benefits">
                                              <div class="col-lg-12">
                                                <?php
                                                  $sql = "SELECT * FROM site_member_section where section='benefits'";
                                                  $result = mysqli_query($conn, $sql);
                                                  $row = mysqli_fetch_assoc($result);
                                                ?>
                                                          <div class="form-group">
                                                              <label>Continut</label>
                                                              <textarea class="form-control" rows="3" name="benefits_content"><?php echo $row['content'] ?></textarea>
                                                          </div>
                                                      <input type="submit" class="btn btn-info" value="Salveaza" name="edit_member_benefits">
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

                    <?php if($_GET['option'] == 'statute'){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Editati datele
                                </div>
                                      <div class="panel-body">
                                          <div class="row">
                                            <form role="form" method="post" enctype="multipart/form-data" action="include/action2.php?option=edit_member_statute">
                                              <div class="col-lg-12">
                                                <?php
                                                  $sql = "SELECT * FROM site_member_section where section='statute'";
                                                  $result = mysqli_query($conn, $sql);
                                                  $row = mysqli_fetch_assoc($result);
                                                ?>
                                                          <div class="form-group">
                                                              <label>Continut</label>
                                                              <textarea class="form-control" rows="3" name="benefits_content"><?php echo $row['content'] ?></textarea>
                                                          </div>
                                                      <input type="submit" class="btn btn-info" value="Salveaza" name="edit_member_statute">
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


                    <?php if($_GET['option'] == 'pay-dues'){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Editati datele
                                </div>
                                      <div class="panel-body">
                                          <div class="row">
                                            <form role="form" method="post" enctype="multipart/form-data" action="include/action2.php?option=edit_member_pay-dues">
                                              <div class="col-lg-12">
                                                <?php
                                                  $sql = "SELECT * FROM site_member_section where section='pay-dues'";
                                                  $result = mysqli_query($conn, $sql);
                                                  $row = mysqli_fetch_assoc($result);
                                                ?>
                                                          <div class="form-group">
                                                              <label>Continut</label>
                                                              <textarea class="form-control" rows="3" name="benefits_content"><?php echo $row['content'] ?></textarea>
                                                          </div>
                                                      <input type="submit" class="btn btn-info" value="Salveaza" name="edit_member_pay-dues">
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
    <!-- Text area rich text -->
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    <script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>

</body>

</html>
