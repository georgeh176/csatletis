<?php include_once "include/site_info.php" ?>

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
    <?php include_once "menu.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Sectii Sportive</h1>

      <!-- Project One -->
        <?php
        $sql = "SELECT * FROM site_section";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="row">
            <div class="col-md-7">
              <a href="section.php?sport=<?php echo $row['name']; ?>">
                <img class="card-img-top" src="<?php echo $row['image_link']; ?>" alt="">
              </a>
            </div>
            <div class="col-md-5">
              <h3><?php echo $row['name']; ?></h3>
              <p><?php echo $row['description']; ?></p>
              <a class="btn btn-primary" href="section.php?sport=<?php echo $row['name']; ?>">Detalii
                <span class="glyphicon glyphicon-chevron-right"></span>
              </a>
            </div>
            </div>
          <hr>
          <?php } } ?>
      <!-- /.row -->
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <!-- Footer -->
    <?php include_once "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
