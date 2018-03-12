<?php
include_once 'include/site_info.php';
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

    <!-- Custom styles for this template -->
    <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="JavaScript">
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <?php include_once 'menu.php'; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Plata cotizatiei</h1>
      <?php
      $sql = "SELECT * FROM site_member_section where section='pay-dues'";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
       ?>

      <p><?php echo $row['content'] ?></p>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include_once "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
