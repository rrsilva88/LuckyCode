<div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <div class="user-info-wrapper">
     
        <div class="profile-wrapper"> 
            {if $dwoo.session.account_selected.picture}
                <img src="{$dwoo.session.account_selected.picture}"  alt="" data-src="{$dwoo.session.account_selected.picture}" data-src-retina="{$dwoo.session.account_selected.picture}" width="69" height="69" />     
            {else}
                <img src="assets/img/profiles/avatar.jpg"  alt="" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" width="69" height="69" /> 
            {/if}
        
        </div>
        <div class="user-info">
        {if $dwoo.session.account_selected}
          <div class="greeting">{$dwoo.session.account_selected.primeiro_nome}</div>
          <div class="username">@{$dwoo.session.account_selected.username}</div>
        {else}
          <div class="greeting">Bem vindo</div>
          <div class="username">{$dwoo.session.loginADM.primeiro_nome}</div> 
        {/if}    
          <div class="status">Status<a href="#">
            <div class="status-icon green"></div>
            Online</a></div>
        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <p class="menu-title">Menu <span class="pull-right"></span></p>
      <ul>
        {$perfil   = $dwoo.session.sys.app.perfil_selecionado}
                 {$menu   = $dwoo.session.loginADM.acesso.$perfil.acesso}
                 {foreach $menu  item}
                    {if $item.visible == 1}
                      <li class=""> <a href="{$item.classe}/{$item.metodo}" alt='{$item.menu}' title='{$item.menu}'> <i class="fa {$item.icon}"></i> <span class="title">{$item.menu}</span></a> </li>
                    {/if}
                 {/foreach}
      
      
        
      </ul>
      <div class="side-bar-widgets">
      
        <p class="menu-title">Atividades </p>
        <div class="status-widget">
          <div class="status-widget-wrapper">
            <div class="title">Atividade 1</div>
            <p>Processo</p>
            <div class="progress transparent progress-small no-radius no-margin">
      <div data-percentage="86%" class="progress-bar progress-bar-success animate-progress-bar" ></div>
    </div>
    <div class="pull-right">
      <div class="details-status"> <span data-animation-duration="560" data-value="86" class="animate-number"></span>% </div>
    </div>
          </div>
        </div>
        <div class="status-widget">
          <div class="status-widget-wrapper">
            <div class="title">Atividade 2</div>
            <p>Processo</p>  
            <div class="progress transparent progress-small no-radius no-margin">
      <div data-percentage="50%" class="progress-bar progress-bar-success animate-progress-bar" ></div>
    </div>
    <div class="pull-right">
      <div class="details-status"> <span data-animation-duration="560" data-value="50" class="animate-number"></span>% </div>
      </div>
          </div>
        </div>
      </div>
      <div class="clearfix"></div>
      <!-- END SIDEBAR MENU -->
    </div>
  </div>
  <div class="footer-widget">
    
  </div>