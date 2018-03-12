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
        <?php include_once 'menu.php'; ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Creare, modificare, stergere orar</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                  <?php if(!isset($_GET['option'])){ ?>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-outline btn-primary btn-lg btn-block" onclick="window.location='edit_orar.php?option=1';">Creare orar</button>
                        <button type="button" class="btn btn-outline btn-warning btn-lg btn-block"onclick="window.location='edit_orar.php?option=2';">Modificare orar</button>
                        <button type="button" class="btn btn-outline btn-warning btn-lg btn-block"onclick="window.location='edit_orar.php?option=3';">Repetare orar</button>
                        <button type="button" class="btn btn-outline btn-danger btn-lg btn-block"onclick="window.location='edit_orar.php?option=4';">Stergere orar</button>
                    </div>
                  <?php } ?>
                  <?php if(isset($_GET['status']) && $_GET['status'] == 0){ ?>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                      <div class="alert alert-warning alert-dismissable">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          Antrenamentul ales este deja in baza de date.<br>
                          Alegeti <b>"Continua"</b> pentru a continua adaugarea lui.
                          Aceasta optiune nu va sterge antrenamentul deja existent,
                          ci va crea o dublura.<br>
                          Alegeti <b>"Anuleaza"</b> pentru a anula operatiunea.
                          Aceasta optiune va intoarce la editarea antrenamentului.
                      </div>
                      <?php $redirect = 'include/form_action.php?option=1&status=2&data='.$_GET['data'].'&ora='.$_GET['ora'].'&grupa='.$_GET['grupa'].'&caracter='.$_GET['caracter'].'&info_a='.$_GET['info_a']; ?>
                        <button type="button" class="btn btn-outline btn-warning btn-lg btn-block" onclick="window.location='<?php echo $redirect?>';">Continua</button>
                        <button type="button" class="btn btn-outline btn-danger btn-lg btn-block"onclick="window.location='edit_orar.php?option=1';">Anuleaza</button>
                    </div>
                  <?php } ?>
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <?php if(isset($_GET['option']) && $_GET['option'] == 1 && (!isset($_GET['status'])) || (isset($_GET['status']) && $_GET['status']==2) ){ ?>
                      <form method="post" action="include/form_action.php">
                        <div class="form-group">
                            <label>Alegeti data antrenamentul</label>
                            <input class="form-control" type="date" name="data_antr" placeholder="Data antrenamentul">
                        </div>
                        <div class="form-group">
                            <label>Alegeti ora antrenamentul</label>
                            <input class="form-control" type="time" name="ora" placeholder="Ora antrenamentului">
                        </div>
                        <div class="form-group">
                            <label>Alegeti categoria de membrii</label>
                            <select class="form-control" name="grupa">
                                <option value="1">Totii membrii</option>
                                <option value="2">Grupa incepatori</option>
                                <option value="3">Grupa avansati</option>
                                <option value="4">Grupa master</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selectati criteriile antrenamentului</label>
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
                                <textarea class="form-control" name="info_a" placeholder="Introduceti detalii despre antrenament." rows="3"></textarea>
                            </div>
                        </div>
                        <input type="submit" name="sub_add" class="btn btn-default" value="Adauga"><br><br>
                      </form>
                    <?php } ?>

                    <?php if(isset($_GET['option']) && $_GET['option'] == 2 && (isset($_GET['antrenament']))){ ?>
                      <form method="post" action="include/form_action.php?antrenament=<?php echo $_GET['antrenament'] ?>">
                        <div class="form-group">
                            <label>Introduceti noile date pentru antrenamentul selectat.</label>
                        </div>
                        <div class="form-group">
                            <label>Alegeti data antrenamentul</label>
                            <input class="form-control" type="date" name="data_antr" placeholder="Data antrenamentul">
                        </div>
                        <div class="form-group">
                            <label>Alegeti ora antrenamentul</label>
                            <input class="form-control" type="time" name="ora" placeholder="Ora antrenamentului">
                        </div>
                        <div class="form-group">
                            <label>Alegeti categoria de membrii</label>
                            <select class="form-control" name="grupa">
                                <option value="1">Totii membrii</option>
                                <option value="2">Grupa incepatori</option>
                                <option value="3">Grupa avansati</option>
                                <option value="4">Grupa master</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Selectati criteriile antrenamentului</label>
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
                                <textarea class="form-control" name="info_a" placeholder="Introduceti detalii despre antrenament." rows="3"></textarea>
                            </div>
                        </div>
                        <input type="submit" name="sub_edit" class="btn btn-default" value="Adauga"><br><br>
                      </form>
                    <?php } ?>

                  </div>
                    <!-- Sectiunea pentru editarea antrenamentelor din orar -->

                    <?php if(isset($_GET['option']) && $_GET['option'] == 2){ ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <?php if(isset($_GET['status']) && $_GET['status'] == 1){ ?>
                          <div class="alert alert-success alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              Antrenamentul selectat a fost cu modificat cu success.
                          </div>
                        <?php } ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Alegeti antrenamentul pe care doriti sa il modificati
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
                                                   <tr bgcolor="<?php color_cell($row['level']) ?>" onclick="window.location='edit_orar.php?option=2&antrenament=<?php echo $antrenament ?>';" height="50">
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
                                        <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=4';">Stergere antrenament</button>                                     <!-- /.table-responsive -->

                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                          <!-- /.col-lg-12 -->
                      </div>
                    <?php } ?>
                    <!-- sectiune pentru repetarea antrenamentelor in orar -->

                    <?php if(isset($_GET['option']) && $_GET['option'] == 3){ ?>
                      <div class="row">
                        <div class="col-lg-12">
                          <?php if(isset($_GET['status']) && $_GET['status'] == 4){ ?>
                          <div class="alert alert-success alert-dismissable">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              Antrenamentele selectate se vor repeta in saptamanile alese
                          </div>
                        <?php } ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Alegeti antrenamentele pe care doriti sa le repetati
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
                                                <th>Selecteaza</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <form method="get" action="include/form_action.php?option=3">
                                                  <?php
                                                      $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE()  ORDER BY p_date ASC, p_hour ASC ";
                                                      $result = mysqli_query($conn, $sql);
                                                      $i=0;

                                                  if (mysqli_num_rows($result) > 0) {
                                                    // output data of each row

                                                    while($row = mysqli_fetch_assoc($result)) {
                                                      $antrenament=$row['id'];
                                                   ?>
                                                   <tr bgcolor="<?php color_cell($row['level']) ?>" height="50">
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
                                                    <th>
                                                      <input type="checkbox" name="<?php $i++; echo "rep".$i; ?>" value="<?php echo $row['id'] ?>">
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
                                        <div class="form-group">
                                        <div class="col-md-4"><label>Alegeti de cate ori sa se repete antrenamentele selectate</label></div>
                                        <div class="col-md-4"><input type="number" class="form-control" name="repeat" required></div>
                                        <input type="hidden" name="i" value="<?php echo $i; ?>">
                                        <input type="submit" class="btn btn-primary" name="sub_rep" value="Repeta">
                                      </div>
                                      </form><br>
                                      <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=1';">Creare antrenament</button>
                                      <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=2';">Modificare antrenament</button>
                                      <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=3';">Repetare antrenament</button>
                                      <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=4';">Stergere antrenament</button>                                     <!-- /.table-responsive -->

                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                          <!-- /.col-lg-12 -->
                      </div>
                    <?php } ?>

              <!-- sectiune pentru antrenamentele dorite a fi sterse-->

              <?php if(isset($_GET['option']) && $_GET['option'] == 4){ ?>
                <div class="row">
                  <div class="col-lg-12">
                    <?php if(isset($_GET['status']) && $_GET['status'] == 5){ ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        Antrenamentele selectate au fost sterse
                    </div>
                  <?php } ?>
                      <div class="panel panel-default">
                          <div class="panel-heading">
                              Alegeti antrenamentele pe care doriti sa le stergeti
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
                                          <th>Selecteaza</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <form method="get" action="include/form_action.php?option=3">
                                            <?php
                                                $sql = "SELECT * FROM db_timetable WHERE p_date >= CURDATE()  ORDER BY p_date ASC, p_hour ASC ";
                                                $result = mysqli_query($conn, $sql);
                                                $i=0;

                                            if (mysqli_num_rows($result) > 0) {
                                              // output data of each row

                                              while($row = mysqli_fetch_assoc($result)) {
                                                $antrenament=$row['id'];
                                             ?>
                                             <tr bgcolor="<?php color_cell($row['level']) ?>" height="50">
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
                                              <th>
                                                <input type="checkbox" name="<?php $i++; echo "rep".$i; ?>" value="<?php echo $row['id'] ?>">
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
                                  <div class="form-group">
                                  <input type="hidden" name="i" value="<?php echo $i; ?>">
                                  <input type="submit" class="btn btn-primary" name="sub_del" value="Sterge">
                                </div>
                                </form><br>
                                  <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=1';">Creare antrenament</button>
                                  <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=2';">Modificare antrenament</button>
                                  <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=3';">Repetare antrenament</button>
                                  <button type="button" class="btn btn-default" onclick="window.location='edit_orar.php?option=4';">Stergere antrenament</button>                          </div>
                              <!-- /.table-responsive -->

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

</body>

</html>
