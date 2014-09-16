<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'header_login.tpl', null, null, null, '_root', null);?>

<script type="text/javascript" src="js/page/login.js"></script>
<div class="row login-container animated fadeInUp">  
        <div class="col-md-7 col-md-offset-2 tiles white no-padding">
         <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10"> 
          <h2 class="normal">Swap Fame</h2>
          <p class="p-b-20">The smartest way to exchange likes, gain followers and viralized your posts</p>
          <p class="p-b-20"></p>
        </div>
        <div class="tiles grey p-t-20 p-b-20 text-black">
            <form id="frm_login" class="animated fadeIn">    
                    <div class="row form-row m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                      <div class="col-md-6 col-sm-6 ">
                        <input name="email" id="inputEmail" type="text"  class="form-control" placeholder="Email">
                      </div>
                      <div class="col-md-6 col-sm-6">
                        <input name="senha" id="inputPassword" type="password"  class="form-control" placeholder="Senha">
                      </div>
                    </div>
                <div class="row p-t-10 m-l-20 m-r-20 xs-m-l-10 xs-m-r-10">
                   <div class="control-group  col-md-10">
                        <button type="button" class="btn btn-primary btn-cons" onclick="LoginAdmin()" id="login_toggle">Entrar</button>
                    </div>                  
                  </div>
                  </div>
              </form>
        </div>   
      </div>   
  </div>
  
  
  

  
<?php echo Dwoo_Plugin_include($this, 'footer_login.tpl', null, null, null, '_root', null);?>    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>