<?php if(isset($_GET['status']) && $_GET['status'] == "success_attendance"){ ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Succes!</h4>
      Ati fost inscris cu succes la antrenamentele selectate.
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == "success_cancel_attendance"){ ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Succes!</h4>
      Ati anulat cu succes antrenamentele selectate.
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == "success_delete_data_timetable"){ ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Succes!</h4>
      Datele au fost sterse cu succes.
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == "success_edited_timetable"){ ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Succes!</h4>
      Datele au fost modificate cu succes.
  </div>
<?php } ?>

<?php if(basename($_SERVER['PHP_SELF']) == "timetable.php"){ ?>
  <div class="callout callout-info">
    <h4>Va rugam sa alegeti sectia sportiva</h4>
    <?php
    $sql = "SELECT * FROM `member-section` WHERE member_id = '$user[member_id]'";
    $result = mysqli_query($conn, $sql);

      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sql2 = "SELECT * FROM `site_section` WHERE section_id = '$row[section_id]'";
        $result2 = mysqli_query($conn, $sql2);

          // output data of each row
          while($row2 = mysqli_fetch_assoc($result2)) { ?>
            <button class="btn btn-primary" onclick="window.location='timetable.php?option=timetable&show=by_level&section_id=<?php echo $row['section_id'] ?>';"><?php echo $row2['name'] ?></button>
          <?php }
      }
    ?>
  </div>
<?php } ?>

<?php if(basename($_SERVER['PHP_SELF']) == "attendance.php"){ ?>
  <div class="callout callout-info">
    <h4>Va rugam sa alegeti sectia sportiva</h4>
    <?php
    $sql = "SELECT * FROM `db_trainers` WHERE member_id = '$user[member_id]'";
    $result = mysqli_query($conn, $sql);

      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sql2 = "SELECT * FROM `site_section` WHERE section_id = '$row[section_id]'";
        $result2 = mysqli_query($conn, $sql2);

          // output data of each row
          while($row2 = mysqli_fetch_assoc($result2)) { ?>
            <button class="btn btn-primary" onclick="window.location='attendance.php?option=timetable&show=all&section_id=<?php echo $row['section_id'] ?>';"><?php echo $row2['name'] ?></button>
          <?php }
      }
    ?>
  </div>
<?php } ?>

<?php if(isset($_GET['status']) && $_GET['status'] == "success_add_data_timetable"){ ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-check"></i> Succes!</h4>
      Antrenamentul compus a fost introdus cu succes.
  </div>
<?php } ?>
