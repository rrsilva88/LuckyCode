<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <div class="logo"> 
        <img src="images/logo.png" alt="Realm Admin Template">
      </div>
       <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
       <a class="btn btn-navbar slide_menu_left visible-tablet">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="top-menu visible-desktop">
        <!--ul class="pull-left">
          <li id='li-messages'>
          
          <a id="messages" data-notification="2" href="#"><i class="icon-envelope"></i> Messages</a>
          </li>
          <li id='li-notifications'><a id="notifications" data-notification="3" href="#"><i class="icon-globe"></i> Notifications</a></li>
        </ul-->
        <ul class="pull-right">  
          <li><a onclick='logout()'><i class="icon-off"></i> Sair</a></li>
        </ul>
        
      </div>

      <div class="top-menu visible-phone visible-tablet">
        <ul class="pull-right">  
          <li><a onclick='logout()'><i class="icon-off"></i></a></li>
        </ul>
      </div>

    </div>
  </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>