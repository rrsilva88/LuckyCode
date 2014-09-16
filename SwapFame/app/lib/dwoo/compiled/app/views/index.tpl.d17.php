<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'header.tpl', null, null, null, '_root', null);?>

    <!-- BEGIN NAV MENU -->
        <?php echo Dwoo_Plugin_include($this, 'nav.tpl', null, null, null, '_root', null);?>

    <!-- END NAV MENU -->    
    <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
            
                <!-- BEGIN SIDEBAR -->
                    <?php echo Dwoo_Plugin_include($this, 'sidebar.tpl', null, null, null, '_root', null);?>

                <!-- END SIDEBAR -->
            
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
      <div class="page-title">
      </div>
       <!-- BEGIN DASHBOARD TILES -->
    
          
                <?php if ((isset($this->scope["content"]) ? $this->scope["content"] : null)) {
?>
                         <?php 
$_fh1_data = (isset($this->scope["content"]["rows"]) ? $this->scope["content"]["rows"]:null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['row'])
	{
/* -- foreach start output */
?>
                              <div class="row">
                                    <?php 
$_fh0_data = (isset($this->scope["row"]["widgets"]) ? $this->scope["row"]["widgets"]:null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['widget'])
	{
/* -- foreach start output */
?>     
                                        <?php echo $this->scope["widget"];?>

                                    <?php 
/* -- foreach end output */
	}
}?>

                              </div>
                         <?php 
/* -- foreach end output */
	}
}?>

                  <?php 
}?>

           
        
      


       </div>
          </div>
           
      
    <!-- END CONTAINER -->
<?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>