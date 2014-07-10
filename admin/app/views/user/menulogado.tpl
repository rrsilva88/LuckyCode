<script type="text/javascript">
     
$(function() {
    
      $("#sair").click(function(){
              $.post("User/Sair",
              function(data){
                  if(data.status == true){
                     generateNoty('success','Logout efetuado com sucesso!','topRight');
                     window.location.href = base_url; 
                  }
                  
              }, "json");
      });


});

</script>


<!-- Login Menu -->
    <div id="login">
        <div class="header">
            <h1>
                {$dwoo.session.user.nome}
            </h1>

            <a href="#" id='sair'>Sair</a>
        </div>

        <div class="box_formulario">
            <ul>
                <li>
                    <img src="images/icon_email.jpg"/>
                    <input type="text" id="codigo" name="codigo" value='{$dwoo.session.user.email}' placeholder="Email" readonly="readonly" />
                </li>

                <li>
                    <img src="images/icon_senha.jpg"/>
                    <input type="password" id="senha_login" name="senha_login" value='{$dwoo.session.user.senha}' placeholder="Telefone" />
                </li>
            </ul>
        </div>
        <div class="bt_send">
            <input type="button" value="Salvar" />
        </div>
</div>