<?php
include_once "include/site_info.php";
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
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
<?php include "menu.php"; ?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 mb-3">
        <?php
        switch ($_GET['option']) {
          case 'news_media':
            echo "Stiri";
            break;
          case 'news_info':
            echo "Noutati";
            break;
          case 'events':
            echo "Evenimente";
            break;

          default:
            # code...
            break;
        }
       ?>
      </h1>
<!--
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item active">Blog Home 2</li>
      </ol>
-->

    <?php
          switch ($_GET['option']) {
            case 'news_media':
              $post_section = 1;
              break;
            case 'news_info':
              $post_section = 2;
              break;
            case 'events':
              $post_section = 3;
              break;
          }
        $sql = "SELECT * FROM site_post where post_section = '$post_section' ORDER BY post_date DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {?>
            <!-- Blog Post -->
            <div class="card mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-6">
                    <a href="#">
                      <img class="img-fluid rounded" src="<?php echo $row['image_link'] ?>" alt="">
                    </a>
                  </div>
                  <div class="col-lg-6">
                    <a href="news-detail.php?post_id=<?php echo $row['post_id'] ?>">
                    <h2 class="card-title"><?php echo $row['post_title'] ?></h2>
                    <p class="card-text"><?php echo limit_words($row['post_content'],15);?></p>
                  </a>
                    <a href="news-detail.php?post_id=<?php echo $row['post_id'] ?>" class="btn btn-primary">Citeste mai mult... &rarr;</a>
                  </div>
                </div>
              </div>
              <div class="card-footer text-muted">
                Publicat
                <?php
                write_day($row['post_date']);
                $data = strtotime($row["post_date"]);
                $data = date('d.m.Y', $data);
                echo " ".$data;

                $sql2 = "SELECT first_name, last_name FROM members WHERE member_id = '$row[post_author]'";
                $result2 = mysqli_query($conn, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
                echo " de ".$row2['first_name']." ".$row2['last_name'];
                 ?>
              </div>
            </div>

          <?php }  } else {
          echo "0 post";
        } ?>

      <!-- Pagination -->


    </div>

  </div>
  <!-- /.container -->

  <!-- Footer -->
    <?php include_once "footer.php" ?>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
