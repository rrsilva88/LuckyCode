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
                <div class="widget container-narrow">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h5>LuckyCode CMS</h5>
                    </div>  
                    <div class="widget-body clearfix" style="padding:25px;">
                          <form id='FrmLoginAdmin'>
                            <div class="control-group">
                                <div class="controls">
                                    <input class="btn-block" type="text" name='email' id="inputEmail" placeholder="Email">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input class="btn-block" type="password" name='senha' id="inputPassword" placeholder="Senha">
                                </div>
                            </div>
                             <!--div class="control-group">
                                <div class="controls clearfix">
                                    <a style="padding: 5px 0px 0px 5px;" href="#" class="pull-right">Esqueceu sua senha?</a>
                                </div>
                            </div-->                    
                            <button type="button" onclick="LoginAdmin()" class="btn pull-right">Entrar</button>
                          </form>
                    </div>  
                </div>  
                  
            </div><!--/row-fluid-->
        </div><!--/span10-->
      </div><!--/row-fluid-->
    </div><!--/.fluid-container-->
    </div><!-- wrap ends-->
    <!-- wrap ends-->
<?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>