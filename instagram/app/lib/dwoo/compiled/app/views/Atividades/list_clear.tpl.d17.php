<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>
<?php 
$_fh0_data = (isset($this->scope["api"]["data"]) ? $this->scope["api"]["data"]:null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['pic'])
	{
/* -- foreach start output */
?>
             <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram_<?php echo $this->scope["pic"]["id"];?>'>
                <!-- BEGIN BLOG POST BIG IMAGE WIDGET -->
                <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                  <div class="controller overlay right"></div>
                
                  <div class="overlayer bottom-left fullwidth">
                    <div class="overlayer-wrapper">
                      <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                      <?php if ((isset($this->scope["pic"]["likes"]["count"]) ? $this->scope["pic"]["likes"]["count"]:null) > 0) {
?>
                        <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["likes"]["count"];?> Likes </a>
                      <?php 
}?>

                      <?php if ((isset($this->scope["pic"]["comments"]["count"]) ? $this->scope["pic"]["comments"]["count"]:null) > 0) {
?>
                        <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["comments"]["count"];?> Comentários  </a>
                      <?php 
}?>

                       
                        <p class="p-t-5 p-b-5 ">
                        <?php if ((isset($this->scope["pic"]["caption"]["text"]) ? $this->scope["pic"]["caption"]["text"]:null)) {
?>
                            <?php echo $this->scope["pic"]["caption"]["text"];?>

                          <?php 
}
else {
?>
                                ...    
                          <?php 
}?>

                        </p>
                        <button type="button" class="btn btn-primary" id='btn_instagram_<?php echo $this->scope["pic"]["id"];?>' onclick="ConfigAtividade('Midia','<?php echo $this->scope["pic"]["id"];?>')">Criar Atividade</button>
                      </div>
                    </div>
                  </div>
                  <img id='pic_instagram_<?php echo $this->scope["pic"]["id"];?>' src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src-retina="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" alt="" class="image-responsive-width hover-effect-img"> 
                </div>
                </div>
<?php 
/* -- foreach end output */
	}
}?>    

       
      
   <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>