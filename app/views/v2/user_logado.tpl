  <div id='formLogin'>
  
  <div id='userLogado'>
    <p>Bem vindo(a) <b>{$dwoo.session.user.nome}</b>!</p>
    <p>Selecione o tipo de pedido e realize seu pedido!</p>
    <p>Obrigado por utilizar a VaiMoto.</p>
</div>
<form class="login" id="loginUser" action="#" method="post" style="display:none;">
    <input type="hidden" value="json" name="return">
    <ul class="lista-form">
        <li>
            <label>
                E-mail
                <span class="input">
                    <input id="login_email" type="text" name="email" placeholder="Digite seu e-mail">
                </span>
            </label>
        </li>
        <li>
            <label>
                Senha
                <span class="input">
                    <input id="login_senha" type="password"  name="senha" type="text" placeholder="Digite sua senha">
                </span>
            </label>
        </li>
    </ul>
    <a href="#" class="submit cadastrar">Cadastrar</a>
    <span class="submit continuar">
        <input type="button" value="Continuar" onclick="LoginUsuario()">
    </span>
</form>

</div>