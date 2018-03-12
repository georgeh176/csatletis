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
  <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" rel="JavaScript">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

</head>

  <body>

    <!-- Navigation -->
      <?php include_once 'menu.php'; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">Despre noi</h1>

      <!-- Intro Content -->
      <div class="row">
        <div class="col-lg-6">
          <img class="img-fluid rounded mb-4" src="<?php echo $site_info['about_logo'] ?>" alt="">
        </div>
        <div class="col-lg-6">
          <h2 class="font-text"><?php echo $site_info['long_title'].' - '.$site_info['site_description']; ?></h2>
          <p><?php echo $site_info['long_description'] ?></p>
        </div>
      </div>
      <!-- /.row -->

      <!-- Team Members -->
      <h2>Membrii fondatori</h2>

      <div class="row">
        <?php
        $sql = "SELECT * FROM site_team";
        $result = mysqli_query($conn, $sql);
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
              $sql2 = "SELECT first_name, last_name FROM members where member_id='$row[member_id]'";
              $result2 = mysqli_query($conn, $sql2);
                  // output data of each row
                  while($row2 = mysqli_fetch_assoc($result2)) { ?>

                    <div class="col-lg-4 mb-4">
                      <div class="card h-100 text-center">
                        <img class="card-img-top" src="<?php echo $row['photo_link']; ?>" alt="">
                        <div class="card-body">
                          <h4 class="card-title"><?php echo $row2['first_name'].' '.$row2['last_name']; ?></h4>
                          <h6 class="card-subtitle mb-2 text-muted"><?php echo $row['role']; ?></h6>
                          <p class="card-text"><?php echo $row['description']; ?></p>
                        </div>
                      </div>
                    </div>

                <?php  } } ?>
      </div>
      <!-- /.row -->

      <!-- Our Customers -->
      <h2>Parteneri</h2>
      <div class="row">
        <?php
        $sql = "SELECT * FROM site_sponsors";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col-lg-2 col-sm-4 mb-4">
              <a href="<?php echo "http://".$row['link']; ?>"><img class="img-fluid" src="<?php echo $row['photo_link']; ?>" alt="<?php echo $row['name']; ?>"></a>
            </div>

          <?php } } ?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?php echo $site_info['site_title']." ".date("Y"); ?></p>
      </div>
    </div>
      <p class="m-0 text-center text-white">Back-End developer - George Hapenciuc</p>
    </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
