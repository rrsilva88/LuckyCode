<div class="header navbar navbar-inverse ">
  <!-- BEGIN TOP NAVIGATION BAR -->
  <div class="navbar-inner">
    <div class="header-seperation">
      <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
        <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
          <div class="iconset top-menu-toggle-white"></div>
          </a> </li>
      </ul>
      <!-- BEGIN LOGO -->
      <a href="{$dwoo.session.sys.base_url}"><img src="assets/img/logo.png" class="logo" alt=""  data-src="assets/img/logo.png" data-src-retina="assets/img/logo2x.png" width="106" height="21"/></a>
      <!-- END LOGO -->
      <ul class="nav pull-right notifcation-center">
        <li class="dropdown" id="header_task_bar"> <a href="{$dwoo.session.sys.base_url}" class="dropdown-toggle active" data-toggle="">
          <div class="iconset top-home"></div>
          </a> </li>
      </ul>
    </div>
    <!-- END RESPONSIVE MENU TOGGLER -->
    <div class="header-quick-nav" >
      <!-- BEGIN TOP NAVIGATION MENU -->
      <div class="pull-left">
        <ul class="nav quick-section">
          <li class="quicklinks"> <a href="#" class="" id="layout-condensed-toggle" >
            <div class="iconset top-menu-toggle-dark"></div>
            </a> </li>
        </ul>
        <ul class="nav quick-section">
          
          
          
          <li class="m-r-10 input-prepend inside search-form no-boarder"> 
            <span class="add-on"> <span class="iconset"></span></span>
            
          </li>
        </ul>
      </div>
      <!-- END TOP NAVIGATION MENU -->
      <!-- BEGIN CHAT TOGGLER -->
      <div class="pull-right">
        <div class="chat-toggler"> <a href="#" class="dropdown-toggle" id="my-task-list" data-placement="bottom"  data-content='' data-toggle="dropdown" data-original-title="Notificações">
          <div class="user-details">
            <div class="username"> {if $dwoo.session.notificacoes.news}<span class="badge badge-important">{$dwoo.session.notificacoes.news}</span>{/if}{$dwoo.session.loginADM.primeiro_nome} <span class="bold">{$dwoo.session.loginADM.sobrenome}</span> </div>
          </div>
          <div class="iconset top-down-arrow"></div>
          </a>
          <div id="notification-list" style="display:none">
            <div style="width:300px">
              <div class="notification-messages info">
                <div class="user-profile"> <img src="assets/img/profiles/d.jpg"  alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35"> </div>
                <div class="message-wrapper">
                  <div class="heading"> Lisa - Comentou sua foto </div>
                  <div class="description"> Show de bola</div>
                  <div class="date pull-left">Agora </div>
                </div>
                <div class="clearfix"></div>
              </div>
              <div class="notification-messages danger">
                       <div class="user-profile"> <img src="assets/img/profiles/d.jpg"  alt="" data-src="assets/img/profiles/d.jpg" data-src-retina="assets/img/profiles/d2x.jpg" width="35" height="35"> </div>
                <div class="message-wrapper">
                  <div class="heading"> Atividade 1 </div>
                  <div class="description"> Concluída com sucesso! </div>
                  <div class="date pull-left"> 2 min</div>
                </div>
                <div class="clearfix"></div>
              </div>
             
            </div>
          </div>
          <div class="profile-pic"> <img src="assets/img/profiles/avatar_small.jpg"  alt="" data-src="assets/img/profiles/avatar_small.jpg" data-src-retina="assets/img/profiles/avatar_small2x.jpg" width="35" height="35" /> </div>
        </div>
        <ul class="nav quick-section ">
          <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="#" id="user-options">
            <div class="iconset top-settings-dark "></div>
            </a>
            <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
              <li><a href="user-profile.html">Minha Conta</a> </li>
              <li><a href="email.html"> Notificações{if $dwoo.session.notificacoes.news}<span class="badge badge-important animated bounceIn">{$dwoo.session.notificacoes.news}</span>{/if}</a> </li>
              <li class="divider"></li>
              <li><a href="#" onclick="logout();"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Sair</a></li>
            </ul>
          </li>
          
          <!--li class="quicklinks"> <a id="chat-menu-toggle" href="#sidr" class="chat-menu-toggle" >
            <div class="iconset top-chat-dark "><span class="badge badge-important hide" id="chat-message-count">1</span></div>
            </a>
            <div class="simple-chat-popup chat-menu-toggle hide" >
              <div class="simple-chat-popup-arrow"></div>
              <div class="simple-chat-popup-inner">
                <div style="width:100px">
                  <div class="semi-bold">David Nester</div>
                  <div class="message">Hey you there </div>
                </div>
              </div>
            </div>
          </li-->
        </ul>
      </div>
      <!-- END CHAT TOGGLER -->
    </div>
    <!-- END TOP NAVIGATION MENU -->
  </div>
  <!-- END TOP NAVIGATION BAR -->
</div>