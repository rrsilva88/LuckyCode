{include('header_login.tpl')}
<script type="text/javascript" src="js/page/login.js"></script>
<div class="row login-container animated fadeInUp">  
        <div class="col-md-7 col-md-offset-2 tiles white no-padding">
         <div class="p-t-30 p-l-40 p-b-20 xs-p-t-10 xs-p-l-10 xs-p-b-10"> 
          <h2 class="normal">Instagram</h2>
          <p class="p-b-20">Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos.</p>
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
  
  
  

  
{include('footer_login.tpl')}    