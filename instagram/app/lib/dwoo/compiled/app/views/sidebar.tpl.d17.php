<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="page-sidebar" id="main-menu">
    <!-- BEGIN MINI-PROFILE -->
    <div class="page-sidebar-wrapper" id="main-menu-wrapper">
      <div class="user-info-wrapper">
        <div class="profile-wrapper"> <img src="assets/img/profiles/avatar.jpg"  alt="" data-src="assets/img/profiles/avatar.jpg" data-src-retina="assets/img/profiles/avatar2x.jpg" width="69" height="69" /> </div>
        <div class="user-info">
          <div class="greeting">Bem vindo</div>
          <div class="username"><?php echo $_SESSION['loginADM']['primeiro_nome'];?></div>
          <div class="status">Status<a href="#">
            <div class="status-icon green"></div>
            Online</a></div>
        </div>
      </div>
      <!-- END MINI-PROFILE -->
      <!-- BEGIN SIDEBAR MENU -->
      <p class="menu-title">Menu <span class="pull-right"></span></p>
      <ul>
        <?php $this->scope["perfil"]=(isset($_SESSION['sys']['app']['perfil_selecionado'])?$_SESSION['sys']['app']['perfil_selecionado']:null)?>

                 <?php $this->scope["menu"]=$this->readVar("dwoo.session.loginADM.acesso.".(isset($this->scope["perfil"]) ? $this->scope["perfil"] : null).".acesso")?>

                 <?php 
$_fh0_data = (isset($this->scope["menu"]) ? $this->scope["menu"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['item'])
	{
/* -- foreach start output */
?>
                    <?php if ((isset($this->scope["item"]["visible"]) ? $this->scope["item"]["visible"]:null) == 1) {
?>
                      <li class=""> <a href="<?php echo $this->scope["item"]["classe"];?>/<?php echo $this->scope["item"]["metodo"];?>" alt='<?php echo $this->scope["item"]["menu"];?>' title='<?php echo $this->scope["item"]["menu"];?>'> <i class="fa <?php echo $this->scope["item"]["icon"];?>"></i> <span class="title"><?php echo $this->scope["item"]["menu"];?></span></a> </li>
                    <?php 
}?>

                 <?php 
/* -- foreach end output */
	}
}?>

      
      
        
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
    
  </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>