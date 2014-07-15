<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?> <div class="sidebar-nav nav-collapse collapse">
                 <div class="user_side clearfix">
                   <h5 style="margin-top: 0px;"><?php echo $_SESSION['loginADM']['nome'];?></h5>
                 </div>
                 
                 
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
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle b_9FDDF6" href="<?php echo $this->scope["item"]["classe"];?>/<?php echo $this->scope["item"]["metodo"];?>" alt='<?php echo $this->scope["item"]["menu"];?>' title='<?php echo $this->scope["item"]["menu"];?>'><i <?php if ((isset($this->scope["item"]["icon"]) ? $this->scope["item"]["icon"]:null) != '') {
?>class="<?php echo $this->scope["item"]["icon"];?>" <?php 
}
else {
?> class="icon-circle-blank" <?php 
}?>></i> <span><?php echo $this->scope["item"]["menu"];?></span></a>
                        </div>
                      </div>
                    <?php 
}?>

                  <?php 
/* -- foreach end output */
	}
}?>   
                  
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle b_9FDDF6" onclick='logout()'><i class="icon-off"></i> <span>Sair</span></a>
                    </div>
                  </div>
                  
                  
                </div>
              </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>