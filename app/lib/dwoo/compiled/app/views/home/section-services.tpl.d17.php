<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><section class="services wrapper">

            <div class="grid">
                
                <div class="unit home-services two-thirds">
                    <header class="hgroup">
                        <h2>Serviços</h2>
                        <h5>Nossas soluções profissionais</h5>
                    </header>
                    
                    <div class="liquid-slider content-slider" id="some-tabs">
                                
                        <div>
                            <h2 class="title">Seo & ADS</h2>
                            <img data-appear-animation="fadeIn" src="img/seo.jpg" class="alignleft" width="225" height="225" alt="Seo" />
                            <p><strong>SEO</strong><br/>Temos estratégias com o objetivo de potencializar e melhorar o posicionamento de um site nas páginas de resultados naturais (orgânicos) nos sites de busca gerando conversões, sejam elas, um lead, uma compra, um envio de formulário, agendamento de consulta e outros</p>
                            
                               <p><strong>ADS</strong><br/>Com base nas tags mais buscadas de acordo com a sua necessidade ou campanha conseguimos gerar ads personalizados para ter um impacto/conversão bem significativas!</p>
                           
                            
                            <h3>Por que SEO e ADS?</h3>
                            
                            <ol class="alter">
                                <li>Com um melhor posicionamento você terá maior visibilidade</li>
                                <li>Campanhas de Ads podem aumentar consideravelmente seu acesso/vendas</li>
                                <li>Fazer o seu site ser o melhor do segmento</li>
                            </ol>
                            
                        </div>

                        <div>
                            <h2 class="title">Sites & Lojas</h2>
                                <img data-appear-animation="fadeIn" src="img/seo.jpg" class="alignleft" width="225" height="225" alt="Seo" />
                                <p><strong>Sites</strong><br/>Desenvolvemos qualquer tipo de site com as melhores tecnologias do mercado</p>
                                <ol class="alter">
                                    <li>HTML5</li>
                                    <li>CSS3</li>
                                    <li>JQUERY</li>
                                    <li>Layout Responsivo</li>
                                    <li>Padrão W3C</li>
                                </ol>

                              <img data-appear-animation="fadeIn" src="img/ecommerce.png" class="alignleft" width="225" height="225" alt="Seo" />
                                <p><strong>Lojas Virtuais</strong><br/>Criamos sua loja personalizada!</p>
                                <ol class="alter">
                                    <li>Produtos Configuraveis</li>
                                    <li>Layout Personalizado</li>
                                    <li>Diversas formas de pagamento</li>
                                    <li>Com Certificado de Segurança</li>
                                    <li>E-Bit</li>
                                </ol>

                                
                        </div>
                                    
                        <div>
                            <h2 class="title">Aplicativos & Jogos</h2>
                            
                              <img data-appear-animation="fadeIn" src="img/apple.png" class="alignleft" width="225" height="225" alt="Seo" />
                                <p><strong>IOS</strong><br/>Desenvolvemos para Iphone,Ipad e Ipod</p>  
                                <p><strong>Android</strong><br/>Desenvolvemos para todas as versões</p>
                                <ol class="alter">
                                    <li>Aplicativos</li>
                                    <li>Jogos</li>
                                    <li>Sites</li>
                                </ol>

                        </div>
                        
                        <div>
                            <h2 class="title">Sistemas</h2>
                            <img data-appear-animation="fadeIn" src="img/system.png" class="alignleft" width="225" height="225" alt="Seo" />
                            <p>Desenvolvemos soluções para o seu segmento, criando sistemas personalizados para agilizar o trabalho e otimizar o tempo.Gerando relatórios inteligentes para sempre ter a melhor produção</p>
                            
                            <h3>Tipos de sistemas</h3>
                            
                            <ol class="alter">
                                <li>Sistema interno</li>
                                <li>Gerenciador de conteúdo</li>
                                <li>Intranet</li>
                                
                            </ol>
                        </div>
                                
                    </div>
                    
                </div>
                
                <div class="unit home-skills one-third">
                    <header class="hgroup">
                        <h2>Serviços Realizados</h2>
                     
                    </header>
                    
                    <div class="progress">
                        <div class="title">Sites<span>100%</span></div>
                        <div class="progress-value"><div class="value" data-appear-animation-delay="0.15" data-appear-animation="animateWidth" data-width="85%" style="width: 0%"></div></div>
                    </div>
                                
                    <div class="progress">
                        <div class="title">Web design<span>94%</span></div>
                        <div class="progress-value"><div class="value" data-appear-animation-delay="0.35" data-appear-animation="animateWidth" data-width="94%" style="width: 0%"></div></div>
                    </div>
                                
                    <div class="progress">
                        <div class="title">Aplicativos<span>67%</span></div>
                        <div class="progress-value"><div class="value" data-appear-animation-delay="0.55" data-appear-animation="animateWidth" data-width="67%" style="width: 0%"></div></div>
                    </div>
                                
                    <div class="progress">
                        <div class="title">Indentidade <span>58%</span></div>
                        <div class="progress-value"><div class="value" data-appear-animation-delay="0.75" data-appear-animation="animateWidth" data-width="58%" style="width: 0%"></div></div>
                    </div>
                                
                    <div class="progress">
                        <div class="title">SEO<span>91%</span></div>
                        <div class="progress-value"><div class="value" data-appear-animation-delay="0.95" data-appear-animation="animateWidth" data-width="91%" style="width: 0%"></div></div>
                    </div>
                  
                    
                    <p><a href="<?php echo $_SESSION['sys']['base_url'];?>Servicos" class="button">ir Portfólio</a></p>
                    
                </div>
                
            </div>

        </section><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>