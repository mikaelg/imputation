<?php namespace be\imputation; ?>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Imputation</a>
          
          <?php if(AuthenticationController::loginStatus()) { ?>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> Username
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!--  <li><a href="#">Profile</a></li>
              <li class="divider"></li> //-->
              <li><a href="/Logout">Sign Out</a></li>
            </ul>
          </div>
          <?php } else {  ?>
           <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="/Login">
              <i class="icon-user"></i> Sign In
            </a>
          </div>         
          <?php } // end login - logout ?>
          
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="/">Home</a></li>
              <?php if(!AuthenticationController::loginStatus()) { ?>
              <li><a href="/Login">Sign In</a></li>
              <?php }?>
              <li><a href="/Overview">Overview</a></li>
              <li><a href="/project/testproject">Testproject</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
    <?php // print $dcreg->foo ?>
