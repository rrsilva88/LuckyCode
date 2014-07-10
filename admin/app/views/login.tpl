{include('header.tpl')}
<script type="text/javascript" src="js/page/login.js"></script>
    <div id="wrap">
    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
              <div class="row-fluid">
                <div class="widget container-narrow">
                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h5>Probiótica Admin</h5>
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
{include('footer.tpl')}    