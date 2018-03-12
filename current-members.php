<?php
include_once 'include/site_info.php';
include_once "user-dashboard/include/function.php";
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

      <h1 class="mt-4 mb-3">Membrii actuali</h1>
      <table class="table">
<thead class="thead-dark">
  <tr>
    <th scope="col">Nume</th>
    <th scope="col">Prenume</th>
    <th scope="col">Data inregistrarii</th>
    <th scope="col">Grupa</th>
  </tr>
</thead>
<tbody>
          <?php
            $sql = "SELECT * FROM members where level != '99'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
               // output data of each row
               while($row = mysqli_fetch_assoc($result)) { ?>
                 <tr>
                   <td><?php echo $row['last_name'] ?></td>
                   <td><?php echo $row['first_name'] ?></td>
                   <td><?php echo date('d.m.Y', strtotime($row['reg_date'])) ?></td>
                   <td><?php level($row['level']) ?></td>
                 </tr>
              <?php }
            } else {
               echo "0 results";
            }
        ?>
</tbody>
</table>
    </div>
    <!-- /.container -->

    <!-- Footer -->
    <?php include_once "footer.php" ?>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
