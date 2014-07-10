<div id="secao-cadastro-cliente">
                    <form action="#" id='cadUser' method="post">
                        <input type='hidden' name='return' value='json'>
                        <div class="caixa">
                            <ul class="lista-form">
                                <li>
                                    <label>
                                        Nome
                                        <span class="input">
                                            <input type="text" id="nome" name="nome">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        CPF ou CNPJ
                                        <span class="input">
                                            <input type="text"  name="cpf_cnpj" id="cpf_cnpj">
                                        </span>
                                    </label>
                                </li>
                                <!--li>
                                    <label>
                                        Telefone
                                        <span class="input">
                                            <input type="text" class="telefone"  name="telefone" id="cpf_cnpj">
                                        </span>
                                    </label>
                                </li-->
                                <li>
                                    <label>
                                        Email
                                        <span class="input">
                                            <input type="text" id="email" name="email" >
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Senha
                                        <span class="input">
                                            <input type="password" id="senha" name="senha">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Confirmar Senha
                                        <span class="input">
                                            <input type="password" id="conf_senha">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <p class="condicoes-uso">
                            <a href="#" id='check_termos' class="checkbox"></a>
                            Eu li e concordo com os <a href="#" class="link">Termos e Condições de Uso</a> da Plataforma VaiMoto.
                            <input type="hidden"  value="">
                        </p>
                        <a href="#" class="submit voltar">Voltar</a>
                        <span class="submit criar-conta">
                            <input type="button" value="Criar conta" onclick="NovoUsuario()">
                        </span>
                    </form>
                </div>