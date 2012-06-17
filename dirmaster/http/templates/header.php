<?php namespace be\imputation; ?>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo $dcreg->corexml->location->title; ?></a>
          
          <?php if(AuthenticationController::loginStatus()) { ?>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
              <i class="icon-user"></i> <?php echo AuthenticationController::getFullUserName(); ?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <!--  <li><a href="#">Profile</a></li>
              <li class="divider"></li> //-->
              <li><a href="/Logout"><?php echo $dcreg->corexml->location->signout; ?></a></li>
            </ul>
          </div>
          <?php } else {  ?>
           <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown" href="/Login">
              <i class="icon-user"></i><?php echo $dcreg->corexml->location->signin; ?>
            </a>
          </div>         
          <?php } // end login - logout ?>
          
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><?php echo HTMLHelper::mig_createLink(array('href'=>'/', 
					'text'=>$dcreg->corexml->location->home,
					)) ?></li>
              <?php if(!AuthenticationController::loginStatus()) { ?>
              <li><?php echo HTMLHelper::mig_createLink(array('href'=>'/Login', 
					'text'=>$dcreg->corexml->location->signin,
					)) ?></li>
              <?php }?>
              <li><?php echo HTMLHelper::mig_createLink(array('href'=>'/overview/', 
					'text'=>$dcreg->corexml->location->overview,
					)) ?></li>
              <li><?php echo HTMLHelper::mig_createLink(array('href'=>'/project/testproject', 
					'text'=>$dcreg->corexml->location->testproject,
					)) ?></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>