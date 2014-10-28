<section class="unit three-quarters">
                
                <article class="post">
                
                    <!--
                    
                        POST HEADER
                        
                    -->
                
                    <header class="post-header">
                        <h1 class="post-title">{$noticia.titulo}</h1>
                        <div class="breadcrumbs"><a href="{$dwoo.session.sys.base_url}">Home</a> <i class="delimeter"></i> <a href="{$dwoo.session.sys.base_url}Noticias">Notícias</a> <i class="delimeter"></i> <a href='{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}'>{$noticia.titulo}</a></div>
                    </header>
                    
                    <div class="ib post-date">
                        
                        <div class="ib day">{$noticia.dia}</div>
                        <div class="month">{$noticia.mes}</div>
                        <div class="year">{$noticia.ano}</div>
                    </div>
                    
                    <!--
                    
                        POST CONTENT
                        
                    -->
                    
                    <div class="ib post-content">
                        
                        <div class="post-slider">
                            <div class="post">
                                <div class='img_preview'>
                                    <img src="{$dwoo.session.sys.base_url}uploads/{$noticia.foto_chamada}" width="849" alt="" />
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="post-text">
                            <h2>{$noticia.subtitulo}</h2>
                        
                            {$noticia.content_html}
                        
                     
                            <footer>
                    
                                <p>
                                    <strong>Tags:</strong>
                                    {$noticia.tags}
                                </p>
                            
                                
                                <p class="share-post">
                                    <strong>Compartilhe:</strong> 
                                    <div class="fb-like" data-href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}" data-text="{$noticia.titulo}- {$noticia.chamada}" data-via="lucky_code" data-lang="pt" data-related="lucky_code" data-hashtags="LuckyNews">Tweetar</a>
                                    {literal}<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>{/literal}
                                </p>
                            
                                <!--
                            
                                    AUTHOR INFO BLOCK
                                
                                -->
                                
                    
                            </footer>
                        </div>
                        {literal}  
                          
                                                                    
                        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Noticia -->
                        <ins class="adsbygoogle"
                             style="display:inline-block;width:728px;height:90px"
                             data-ad-client="ca-pub-7578060060421552"
                             data-ad-slot="3455861423"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                        {/literal}
                        
                           <div class="fb-comments" data-href="{$dwoo.session.sys.base_url}Noticias/View/{$noticia.alias}" data-numposts="5" data-colorscheme="light"></div>
                    </div>
                    
                 
                    
                    
                </article>
                
                
                
            </section>
            
         