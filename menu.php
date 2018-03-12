<nav class="navbar fixed-top navbar-expand-lg fixed-top navbar-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><font face="arial-black"><?php echo $site_info['site_title'] ?></font></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=="about.php") echo "active"; ?>">
          <a class="nav-link" href="about.php">Despre noi</a>
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="services.html">Services</a>
        </li>-->
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=="sections.php") echo "active"; ?>">
          <a class="nav-link" href="sections.php">Sectii Sportive</a>
        </li>
        <li class="nav-item dropdown <?php if(basename($_SERVER['PHP_SELF'])=="news.php") echo "active"; ?>">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Noutati
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
            <a class="dropdown-item" href="news.php?option=news_media">Stiri</a>
            <a class="dropdown-item" href="news.php?option=news_info">Noutati</a>
            <a class="dropdown-item" href="news.php?option=events">Evenimente</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Membrii
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
            <a class="dropdown-item" href="user-dashboard/sign_up.php">Inscriere</a>
            <a class="dropdown-item" href="benefits.php">Beneficii membrii</a>
            <a class="dropdown-item" href="statute.php">Statut membrii</a>
            <a class="dropdown-item" href="current-members.php">Membrii actuali</a>
            <a class="dropdown-item" href="pay-dues.php">Plata cotizatie</a>
          </div>
        </li>
        <li class="nav-item <?php if(basename($_SERVER['PHP_SELF'])=="contact.php") echo "active"; ?>">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user-dashboard/login.php">Log In</a>
        </li>
        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Arii Sportive
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
            <a class="dropdown-item" href="portfolio-1-col.html">1 Column Portfolio</a>
            <a class="dropdown-item" href="portfolio-2-col.html">2 Column Portfolio</a>
            <a class="dropdown-item" href="portfolio-3-col.html">3 Column Portfolio</a>
            <a class="dropdown-item" href="portfolio-4-col.html">4 Column Portfolio</a>
            <a class="dropdown-item" href="portfolio-item.html">Single Portfolio Item</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Blog
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="blog-home-1.html">Blog Home 1</a>
            <a class="dropdown-item" href="blog-home-2.html">Blog Home 2</a>
            <a class="dropdown-item" href="blog-post.html">Blog Post</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Other Pages
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
            <a class="dropdown-item" href="full-width.html">Full Width Page</a>
            <a class="dropdown-item" href="sidebar.html">Sidebar Page</a>
            <a class="dropdown-item" href="faq.html">FAQ</a>
            <a class="dropdown-item" href="404.html">404</a>
            <a class="dropdown-item" href="pricing.html">Pricing Table</a>
          </div>
        </li>       -->
      </ul>
    </div>
  </div>
</nav>
