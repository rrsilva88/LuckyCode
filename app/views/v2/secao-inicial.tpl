    <div id="secao-inicial" class="secao">
                    <p class="preciso-motoboy">Preciso de um motoboy para</p>
                    <ul class="opcoes">
                        <!--li >
                            <a href="#" class="pagamento-contas" data-value="pagamento-de-contas">
                                <span>Pagamento de contas</span>
                            </a>
                        </li-->
                        <li class="noMarginLeft">
                            <a href="#" class="autenticar-documentos" data-value="documentos">
                                <span>Autenticar documentos</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="pacotes-pequenos" data-value="pequeno">
                                <span>Pacotes pequenos</span>
                            </a>
                        </li>
                        <li >
                            <a href="#" class="pacotes-medios" data-value="medio">
                                <span>Pacotes médios</span>
                            </a>
                        </li>
                        <li class="noMarginLeft">
                            <a href="#" class="pacotes-grandes" data-value="grande">
                                <span>Pacotes grandes</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="outros-objetos" data-value="objetos">
                                <span>Outros objetos</span>
                            </a>
                        </li>
                    </ul>
                    <div class="clear"></div>

                    <!-- 
                    logado
                    <a href="#" class="solicitar-motoboy">Solicitar Motoboy</a> 
                    -->
                    
                    {if $dwoo.session.user.id_user}
                       {include(user_logado.tpl)}
                    {else}
                      <div id='formLogin'>
                      <form class="login" id="loginUser" action="#" method="post">
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
                    {/if}
                    
                </div>
