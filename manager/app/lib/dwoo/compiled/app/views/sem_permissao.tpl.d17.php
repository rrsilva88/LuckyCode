<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'header.tpl', null, null, null, '_root', null);?>

<script type="text/javascript" src="js/page/login.js"></script>
    <div id="wrap">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
              <div class="row-fluid">
                <h1>Você Não tem permissão para acessar essa área.</h1>
                  
            </div><!--/row-fluid-->
        </div><!--/span10-->
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
    </div><!-- wrap ends-->
    <!-- wrap ends-->
<?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>