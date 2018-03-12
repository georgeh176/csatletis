<?php
include_once "core/database.php";
include_once "core/info-site.php";
include_once "core/function.php";

login_test($conn);
$user = user_data($conn);
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Advanced form elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <?php include_once "navbar.php"; ?>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
    <?php include_once "sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Advanced Form Elements
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <?php if($_GET['option'] == "add_data_timetable"){ ?>
        <div class="col-md-6">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Input masks</h3>
            </div>
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <form method="post" action="core/actions.php?option=add_new_timetable_data">
              <div class="form-group">
                <label>Data:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" name="practice_date">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Ora</label>
                  <div class="input-group">
                    <input type="time" class="form-control" name="practice_hour">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <div class="form-group">
                <label>Antrenorul</label>
                <select class="form-control select2" style="width: 100%;" name="trainer_id">
                  <?php
                    $sql = "SELECT DISTINCT member_id FROM db_trainers";
                    $result = mysqli_query($conn, $sql);
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) {
                        $sql2 = "SELECT * FROM members where member_id = '$row[member_id]'";
                        $result2 = mysqli_query($conn, $sql2);
                          // output data of each row
                          while($row2 = mysqli_fetch_assoc($result2)) {
                        ?>
                          <option value="<?php echo $row['member_id'] ?>"><?php echo $row2['first_name'] ?></option>
                      <?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Grupa</label>
                <select class="form-control select2" style="width: 100%;" name="level">
                  <?php
                    $sql = "SELECT * FROM db_level";
                    $result = mysqli_query($conn, $sql);
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['level_id'] ?>"><?php echo $row['level_name'] ?></option>
                      <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Sectia</label>
                <select class="form-control select2" style="width: 100%;" name="section_id">
                  <?php
                    $sql = "SELECT * FROM site_section";
                    $result = mysqli_query($conn, $sql);
                      // output data of each row
                      while($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['section_id'] ?>"><?php echo $row['name'] ?></option>
                      <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Traseul</label>
                <select class="form-control select2" style="width: 100%;" name="route">
                  <?php
//codul pentru generarea traseului
                  ?>
                </select>
              </div>
              <label>Selectati criteriile antrenamentului</label>
              <div class="form-group">
                  <div class="col-md-6">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt1" value="1"><font color = "#ff0000" size = "4"> &#8599;</font> - Tempo Progresiv
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt2" value="2"><font color = "#ff0000" size = "4"> &#8597;</font> - Fartlek
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt3" value="3"><font color = "#ff0000" size = "4"> &#8801;</font> - Repetari
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt4" value="4"><font color = "#ff0000" size = "4"> R </font> - Volum
                      </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt5" value="5"><font color = "#ff0000" size = "4"> &#137;</font> - Panta
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt6" value="6"><font color = "#ff0000" size = "5"> &#8368;</font> - Teren Variat
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt7" value="7"><font color = "#ff0000" size = "4"> &#10227;</font> - Traseu Inchis
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt8" value="8"><font color = "#ff0000" size = "4"> &#10132;</font> - Traseu intr-o singura directie
                      </label>
                  </div>
                  </div>
                  <div class="form-group">
                      <label>Detalii</label>
                      <textarea class="form-control" name="info" placeholder="Introduceti detalii despre antrenament." rows="3"></textarea>
                  </div>
                  <div class="checkbox">
                          <input type="submit" class="btn btn-primary" name="submit" value="Adauga">
                          <input type="reset" class="btn btn-default">
                  </div>
              </div>
            </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tutorial:</h3>
            </div>
            <div class="box-body">
              1. bla bla bla
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      <?php } ?>
      <?php if($_GET['option'] == "edit_data_timetable"){ ?>
        <div class="col-md-6">

          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">Modificati antrenamentul selectat</h3>
            </div>
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <?php
              $choose = $_POST['attendance'];
              $one_choose = $choose['0'];
              $sql = "SELECT * FROM db_timetable WHERE id = '$one_choose'";
              $result = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($result);
               ?>
              <form method="post" action="core/actions.php?option=edit_data_timetable&practice_id=<?php echo $one_choose ?>">
              <div class="form-group">
                <label>Data:</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control pull-right" name="practice_date" value="<?php echo date("Y-m-d", strtotime($row['p_date'])) ?>">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="bootstrap-timepicker">
                <div class="form-group">
                  <label>Ora</label>
                  <div class="input-group">
                    <input type="time" class="form-control" name="practice_hour" value="<?php echo $row['p_hour']; ?>">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>
              <div class="form-group">
                <label>Antrenorul</label>
                <select class="form-control select2" style="width: 100%;" name="trainer_id">
                  <?php
                    $sql_aux = "SELECT DISTINCT member_id FROM db_trainers";
                    $result_aux = mysqli_query($conn, $sql_aux);
                      // output data of each row
                      while($row_aux = mysqli_fetch_assoc($result_aux)) {
                        $sql_aux2 = "SELECT * FROM members where member_id = '$row_aux[member_id]'";
                        $result_aux2 = mysqli_query($conn, $sql_aux2);
                          // output data of each row
                          while($row_aux2 = mysqli_fetch_assoc($result_aux2)) {
                        ?>
                          <option value="<?php echo $row_aux['member_id'] ?>" <?php if($row["trainer_id"] == $row_aux['member_id']) echo 'selected="selected"' ?>><?php echo $row_aux2['first_name'] ?></option>
                      <?php } } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Grupa</label>
                <select class="form-control select2" style="width: 100%;" name="level">
                  <?php
                    $sql_aux = "SELECT * FROM db_level";
                    $result_aux = mysqli_query($conn, $sql_aux);
                      // output data of each row
                      while($row_aux = mysqli_fetch_assoc($result_aux)) { ?>
                          <option value="<?php echo $row_aux['level_id'] ?>" <?php if($row["level"] == $row_aux['level_id']) echo 'selected="selected"' ?>><?php echo $row_aux['level_name'] ?></option>
                      <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Sectia</label>
                <select class="form-control select2" style="width: 100%;" name="section_id">
                  <?php
                    $sql_aux = "SELECT * FROM site_section";
                    $result_aux = mysqli_query($conn, $sql_aux);
                      // output data of each row
                      while($row_aux = mysqli_fetch_assoc($result_aux)) { ?>
                          <option value="<?php echo $row_aux['section_id'] ?>" <?php if($row["section_id"] == $row_aux['section_id']) echo 'selected="selected"' ?>><?php echo $row_aux['name'] ?></option>
                      <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Traseul</label>
                <select class="form-control select2" style="width: 100%;" name="route">
                  <?php
//codul pentru generarea traseului
                  ?>
                </select>
              </div>
              <label>Selectati criteriile antrenamentului</label>
              <div class="form-group">
                  <div class="col-md-6">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt1" value="1"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 1)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#8599;</font> - Tempo Progresiv
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt2" value="2"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 2)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#8597;</font> - Fartlek
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt3" value="3"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 3)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#8801;</font> - Repetari
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt4" value="4"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 4)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> R </font> - Volum
                      </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt5" value="5"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 5)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#137;</font> - Panta
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt6" value="6"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 6)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "5"> &#8368;</font> - Teren Variat
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt7" value="7"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 7)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#10227;</font> - Traseu Inchis
                      </label>
                  </div>
                  <div class="checkbox">
                      <label>
                          <input type="checkbox" name="crt8" value="8"
                          <?php $caracter = $row['caracter'];
                          while ($caracter > 0) {
                            $c = $caracter % 10;
                            $caracter = (int)($caracter/10);
                            if($c == 8)
                            echo 'checked';
                          }?>
                          ><font color = "#ff0000" size = "4"> &#10132;</font> - Traseu intr-o singura directie
                      </label>
                  </div>
                  </div>
                  <div class="form-group">
                      <label>Detalii</label>
                      <textarea class="form-control" name="info" placeholder="Introduceti detalii despre antrenament." rows="3"><?php echo $row['info'] ?></textarea>
                  </div>
                  <div class="checkbox">
                          <input type="submit" class="btn btn-primary" name="submit" value="Adauga">
                          <input type="reset" class="btn btn-default">
                  </div>
              </div>
            </form>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Tutorial:</h3>
            </div>
            <div class="box-body">
              1. bla bla bla
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col (right) -->
      <?php } ?>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>
