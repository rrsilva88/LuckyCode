<section class="unit three-quarters">
                
                <header class="post-header">
                    <h1 class="post-title">Últimos Tutoriais</h1>
                    <div class="breadcrumbs"><a href="{$dwoo.session.sys.base_url}">Home</a> <i class="delimeter"></i> Tutoriais</div>
                </header>
                
                <div class="posts">
                
                
                {foreach $tutoriais tutorial}
                      <article class="post with-thumbnail" data-appear-animation="fadeIn">
                        <div class="thumbnail">
                            <a href="{$dwoo.session.sys.base_url}Tutoriais/View/{$tutorial.alias}"><img src="{$dwoo.session.sys.base_url}uploads/{$tutorial.foto_chamada}" alt="{$tutorial.titulo}" width="364" height="160" /></a>
                            <a href="{$dwoo.session.sys.base_url}Tutoriais/View/{$tutorial.alias}" class="thumb-hover"><span class="details">Ver mais <i class="menu-angle"></i></span></a>
                            <div class="clear"></div>
                        </div>
                        <header>
                            <h2><a href="{$dwoo.session.sys.base_url}Tutoriais/View/{$tutorial.alias}">{$tutorial.titulo}</a></h2>
                            <div class="data">
                                <span class="date">{$tutorial.data_formatada}</span>
                            </div>
                        </header>
                        <div class="text">
                            <p>
                                {$tutorial.chamada}
                            </p>
                        </div>
                                        
                        <footer>
                            <a href="{$dwoo.session.sys.base_url}Tutoriais/View/{$tutorial.alias}" class="continue-reading">Ver Mais <i class="arrow-keep-reading"></i></a>
                        </footer>
                    </article>
                {/foreach}   
                    
                    
                </div>
                
                
                {if $paginacao}

                <div class="pagination">
                    <div class="numeric">
                        {if $paginacao.atual > 0}
                            <a href="{$dwoo.session.sys.base_url}Tutoriais/" class="button dark">0</a>
                        {/if}
                        {if $paginacao.atual > 1}
                                {if $paginacao.atual - 1 == 0}
                                    <a href="{$dwoo.session.sys.base_url}Tutoriais/pagina/{$paginacao.atual - 1}" class="button dark">0</a>       
                                {else}
                                   <a href="{$dwoo.session.sys.base_url}Tutoriais/pagina/{$paginacao.atual - 1}" class="button dark">{$paginacao.atual - 1}</a>        
                                {/if}
                              
                        {/if}
                        {foreach $paginacao.paginas pag} 
                            <a href="{$dwoo.session.sys.base_url}Tutoriais/pagina/{$pag.num}" class="button {if $pag.current}{$pag.current}{else}dark{/if}">{$pag.num}</a> 
                        {/foreach}
                    </div>
                    
                </div>
                
                {/if}
                
            </section>