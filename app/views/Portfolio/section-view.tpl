<section class="unit three-quarters">
                
                <article class="post">
                
                    <!--
                    
                        POST HEADER
                        
                    -->
                
                    <header class="post-header">
                        <h1 class="post-title">{$Portfolio.nome}</h1>
                        <div class="breadcrumbs"><a href="{$dwoo.session.sys.base_url}">Home</a> <i class="delimeter"></i> <a href="{$dwoo.session.sys.base_url}Portfolio">Portifólio</a> <i class="delimeter"></i> <a href='{$dwoo.session.sys.base_url}Noticias/View/{$Portfolio.alias}'>{$Portfolio.nome}</a></div>
                    </header>
                    
                    <div class="ib post-date">
                        
                        <div class="ib day">{$Portfolio.dia}</div>
                        <div class="month">{$Portfolio.mes}</div>
                        <div class="year">{$Portfolio.ano}</div>
                    </div>
                    
                    <!--
                    
                        POST CONTENT
                        
                    -->
                    
                    <div class="ib post-content">
                        
                        <div class="post-slider">
                            <div class="post">
                                <div class='img_preview'>
                                    <img src="{$dwoo.session.sys.base_url}uploads/{$Portfolio.foto_chamada}" width="849" alt="" />
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                              
                           
                        <div class="post-text">
                            <h2>{$Portfolio.nome}</h2>
                            {$Portfolio.content_html}
                        
                     
                              {if $Portfolio.view!= ''}
                                <a data-appear-animation="fadeIn" href="{$Portfolio.view}"  target="_blank" class="button appear-animation fadeIn animated animation-finished" style="-webkit-animation: 0s;"><i class="fa"></i>Demo</a>
                              {/if}
                              {if $Portfolio.download!= ''}
                                <a data-appear-animation="fadeIn" href="{$Portfolio.download}" class="button dark appear-animation fadeIn animated animation-finished" style="-webkit-animation: 0s;"><i class="fa"></i>Download</a>
                              {/if}
                                <br />
                            <div class="clear"></div>
                            <br />
                            
                     
                            <footer>
                            
                               
                              
                                <p>
                                    <strong>Tags:</strong>
                                    {$Portfolio.tags}
                                </p>
                            
                                
                                <p class="share-post">
                                
                                
                                
                                    <strong>Compartilhe:</strong> 
                                    <div class="fb-like" data-href="{$dwoo.session.sys.base_url}Portfolio/View/{$Portfolio.alias}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="{$dwoo.session.sys.base_url}Portfolio/View/{$Portfolio.alias}" data-text="{$Portfolio.nome}- {$Portfolio.chamada}" data-via="lucky_code" data-lang="pt" data-related="lucky_code" data-hashtags="LuckyNews">Tweetar</a>
                                    {literal}<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>{/literal}
                                </p>
                            
                                <!--
                            
                                    AUTHOR INFO BLOCK
                                
                                -->
                                
                    
                            </footer>
                        </div>
                        
                           <div class="fb-comments" data-href="{$dwoo.session.sys.base_url}Portfolio/View/{$Portfolio.alias}" data-numposts="5" data-colorscheme="light"></div>
                    </div>
                    
                 
                    
                    
                </article>
                
                
                
            </section>
            
         