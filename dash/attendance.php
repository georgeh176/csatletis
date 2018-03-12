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
  <title><?php echo $info_site['site_title'] . " - Dashboard " ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
        Orarul antrenamentelor
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <?php include_once "core/notifications.php"; ?>
          <?php if(isset($_GET['practice_id'])){ ?>
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Lista completa a participantilor pentru antrnamentul selectat </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table class="table table-bordered">
                  <tr>
                    <th>Status</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Telefon</th>
                    <th>Profil</th>
                  </tr>
                  <?php
                    $sql = "SELECT * FROM db_present WHERE id_timetable = '$_GET[practice_id]'";
                    $result = mysqli_query($conn, $sql);
                        // output data of each row
                        while($row = mysqli_fetch_assoc($result)) {
                          $sql2 = "SELECT * FROM members WHERE member_id = '$row[id_member]'";
                          $result2 = mysqli_query($conn, $sql2);
                          $row2 = mysqli_fetch_assoc($result2); ?>
                                  <tr>
                                    <td>
                                      <?php
                                        if($row['cancel'] == 0)
                                        echo '<i class="fa fa-circle-o text-green"></i> <span>Participa</span>';
                                        if($row['cancel'] == 1)
                                        echo '<i class="fa fa-circle-o text-red"></i> <span>Anulat</span>';
                                      ?>
                                    </td>
                                    <td><?php echo $row2['first_name'] ?></td>
                                    <td><?php echo $row2['last_name'] ?></td>
                                    <td><?php echo $row2['phone'] ?></td>
                                    <td><button class="btn btn-primary" onclick="window.location='profile.php?user_id=<?php echo $row2['member_id'] ?>';">Arata profilul</button></td>
                                  </tr>
                  <?php } ?>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer clearfix">
              </div>
            </div>
            <!-- /.box -->
          <?php } ?>
          <?php if(isset($_GET['section_id']) && !isset($_GET['practice_id'])){ ?>
          <div class="box">
            <div class="box-header">
              <?php
                if(isset($_GET['section_id']))
                  $set_section="&section_id=".$_GET['section_id'];
                  else
                  $set_section="";
               ?>
              <h3 class="box-title">Alegeti un antrenament din lista de mai jos:</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <table class="table table-bordered" >
                <tr>
                  <th align="center"></th>
                  <th align="center">Data</th>
                  <th align="center">Ora</th>
                  <th align="center">Grupa</th>
                  <th align="center">Caracterul</th>
                  <th align="center">Detalii</th>
                </tr>
                <tbody>
                  <?php

                  $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE() and section_id ='$_GET[section_id]' and trainer_id='$user[member_id]'  ORDER BY p_date ASC, p_hour ASC ";

                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                   ?>
                <tr height="50">
                  <td width="auto" align="center">
                        <button class="btn btn-primary" onclick="window.location='attendance.php?option=attendance&practice_id=<?php echo $row['id'] ?>';">Vizualizeaza</button>
                  </td>
                  <td>
                    <?php
                    echo write_day($row["p_date"]);
                    $data = strtotime($row["p_date"]);
                    $data = date('d.m.Y', $data);
                    echo " ".$data;
                    ?>
                  </td>
                  <td><?php echo $row['p_hour'] ?></td>
                  <td><?php echo write_level($conn,$row['level']) ?></td>
                  <td>
                    <font color = "red" size = "5">
                    <?php
                    echo_caracter($row['caracter']);
                    ?>
                    </font>
                  </td>
                  <td><?php echo $row['info'] ?></td>
                </tr>
              <?php } } ?>
                </tbody>
                <tfoot>
                <tr>
                  <td></td>
                    <td>
                      <p><font color = "#ff0000" size = "4"> &#8599;</font> - Tempo Progresiv
                      <p><font color = "#ff0000" size = "4"> &#8597;</font> - Fartlek
                    </td>
                    <td>
                      <p><font color = "#ff0000" size = "4"> &#8801;</font> - Repetari
                      <p><font color = "#ff0000" size = "4"> R </font> - Volum
                    </td>
                    <td>
                      <p><font color = "#ff0000" size = "4"> &#137;</font> - Panta
                      <p><font color = "#ff0000" size = "5"> &#8368;</font> - Teren Variat
                    </td>
                    <td>
                      <p><font color = "#ff0000" size = "4"> &#10227;</font> - Traseu Inchis
                      <p><font color = "#ff0000" size = "4"> &#10132;</font> - Traseu intr-o singura directie
                    </td>
                    <td>

                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        <?php } ?>
        </div>
        <!-- /.col -->
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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
