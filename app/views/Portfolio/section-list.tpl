<section class="unit whole">
                
                <div class="post">
                
                    <!--
                    
                        POST HEADER
                        
                    -->
                
                    <header class="post-header">
                        <h1 class="post-title">Portfólio</h1>
                        <div class="breadcrumbs"><a href="{$dwoo.session.sys.base_url}">Home</a> <i class="delimeter"></i> Portfólio</div>
                    </header>
                    
                    <!--
                    
                        POST CONTENT
                        
                    -->
                    
                    <div class="post-content">
                        
                        <div class="filters">
                            <ul class="sorter">
                                <li class="filter" id="todos">Todos</li>
                                <li class="filter" id="sites">Sites</li>
                                <li class="filter" id="lojas">Lojas</li>
                                <li class="filter" id="aplicativos">Aplicativos</li>
                            </ul>
                            
                            <div class="clear"></div>

                        </div>
                        
                        <div class="portfolio-items">
                   
                {foreach $portifolios portifolio}     
                    <div class="item visible {$portifolio.tipos} appear-animation" data-name="{$portifolio.nome}"  data-appear-animation-delay="0.1" data-appear-animation="bounceIn">        
                        <div class="hexagon">
                        <div class="hexagon-in1">
                        <div class="hexagon-in2" style="background-image: url('{$dwoo.session.sys.base_url}uploads/{$portifolio.foto_chamada}');"><div class="overflow"></div></div>
                                    </div>
                                </div>
                                
                                <div class="links">    
                                    <a href="{$dwoo.session.sys.base_url}Portfolio/View/{$portifolio.alias}">Detalhes <i class="menu-angle"></i></a>
                                    {if $portifolio.link != ''}<a href="{$portifolio.link}" target="_blank">Visitar<i class="menu-angle"></i></a>{/if}
                                </div>
                                
                            </div>
                {/foreach}
                        
                        </div>
                        
                    </div>
                    
                </div>
                
                
                
            </section>
            
         