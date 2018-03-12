<?php
include_once "include/site_info.php";
 ?>


<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $site_info['long_description'] ?>">
    <meta name="author" content="George Hapenciuc">

    <title><?php echo $site_info['site_title']." - ".$site_info['site_description'] ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="JavaScript">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
      <?php include_once "menu.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <?php if(isset($_GET['msj']) && $_GET['msj']=='send'){ ?>
      <div class="alert alert-success" role="alert">Mesajul a fost trimis cu succes</div>
    <?php } ?>
      <h1 class="mt-4 mb-3">Contact</h1>

      <!-- Content Row -->
      <div class="row">
        <!-- Map Column -->
        <div class="col-lg-8 mb-4">
          <!-- Embedded Google Map -->
          <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d21729.58836570592!2d27.76803010297552!3d47.0951782658423!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40ca565f8f2043a7%3A0x1609c7d6686ced8a!2sOsoi+707110!5e0!3m2!1sen!2sro!4v1517666359861"></iframe>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4 mb-4">
          <h3>Detalii de contact</h3>
          <p><?php echo $site_info['site_adress'] ?></p>
          <p>
            <abbr title="Phone">Telefon</abbr>: <?php echo $site_info['site_phone'] ?>
          </p>
          <p>
            <abbr title="Email">Email</abbr>:
            <a href="<?php echo $site_info['site_email'] ?>"><?php echo $site_info['site_email'] ?>
            </a>
          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Contact Form -->
      <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
      <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Trimite-ne un mesaj</h3>
          <form method="post" action="include/contact_action.php">
            <div class="control-group form-group">
              <div class="controls">
                <label>Nume</label>
                <input type="name" name="first_name" class="form-control" id="first_name" required data-validation-required-message="Numele de familie este obigatoriu">
                <p class="help-block"></p>
              </div>
              </div>
              <div class="control-group form-group">
              <div class="controls">
                <label>Prenume</label>
                <input type="name" name="last_name" class="form-control" id="last_name" required data-validation-required-message="Prenumele este obligatoriu">
                <p class="help-block"></p>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Numar de telefon</label>
                <input type="tel" name="phone" class="form-control" id="phone">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email</label>
                <input type="email" name="email" class="form-control" id="email" required data-validation-required-message="Adresa de email este obligatorie">
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Mesajul</label>
                <textarea rows="10" name="message" cols="100" class="form-control" id="message" required data-validation-required-message="Va rugam introduceti un mesaj" maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <input name="submit" type="submit" class="btn btn-primary" value="Trimite mesajul">
          </form>
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include_once "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Contact form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

  </body>

</html>
