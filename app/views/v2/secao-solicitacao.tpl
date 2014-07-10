<div id="secao-solicitacao">
                    <form action="#" method="post" id="cadPedido">
                        <input type="hidden" value="json" name="return"></input>
                        <span class="tipo-pacote"></span>
                        <input type="hidden" name="km" id='km' value="">
                        <input type="hidden" id="tamanho" name="tamanho" class="tipo-pacote" value="">
                        <div class="caixa-botao-alternancia">
                            <span class="ida" data-value="1">só ida</span>
                            <a href="#" class="botao-alternancia">
                                <span class="indicador"></span>
                            </a>
                            <span class="ida-volta" data-value="2">ida e volta</span>
                            <input name='tipo_entrega'    type="hidden" value="ida">
                        </div>

                        <div class="saida caixa">
                            <ul class="lista-form">
                                <li class="noMarginLeft">
                                    <label>
                                        Retirar de
                                        <span class="input">
                                            <input type="hidden" id='remetente_lat' name='remetente_latitude'>
                                            <input type="hidden" id='remetente_lng' name='remetente_longitude'>
                                            <input type="hidden" id='remetente_estado'>
                                            <input type="text" tabindex="1" id='remetente_endereco' name='remetente_endereco' placeholder="Av. Ibirapuera, 690 - São Paulo - SP">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="saida-complemento caixa-complemento">
                            <ul class="lista-form">
                                <li class="noMarginLeft">
                                    <label>
                                        Bairro
                                        <span class="input half">
                                            <input id='remetente_bairro' tabindex="2" onchange="calculaRota();" name='remetente_bairro' type="text">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Número
                                        <span class="input small">
                                            <input id='remetente_numero' tabindex="3" onchange="calculaRota();" name='remetente_numero' type="text">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Comp.
                                        <span class="input small">
                                            <input name='remetente_complemento' tabindex="4" type="text">
                                        </span>
                                    </label>
                                </li>
                                <li class="noMarginLeft">
                                    <label>
                                        Telefone
                                        <span class="input half">
                                            <input id='remetente_telefone' name='remetente_telefone' tabindex="5"  type="text" class="telefone">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Contato
                                        <span class="input half">
                                            <input id='remetente_nome'  name='remetente_nome' tabindex="6" type="text" placeholder="Nome do contato">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>

                        <div class="entrega caixa">
                            <ul class="lista-form">
                                <li class="noMarginLeft">
                                    <label>
                                        Entregar na
                                        <span class="input">
                                            <input type="hidden" id='destinatario_lat' name='destinatario_latitude'>
                                            <input type="hidden" id='destinatario_lng' name='destinatario_longitude'>
                                            <input type="hidden" id='destinatario_estado'>
                                            <input id="destinatario_endereco" tabindex="7" name="destinatario_endereco" type="text" placeholder="Av. Ibirapuera, 690 - São Paulo - SP">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <div class="entrega-complemento caixa-complemento">
                            <ul class="lista-form">
                                <li class="noMarginLeft">
                                    <label>
                                        Bairro
                                        <span class="input half">
                                            <input id="destinatario_bairro" tabindex="8"  onchange="calculaRota();" name="destinatario_bairro" type="text">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Número
                                        <span class="input small">
                                            <input id="destinatario_numero" tabindex="9"  onchange="calculaRota();" name="destinatario_numero" type="text">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Comp.
                                        <span class="input small">
                                            <input name="destinatario_complemento" tabindex="10" type="text">
                                        </span>
                                    </label>
                                </li>
                                <li class="noMarginLeft">
                                    <label>
                                        Telefone
                                        <span class="input half">
                                            <input type="text" id="destinatario_telefone"  name="destinatario_telefone" tabindex="11" class="telefone">
                                        </span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        Contato
                                        <span class="input half">
                                            <input type="text" id="destinatario_nome"  name="destinatario_nome" tabindex="12" placeholder="Nome do contato">
                                        </span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                        <a href="#" class="submit voltar">Voltar</a>
                        <span class="submit continuar">
                            <input type="button" value="Continuar" onclick="NovoPedido();">
                        </span>
                    </form>
                </div>