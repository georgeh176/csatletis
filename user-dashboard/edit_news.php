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
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
        <?php include_once "menu.php"; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Blank</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="form-group"><h1>Adaugati o postare noua.</h1></div>
                        <form role="form" method="post" enctype="multipart/form-data" action="include/edit_site_action.php?option=add_news">
                          <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Titlu</label>
                                      <input class="form-control" name="post_title">
                                  </div>
                                  <div class="form-group">
                                      <label>Incarca o imagine reprezentativa</label>
                                      <input type="file" name="photo" id="fileSelect">
                                  </div>
                                  <?php
                                  switch ($_GET['option']) {
                                    case 'news_info':
                                      $section = 1;
                                      break;
                                      case 'news_media':
                                        $section = 2;
                                        break;
                                        case 'events':
                                          $section = 3;
                                          break;
                                  }
                                   ?>
                                   <input type="hidden" name="section" value="<?php echo $section ?>">
                                  <input type="submit" class="btn btn-info" value="Adauga" name="add_news">
                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                          </div>
                          <!-- /.col-lg-6 (nested) -->
                          <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Continut</label>
                                        <textarea class="form-control" rows="3" name="post_content"></textarea>
                                    </div>
                          </div>
                          </form>
                          <!-- /.col-lg-6 (nested) -->
                      </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <div class="form-group"><h1>Modificati postarile existente</h1></div>
            <?php
            switch ($_GET['option']) {
              case 'news_info':
                $section = 1;
                break;
                case 'news_media':
                  $section = 2;
                  break;
                  case 'events':
                    $section = 3;
                    break;
            }
            $sql = "SELECT * FROM site_post WHERE post_section = '$section' ORDER BY post_date DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) { ?>
                <div class="row">
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="form-group"></div>
                        <form role="form" method="post" enctype="multipart/form-data" action="include/edit_site_action.php?option=<?php echo $_GET['option'] ?>">
                          <div class="col-lg-6">
                                  <div class="form-group">
                                      <label>Titlu</label>
                                      <input class="form-control" name="post_title" value="<?php echo $row['post_title'] ?>">
                                  </div>
                                  <div class="form-group">
                                      <label>Incarca o imagine reprezentativa</label>
                                      <input type="file" name="photo" id="fileSelect">
                                  </div>
                                  <input type="hidden" name="section" value="<?php echo $section ?>">
                                  <input type="hidden" name="post_id" value="<?php echo $row['post_id']?>" >
                                  <input type="submit" class="btn btn-info" value="Salveaza" name="save_news">
                                  <button type="reset" class="btn btn-default">Reseteaza</button>
                                  <input type="submit" class="btn btn-danger" value="Sterge" name="delete_news">
                          </div>
                          <!-- /.col-lg-6 (nested) -->
                          <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Continut</label>
                                        <textarea class="form-control" rows="3" name="post_content"><?php echo $row['post_content'] ?></textarea>
                                    </div>
                          </div>
                          </form>
                          <!-- /.col-lg-6 (nested) -->
                      </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
          <?php  }
        } else {
            echo "0 results";
        }

         ?>
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
