<?php
include_once "include/site_info.php";
if(!isset($_GET['sport']))
{
  header("location: sections.php");
}

$sql = "SELECT * FROM site_section where name='$_GET[sport]'";
$result = mysqli_query($conn, $sql);
$sport = mysqli_fetch_assoc($result);
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
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <?php include_once "menu.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3"><?php echo $sport['name'] ?>
      </h1>

      <!-- Portfolio Item Row -->
      <div class="row">

        <div class="col-md-8">
          <img class="img-fluid" src="<?php echo $sport['image_link'] ?>" alt="">
        </div>

        <div class="col-md-4">
          <h3 class="my-3">Info:</h3>
          <p><?php echo $sport['long_description'] ?></p>
        </div>

      </div>
      <!-- /.row -->

      <!-- Related Projects Row -->
      <h3 class="my-4">Imagini din activitatiile noastre</h3>

      <div class="row">
        <?php
        $sql = "SELECT * FROM site_photo where section_id = $sport[section_id] ORDER BY photo_date DESC limit 27";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {?>
              <div class="col-md-4">
                <div class="thumbnail">
                  <a href="<?php echo $row['photo_link'] ?>">
                    <img src="<?php echo $row['photo_link'] ?>" alt="<?php echo $row['title'] ?>" height="200px">
                    <div class="caption">
                      <p><center><b><?php echo $row['title'] ?></b> - <?php echo $row['description'] ?></center></p>
                    </div>
                  </a>
                </div>
              </div>
            <?php } } else {
            echo "Nu sunt imagini de afisat";
        } ?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include_once "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
