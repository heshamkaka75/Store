
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">الرئيسية</a>
        </div>  
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">

            <li><a href="reports.php"><?php echo 'التقارير' ?></a></li>
            <li><a href="customers.php"><?php echo 'الادارات' ?></a></li>
            <li><a href="suppliers.php"><?php echo 'الموردين' ?></a></li>
            <li><a href="location.php"><?php echo 'المخازن' ?></a></li>
            <li><a href="items.php"><?php echo 'المواد' ?></a></li>
              </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo strtoupper($_SESSION['username']); ?><span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><?php echo 'Edit Profile' ?></a></li>
                <li><a href="#"><?php echo 'Setting' ?></a></li>
                <li><a href="logout.php"><?php echo 'Logout' ?></a></li>
                 </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<br />