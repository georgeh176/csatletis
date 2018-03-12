<!-- Logo -->
<a href="index.php" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>A</b>IS</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Atlet</b>IS</span>
</a>
<?php $user_data = user_data($conn)?>
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success"><?php echo count_message_alert($conn); ?></span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">
            <?php
              if(count_message_alert($conn) == 0)
                echo "Nu aveti mesaje noi";
                else if(count_message_alert($conn) == 1)
                      echo "Aveti un mesaj nou";
                        else
                          echo "Aveti ".count_message_alert($conn)." mesaje noi";
            ?>
          </li>
          <?php if(count_message_alert($conn) >= 1){ ?>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <?php
              $sql = "SELECT * FROM site_messages WHERE (seen = '0' and delete_mail = '0')";
              $result = mysqli_query($conn, $sql);
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) { ?>
                  <li><!-- start message -->
                    <a href="read-mail.php?option=contact_mail&mail_id=<?php echo $row['id'] ?>">
                      <div class="pull-left">
                        <img src="https://dummyimage.com/160/000000/fff&text=Contact" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        <?php echo $row['first_name']." ".$row['last_name'] ?>
                        <small><i class="fa fa-clock-o"></i> <?php echo return_past_time($row['mess_date']) ?></small>
                      </h4>
                      <p><?php echo limit_words($row['message'], 5); ?></p>
                    </a>
                  </li>
                  <!-- end message -->
                <?php } ?>
                <?php
                $sql = "SELECT * FROM db_mail WHERE (mail_to = '$_SESSION[user_id]' and seen = '0' and delete_mail = '0')";
                $result = mysqli_query($conn, $sql);
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT * FROM members where member_id = '$row[mail_from]'";
                    $result2 = mysqli_query($conn, $sql2);
                    $row2 = mysqli_fetch_assoc($result2);
                    ?>

                    <li><!-- start message -->
                      <a href="read-mail.php?option=local_mail&mail_id=<?php echo $row['id'] ?>">
                        <div class="pull-left">
                          <img src="<?php echo $row2['profile_img'] ?>" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                          <?php echo $row2['first_name']." ".$row2['last_name'] ?>
                          <small><i class="fa fa-clock-o"></i> <?php echo return_past_time($row['mess_date']) ?></small>
                        </h4>
                        <p><?php echo limit_words($row['message'], 5); ?></p>
                      </a>
                    </li>
                    <!-- end message -->
                  <?php } ?>
            </ul>
          </li>
        <?php } ?>
          <li class="footer"><a href="mailbox.php?option=received">Vezi toate mesajele</a></li>
        </ul>
      </li>
      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">
            <?php
            $nr_notification = 0;
            $sql = "SELECT member_id FROM members_wait";
            $result = mysqli_query($conn, $sql);
            $nr_notification += mysqli_num_rows($result);

            echo $nr_notification;
            ?>
          </span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">
            <?php
              switch ($nr_notification) {
                case '0':
                  echo "Nu aveti notificari";
                  break;
                case '1':
                  echo "Aveti o notificare";
                  break;

                default:
                  echo "Aveti ".$nr_notification." notificare";
                  break;
              }
             ?>
          </li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                  page and may cause design problems
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-users text-red"></i> 5 new members joined
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-user text-red"></i> You changed your username
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $user_data['profile_img'] ?>" class="user-image" alt="User Image">
          <span class="hidden-xs"><?php echo $user_data['first_name']." ".$user_data['last_name'] ?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="<?php echo $user_data['profile_img'] ?>" class="img-circle" alt="User Image">

            <p>
              <?php echo $user_data['first_name']." ".$user_data['last_name']." - ";
              level($user_data['level']);
              ?>
              <small>Membru din <?php echo date("m Y", strtotime($user_data['reg_date']))?></small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <div class="row">
              <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
              </div>
              <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
              </div>
            </div>
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="profile.php?user_id=<?php echo $user['member_id'] ?>" class="btn btn-default btn-flat">Profil</a>
            </div>
            <div class="pull-right">
              <a href="core/logout.php" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </div>
</nav>
