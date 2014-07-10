
    <!-- Login Menu -->
    <div id="login">
        <div class="header">
            <h1>
                Login
            </h1>

            <a href="#">Esqueceu sua senha?</a>
        </div>
        <form id="loginUser">
        <input type='hidden' name='return' value='json'>
        <div class="box_formulario">
            <ul>
                <li>
                    <img src="images/icon_email.jpg"/>
                    <input type="text" name="email" id="login_email"  placeholder="E-mail" />
                </li>

                <li>
                    <img src="images/icon_senha.jpg"/>
                    <input type="password"  name="senha" id="login_senha"  placeholder="Senha" />
                </li>
            </ul>
        </div>
        </form>
        <div class="bt_send">
            <input type="button"  onclick="LoginUsuario()" value="Login" />
        </div>

        <div class="created_account">
            Ainda não tem uma conta?<br />
            <a href="#">Crie agora totalmente grátis!</a>
        </div>
    </div>


    <!-- Criar Nova Conta -->
    <div class="new_account">
        <div class="header">
            <h1>Criar nova conta</h1>
        </div>
          <form id="cadUser">
           <input type='hidden' name='return' value='json'>
        <div class="box_formulario">
        
            <ul>
                <li>
                    <img src="images/icon_nome.jpg"/>
                    <input type="text" id="nome" name="nome" placeholder="Nome" />
                </li>

                <li>
                    <img src="images/icon_email.jpg"/>
                    <input type="text" id="email" name="email"  placeholder='E-mail'/>
                </li>

                <li>
                    <img src="images/icon_senha.jpg"/>
                    <input type="password" value="" id="senha" name="senha" placeholder='Senha'/>
                </li>
            </ul>
        </div>

        <p><input type="checkbox" class="styled" />Eu li e concordo com os Termos e Condições<br />
        de Uso da Plataforma Nowmoto.</p>
           </form>
        <div class="bt_send">
            <input type="button" value="Criar Conta" onclick="NovoUsuario()" />
        </div>

    </div>
