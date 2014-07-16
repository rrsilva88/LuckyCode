    <section class="portfolio wrapper">

            <div class="grid">
            
                <header class="unit hgroup whole">
                    <h2>Últimos trabalhos</h2>
                    <h5>Site, Aplicativos e Sistemas</h5>
                </header>
                
                <div class="unit one-quarter">
                
                    <ul class="portfolio-categories">
                        <li class="current"><a data-filter="*" href="javascript:;">Todos<span data-appear-animation-delay="0.15" data-appear-animation="bounceIn">12</span></a></li>
                        <li><a data-filter=".illustrations" href="javascript:;">Sites <span data-appear-animation-delay="0.25" data-appear-animation="bounceIn">4</span></a></li>
                        <li><a data-filter=".photography" href="javascript:;">Sistemas <span data-appear-animation-delay="0.35" data-appear-animation="bounceIn">4</span></a></li>
                        <li><a data-filter=".wordpress-themes" href="javascript:;">Aplicativos<span data-appear-animation-delay="0.45" data-appear-animation="bounceIn">4</span></a></li>
                    </ul>
                    
                    <p class="portfolio-categories-description">Veja com mais detalhes cada projeto e como ele foi desenvolvido</p>
                    
                    <p>
                        <a href="{$dwoo.session.sys.base_url}Portifolio"  class="button">Ver Mais</a>
                    </p>
                
                </div>
                
                <div class="unit three-quarters">
                
                    <div id="home-portfolio" class="portfolio-items">
                    
                   {$c = 1}
                    {foreach $portifolios portifolio}
                        {if $c == 1 || $c == 6}
                            {$dimensao = 'width="336" height="336"'}
                        {else}
                            {$dimensao = 'width="165" height="165"'}
                        {/if}
                        <div class="item w2 wordpress-themes">
                            <a href="{$dwoo.session.sys.base_url}Portfolio/View/{$portifolio.alias}"><img src="{$dwoo.session.sys.base_url}uploads/{$portifolio.foto_chamada}" {$dimensao}  alt="" /></a>
                            <div class="overlay">
                                <a href="{$dwoo.session.sys.base_url}Portfolio/View/{$portifolio.alias}" class="icon-document"  alt='Detalhes Projeto' title='Detalhes'></a>
                                <a href="{$portifolio.link}" target="_blank" class="icon-zoom" alt='Visitar' title='ir para o david luiz'></a>
                            </div>
                        </div>
                        {$c = $c+1}
                    {/foreach}
                        
                        
                    
                    </div>
                
                </div>
            
            </div>

        </section>