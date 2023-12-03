<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo link_to_action('AdminController@mainArea', 'ServiceGo', $parameters = array(), $attributes = array('class'=>'navbar-brand')); ?>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">            
            <li><?php echo link_to_action('AdminController@apartamentsArea', 'Apartaments', $parameters = array(), $attributes = array()); ?></li>
             <li><?php echo link_to_action('AdminController@allIssues', 'Issues', $parameters = array(), $attributes = array()); ?></li>            
          </ul>
           <ul class="nav navbar-nav navbar-right">        
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account & settings <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><?php echo link_to_action('AdminAccountController@mainArea', 'My account', $parameters = array(), $attributes = array()); ?></li>
              <li> <?php echo link_to_action('SettingsController@mainArea', 'Settings', $parameters = array(), $attributes = array()); ?></li>              
              <li class="divider"></li>
              <li><?php echo link_to_action('AdminController@getLogout', 'Log out', $parameters = array(), $attributes = array()); ?></li>
            </ul>
        </li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>