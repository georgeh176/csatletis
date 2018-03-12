<?php
include_once '../include/site_info.php';
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

    <div class="container">
        <div class="row"><br><br>
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Completati formularul de mai jos pentru inregistrare</h3>
                    </div>
                    <div class="panel-body">
                      <form method="post" action="include/form_action.php">
                            <fieldset>
                              <div class="form-group">
                                  <label>Numele de familie</label>
                                  <input type="name" name="last_name" required class="form-control" placeholder="Ex: Popescu">
                              </div>
                              <div class="form-group">
                                  <label>Prenumele</label>
                                  <input type="name" name="first_name" required class="form-control" placeholder="Ex: Vasile">
                              </div>
                              <div class="form-group">
                                  <label>Numarul de telefon</label>
                                  <input type="tel" name="phone" required class="form-control" placeholder="Ex: 0781234123 sau 0232123456">
                              </div>
                              <div class="form-group">
                                  <label>Adresa de email</label>
                                  <input type="email" name="email" required class="form-control" placeholder="Ex: popescu.vasile@yahoo.com">
                              </div>
                              <div class="form-group">
                                  <label>Parola</label>
                                  <input type="password" name="password" required class="form-control">
                              </div>
                              <div class="form-group">
                                  <label>Data nasterii</label>
                                  <input type="date" name="birth_date" required class="form-control" value="1980-01-01">
                              </div>
                              <div class="form-group">
                                  <label>Alegeti grupa</label>
                                  <select name="level" class="form-control" required>
                                      <option value="1">Grupa Incepatori</option>
                                      <option value="2">Grupa Avansati</option>
                                  </select>
                              </div>
                              <div class="form-group">
                                  <label>Adresa de domiciliu</label>
                                  <input type="name" name="address" required class="form-control">
                              </div>
                              <div class="form-group">
                                  <input type="submit" name="sign_up" required class="btn btn-primary btn-lg btn-block" value="Trimite">
                              </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
