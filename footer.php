<footer class="py-5 bg-dark">
  <div class="container">
    <div class="row">
      <?php
      $sql_footer = "SELECT * FROM site_sponsors";
      $result_footer = mysqli_query($conn, $sql_footer);

      if (mysqli_num_rows($result_footer) > 0) {
        // output data of each row
        while($row_footer = mysqli_fetch_assoc($result_footer)) { ?>
          <div class="col-lg-2 col-sm-4 mb-4">
            <a href="<?php echo "http://".$row_footer['link']; ?>"><img class="img-fluid" src="<?php echo $row_footer['photo_link']; ?>" alt="<?php echo $row_footer['name']; ?>"></a>
          </div>

        <?php } } ?>
    </div>
      <p class="m-0 text-center text-white">Copyright &copy; <?php echo $site_info['site_title']." ".date("Y"); ?></p>
    </div>
    </div>
      <p class="m-0 text-center text-white">Back-End developer - George Hapenciuc</p>
    </div>
  <!-- /.container -->
</footer>
