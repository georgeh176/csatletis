<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php"><?php echo $site_info['long_title'] ?></a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
      <?php if(return_admin_test($conn, $user) == 1){ ?>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <?php if(member_alert($conn) ==1 ) {?><font color="red"><?php } ?> <i class="glyphicon glyphicon-bell fa-fw"></i> <i class="fa fa-caret-down"></i><?php if(member_alert($conn) == 1) {?> </font> <?php } ?>
            </a>
            <ul class="dropdown-menu dropdown-messages">
              <?php if(member_alert($conn)) {
                $sql = "SELECT * FROM members_wait";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while($row_wait = mysqli_fetch_assoc($result)) { ?>

                      <li>
                          <a href="#">
                              <div>
                                  <strong>Cerere inscriere</strong>
                                  <span class="pull-right text-muted">
                                      <em><?php past_time($row_wait['reg_date']); ?></em>
                                  </span>
                              </div>
                              <div>
                                <?php echo $row_wait['first_name']." ".$row_wait['last_name'] ?>
                                <span class="pull-right text-muted">
                                    <?php echo level($row_wait['level']); ?>
                                </span>
                              </div><br>
                            </a>
                            <center>
                              <button type="button" class="btn btn-success" onclick="window.location.href='include/button_action.php?option=add&member_id=<?php echo $row_wait['member_id']?>'">Accepta</button>
                              <button type="button" class="btn btn-danger" onclick="window.location.href='include/button_action.php?option=reject&member_id=<?php echo $row_wait['member_id']?>'">Respinge</button>
                              <button type="button" class="btn btn-info" onclick="window.location.href='edit_membrii.php?option=info&member_id=<?php echo $row_wait['member_id']?>'">Info</button>
                            </center>
                      </li>
                      <li class="divider"></li>

                    <?php } } } else {?>
                      <li>
                        <a href="#">
                            <div>
                                <strong>Nu sunt cereri de inscriere</strong>
                            </div>
                          </a>
                      </li>
                      <?php } ?>
            </ul>
            <!-- /.dropdown-messages -->
        </li>
      <?php } ?>

        <!-- /.dropdown -->
      <?php if(return_admin_test($conn, $user) == 1){ ?>
      <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                  <?php if(message_alert($conn) ==1 ) {?><font color="red"><?php } ?> <i class="glyphicon glyphicon-envelope fa-fw"></i> <i class="fa fa-caret-down"></i><?php if(message_alert($conn) == 1) {?> </font> <?php } ?>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
              <?php
              $sql = "SELECT * FROM site_messages where seen = '0' ORDER BY mess_date DESC";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) { ?>
                    <li>
                        <a href="messages.php?msg_id=<?php echo $row['id']?>">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> <?php echo $row['first_name']." ".$row['last_name'] ?>
                                <span class="pull-right text-muted small"><?php past_time($row['mess_date']); ?></span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
              <?php    }
            } else { ?>
              <li>
                <a href="#">
                    <div>
                        <strong>Nu sunt mesaje necitite</strong>
                    </div>
                  </a>
              </li>
              <?php } ?>

            </ul>
            <!-- /.dropdown-alerts -->
          </li>
      <?php } ?>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
              <li>
                <i class="fa fa-user fa-fw"></i> <?php echo $user['first_name'] . ' ' . $user['last_name'];?>
              </li>
              <li class="divider"></li>
                <li>
                  <a href="user_profile.php"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <!--
                <li>
                  <a href="user"><i class="fa fa-gear fa-fw"></i> Settings</a>
                </li>
                -->
                <li class="divider"></li>
                <li><a href="include/logout_script.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <!--<li class="sidebar-search">

                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                  </div> -->

                    <!-- /input-group -->
                <!--</li> -->
                <?php if(return_admin_test($conn, $user) == 1){ ?>
                <li>
                    <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li>
                    <a href="messages.php"><i class="fa fa-dashboard fa-fw"></i> Mesaje</a>
                </li>
                <li>
                    <a href="edit_orar.php"><i class="fa fa-calendar fa-fw"></i> Modificare orar</a>
                </li>
                <li>
                    <a href="edit_membrii.php"><i class="fa fa-group fa-fw"></i> Management membrii</a>
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-cog fa-fw"></i> Administrare sectiune membrii<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="edit_members_section.php?option=benefits">Modificare beneficii membrii</a>
                        </li>
                        <li>
                            <a href="edit_members_section.php?option=statute">Modificare statut membrii</a>
                        </li>
                        <li>
                            <a href="edit_members_section.php?option=pay-dues">Modificare plata cotizatie</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-cog fa-fw"></i> Administrare site<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="edit_site.php?option=edit_img">Management imagini</a>
                        </li>
                        <li>
                            <a href="edit_site.php?option=edit_section">Modificare sectiuni</a>
                        </li>
                        <li>
                            <a href="edit_site.php?option=edit_info_site">Modificare info site</a>
                        </li>
                        <li>
                            <a href="edit_site.php?option=edit_team">Adaugare membri in echipa</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="glyphicon glyphicon-cog fa-fw"></i> Administrare noutati<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="edit_news.php?option=news_info">Noutati</a>
                        </li>
                        <li>
                            <a href="edit_news.php?option=news_media">Stiri</a>
                        </li>
                        <li>
                            <a href="edit_news.php?option=events">Evenimente</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li class="divider"></li>
              <?php } ?>
                <li>
                    <a href="timetable.php"><i class="fa fa-table fa-fw"></i> Orar</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>
