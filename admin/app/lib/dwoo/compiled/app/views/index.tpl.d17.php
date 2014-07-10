<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'header.tpl', null, null, null, '_root', null);?>

    <div id="wrap">
        <!-- Nav menu -->
        <?php echo Dwoo_Plugin_include($this, 'nav.tpl', null, null, null, '_root', null);?>

        <!-- /Nav menu -->
        <div class="container-fluid">
             
              <!-- Side menu -->
                <?php echo Dwoo_Plugin_include($this, 'sidebar.tpl', null, null, null, '_root', null);?>

              <!-- /Side menu -->
         
              <!-- Main window -->
              <div class="main_container" id="dashboard_page">
                <?php if ((isset($this->scope["title"]) ? $this->scope["title"] : null)) {
?>
              <div class="row-fluid"> 
                  <h2 class="heading">
                    <?php echo $this->scope["title"];?>

                  <?php if ((isset($this->scope["title_btns"]) ? $this->scope["title_btns"] : null)) {
?>
                      <div class="btn-group pull-right">
                       <?php 
$_fh6_data = (isset($this->scope["title_btns"]) ? $this->scope["title_btns"] : null);
if ($this->isArray($_fh6_data) === true)
{
	foreach ($_fh6_data as $this->scope['btn'])
	{
/* -- foreach start output */
?>
                            <button class="btn" <?php echo $this->scope["btn"]["action"];?> <?php if ((isset($this->scope["btn"]["attrs"]) ? $this->scope["btn"]["attrs"]:null)) {
?> <?php 
$_fh5_data = (isset($this->scope["btn"]["attrs"]) ? $this->scope["btn"]["attrs"]:null);
if ($this->isArray($_fh5_data) === true)
{
	foreach ($_fh5_data as $this->scope['attr'])
	{
/* -- foreach start output */

echo $this->scope["attr"];

/* -- foreach end output */
	}
}

}?>><i class="<?php echo $this->scope["btn"]["class"];?>" ></i> <?php echo $this->scope["btn"]["name"];?></button>
                       <?php 
/* -- foreach end output */
	}
}?>

                      </div>
                  <?php 
}?>

                  </h2>
              </div>
              <?php 
}?>

                 <?php if ((isset($this->scope["stats"]) ? $this->scope["stats"] : null) == true) {
?>
                    <?php echo Dwoo_Plugin_include($this, 'stats.tpl', null, null, null, '_root', null);?>

                 <?php 
}?>

              
             
              
                 <?php if ((isset($this->scope["content"]) ? $this->scope["content"] : null)) {
?>
                    <?php $this->scope["size"]=0?>

                    <?php $this->scope["var_fluid"]=0?>

                    <?php $this->scope["count_widgets"]=count((isset($this->scope["content"]) ? $this->scope["content"] : null))?>

                    <?php $this->scope["contador"]=1?>

                    <?php 
$_fh9_data = (isset($this->scope["content"]) ? $this->scope["content"] : null);
if ($this->isArray($_fh9_data) === true)
{
	foreach ($_fh9_data as $this->scope['widget'])
	{
/* -- foreach start output */
?>
                            <?php if ((isset($this->scope["contador"]) ? $this->scope["contador"] : null) == 1) {
?>
                                 <div class="row-fluid <?php echo $this->scope["widget"]["size"];?>" >  
                            <?php 
}
else {
?>
                                <?php if ((isset($this->scope["size"]) ? $this->scope["size"] : null) == 0) {
?>
                                    <div class="row-fluid <?php echo $this->scope["widget"]["size"];?>" >  
                                <?php 
}?>

                                    
                            <?php 
}?>

                         <div class="widget widget-padding span<?php echo $this->scope["widget"]["size"];?>">
                                    <div class="widget-header">
                                        <?php if ((isset($this->scope["widget"]["icon"]) ? $this->scope["widget"]["icon"]:null)) {
?><i class="<?php echo $this->scope["widget"]["icon"];?>"></i><?php 
}
else {
?><i class="icon-circle"></i><?php 
}?>

                                        <h5><?php echo $this->scope["widget"]["name"];?></h5>
                                        <div class="widget-buttons">
                                            <a href="javascript:void(0)" class="collapse" data-collapsed="false"><i data-title="Collapse" class="icon-chevron-up"></i></a>
                                        </div>
                                    </div> <!-- /widget-header -->
                                    <div class="widget-body" style="min-height: 170px;">
                                        <?php echo $this->scope["widget"]["html"];?>

                                    </div><!-- /widget-body -->
                                    <?php if ((isset($this->scope["widget"]["footer"]) ? $this->scope["widget"]["footer"]:null)) {
?>  
                                    <div class="widget-footer">
                                        <?php 
$_fh8_data = (isset($this->scope["widget"]["footer"]) ? $this->scope["widget"]["footer"]:null);
if ($this->isArray($_fh8_data) === true)
{
	foreach ($_fh8_data as $this->scope['btns_footer'])
	{
/* -- foreach start output */
?>
                                            <a class="<?php echo $this->scope["btns_footer"]["class"];?>"  <?php if ((isset($this->scope["btns_footer"]["href"]) ? $this->scope["btns_footer"]["href"]:null)) {
?> href="<?php echo $this->scope["btns_footer"]["href"];?>"<?php 
}?>  <?php if ((isset($this->scope["btns_footer"]["onclick"]) ? $this->scope["btns_footer"]["onclick"]:null)) {
?> onclick="<?php echo $this->scope["btns_footer"]["onclick"];?>"<?php 
}?>    <?php if ((isset($this->scope["btns_footer"]["attrs"]) ? $this->scope["btns_footer"]["attrs"]:null)) {
?> <?php 
$_fh7_data = (isset($this->scope["btns_footer"]["attrs"]) ? $this->scope["btns_footer"]["attrs"]:null);
if ($this->isArray($_fh7_data) === true)
{
	foreach ($_fh7_data as $this->scope['attr'])
	{
/* -- foreach start output */

echo $this->scope["attr"];

/* -- foreach end output */
	}
}

}?>><?php echo $this->scope["btns_footer"]["title"];?></a>
                                        <?php 
/* -- foreach end output */
	}
}?>  
                                    </div>
                                    <?php 
}?> 
                              </div><!-- /widget -->
                              
                              
                          <?php if ((isset($this->scope["contador"]) ? $this->scope["contador"] : null) == (isset($this->scope["count_widgets"]) ? $this->scope["count_widgets"] : null)) {
?>    
                                </div><!-- /fluid -->
                          <?php 
}
else {
?>
                               <?php if (( (isset($this->scope["size"]) ? $this->scope["size"] : null)+(isset($this->scope["widget"]["size"]) ? $this->scope["widget"]["size"]:null) ) >= 12) {
?>
                                  </div>
                                  <?php $this->scope["size"]=0?>

                               <?php 
}
else {
?>
                                  <?php $this->scope["size"]=(isset($this->scope["size"]) ? $this->scope["size"] : null)+(isset($this->scope["widget"]["size"]) ? $this->scope["widget"]["size"]:null)?>

                               <?php 
}?>

                          <?php 
}?>

                          <?php $this->scope["contador"]=(isset($this->scope["contador"]) ? $this->scope["contador"] : null)+1?>    
                    <?php 
/* -- foreach end output */
	}
}?>

                <?php 
}?>    
        </div><!--/.fluid-container-->
    </div>
    <!-- wrap ends-->
<?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>