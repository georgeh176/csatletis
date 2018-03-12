<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $user_data['profile_img'] ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $user_data['first_name']." ".$user_data['last_name'] ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online(in lucru)</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...(in lucru)">
        <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Navigatia principala</li>
      <li class="<?php if(basename($_SERVER['PHP_SELF']) == "index.php") echo "active"?>">
        <a href="index.php">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="mailbox.php?option=received">
          <i class="fa fa-envelope"></i> <span>Casuta Postala</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-blue">
              <?php
              $nr_msg = 0;
              $sql = "SELECT id FROM db_mail WHERE (mail_to = '$_SESSION[user_id]' and seen = '0' and delete_mail = '0')";
              $result = mysqli_query($conn, $sql);
              $nr_msg += mysqli_num_rows($result);
              echo mysqli_num_rows($result);
              ?>
            </small>
            <small class="label pull-right bg-green">
              <?php
              $sql = "SELECT id FROM site_messages WHERE (seen = '0' and delete_mail = '0')";
              $result = mysqli_query($conn, $sql);
              $nr_msg += mysqli_num_rows($result);
              echo mysqli_num_rows($result);
              ?>
            </small>
            <small class="label pull-right bg-yellow">
              <?php
              echo $nr_msg;
              ?>
            </small>
          </span>
        </a>
      </li>
      <li class="<?php if(basename($_SERVER['PHP_SELF']) == "members.php") echo "active"?>">
        <a href="members.php">
          <i class="fa fa-dashboard"></i> <span>Membrii</span>
        </a>
      </li>
      <li class="treeview <?php if(basename($_SERVER['PHP_SELF']) == "timetable.php" || basename($_SERVER['PHP_SELF']) == "attendance.php") echo "active"?>">
        <a href="#">
          <i class="fa fa-table"></i> <span> Orar</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "timetable.php") echo "active"?>"><a href="timetable.php?option=timetable&show=by_level"><i class="fa fa-circle-o"></i> Vizualizare</a></li>
          <?php if(return_trainer_test($conn, $user['member_id']) || return_admin_test($conn, $user)){ ?>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "attendance.php") echo "active"?>"><a href="attendance.php"><i class="fa fa-circle-o"></i> Prezenta (in lucru)</a></li>
        <?php } ?>
        </ul>
      </li>
      <li class="treeview <?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php") echo "active"?>">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Administrare site</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "edit_member_benefits") echo "active"?>"><a href="site_admin.php?option=edit_member_benefits"><i class="fa fa-circle-o"></i> Beneficii membrii</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "member_statute") echo "active"?>"><a href="site_admin.php?option=member_statute"><i class="fa fa-circle-o"></i> Statut membrii</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "pay_dues") echo "active"?>"><a href="site_admin.php?option=pay_dues"><i class="fa fa-circle-o"></i> Plata cotizatiei</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "image_menagement") echo "active"?>"><a href="site_admin.php?option=image_menagement"><i class="fa fa-circle-o"></i> Management imagini</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "section_management") echo "active"?>"><a href="site_admin.php?option=section_management" class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "section_management") echo "active"?>"><i class="fa fa-circle-o"></i> Modificare sectiuni</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "info_site_management") echo "active"?>"><a href="site_admin.php?option=info_site_management"><i class="fa fa-circle-o"></i> Modificare info site</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "team_management") echo "active"?>"><a href="site_admin.php?option=team_management"><i class="fa fa-circle-o"></i> Modificare echipa</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "news_management") echo "active"?>"><a href="site_admin.php?option=news_management"><i class="fa fa-circle-o"></i> Administrare Noutati</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "event_management") echo "active"?>"><a href="site_admin.php?option=event_management"><i class="fa fa-circle-o"></i> Administrare Evenimente</a></li>
          <li class="<?php if(basename($_SERVER['PHP_SELF']) == "site_admin.php" && $_GET['option'] == "news2_management") echo "active"?>"><a href="site_admin.php?option=news2_management"><i class="fa fa-circle-o"></i> Administrare Stiri</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
