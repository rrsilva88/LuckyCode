<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><section class="unit three-quarters">
                
                <article class="post">
                
                    <!--
                    
                        POST HEADER
                        
                    -->
                
                    <header class="post-header">
                        <h1 class="post-title"><?php echo $this->scope["noticia"]["titulo"];?></h1>
                        <div class="breadcrumbs"><a href="<?php echo $_SESSION['sys']['base_url'];?>">Home</a> <i class="delimeter"></i> <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias">Notícias</a> <i class="delimeter"></i> <a href='<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>'><?php echo $this->scope["noticia"]["titulo"];?></a></div>
                    </header>
                    
                    <div class="ib post-date">
                        
                        <div class="ib day"><?php echo $this->scope["noticia"]["dia"];?></div>
                        <div class="month"><?php echo $this->scope["noticia"]["mes"];?></div>
                        <div class="year"><?php echo $this->scope["noticia"]["ano"];?></div>
                    </div>
                    
                    <!--
                    
                        POST CONTENT
                        
                    -->
                    
                    <div class="ib post-content">
                        
                        <div class="post-slider">
                            <div class="post">
                                <div class='img_preview'>
                                    <img src="<?php echo $_SESSION['sys']['base_url'];?>uploads/<?php echo $this->scope["noticia"]["foto_chamada"];?>" width="849" alt="" />
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        
                        <div class="post-text">
                            <h2><?php echo $this->scope["noticia"]["subtitulo"];?></h2>
                        
                            <?php echo $this->scope["noticia"]["content_html"];?>

                        
                     
                            <footer>
                    
                                <p>
                                    <strong>Tags:</strong>
                                    <?php echo $this->scope["noticia"]["tags"];?>

                                </p>
                            
                                
                                <p class="share-post">
                                    <strong>Compartilhe:</strong> 
                                    <div class="fb-like" data-href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                                    <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>" data-text="<?php echo $this->scope["noticia"]["titulo"];?>- <?php echo $this->scope["noticia"]["chamada"];?>" data-via="lucky_code" data-lang="pt" data-related="lucky_code" data-hashtags="LuckyNews">Tweetar</a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                                </p>
                            
                                <!--
                            
                                    AUTHOR INFO BLOCK
                                
                                -->
                                
                    
                            </footer>
                        </div>
                        
                           <div class="fb-comments" data-href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>" data-numposts="5" data-colorscheme="light"></div>
                    </div>
                    
                 
                    
                    
                </article>
                
                
                
            </section>
            
         <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>