<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><section class="unit three-quarters">
                
                <header class="post-header">
                    <h1 class="post-title">Últimas Notícias</h1>
                    <div class="breadcrumbs"><a href="<?php echo $_SESSION['sys']['base_url'];?>">Home</a> <i class="delimeter"></i> Notícias</div>
                </header>
                
                <div class="posts">
                
                
                <?php 
$_fh0_data = (isset($this->scope["noticias"]) ? $this->scope["noticias"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['noticia'])
	{
/* -- foreach start output */
?>
                      <article class="post with-thumbnail" data-appear-animation="fadeIn">
                        <div class="thumbnail">
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>"><img src="<?php echo $_SESSION['sys']['base_url'];?>uploads/<?php echo $this->scope["noticia"]["foto_chamada"];?>" alt="<?php echo $this->scope["noticia"]["titulo"];?>" width="364" height="160" /></a>
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>" class="thumb-hover"><span class="details">Ver mais <i class="menu-angle"></i></span></a>
                            <div class="clear"></div>
                        </div>
                        <header>
                            <h2><a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>"><?php echo $this->scope["noticia"]["titulo"];?></a></h2>
                            <div class="data">
                                <span class="date"><?php echo $this->scope["noticia"]["data_formatada"];?></span>
                            </div>
                        </header>
                        <div class="text">
                            <p>
                                <?php echo $this->scope["noticia"]["chamada"];?>

                            </p>
                        </div>
                                        
                        <footer>
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/View/<?php echo $this->scope["noticia"]["alias"];?>" class="continue-reading">Ver Mais <i class="arrow-keep-reading"></i></a>
                        </footer>
                    </article>
                <?php 
/* -- foreach end output */
	}
}?>   
                    
                    
                </div>
                
                
                <?php if ((isset($this->scope["paginacao"]) ? $this->scope["paginacao"] : null)) {
?>

                <div class="pagination">
                    <div class="numeric">
                        <?php if ((isset($this->scope["paginacao"]["atual"]) ? $this->scope["paginacao"]["atual"]:null) > 0) {
?>
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/" class="button dark">0</a>
                        <?php 
}?>

                        <?php if ((isset($this->scope["paginacao"]["atual"]) ? $this->scope["paginacao"]["atual"]:null) > 1) {
?>
                                <?php if ((isset($this->scope["paginacao"]["atual"]) ? $this->scope["paginacao"]["atual"]:null)-1 == 0) {
?>
                                    <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/pagina/<?php echo $this->scope["paginacao"]["atual"]-1;?>" class="button dark">0</a>       
                                <?php 
}
else {
?>
                                   <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/pagina/<?php echo $this->scope["paginacao"]["atual"]-1;?>" class="button dark"><?php echo $this->scope["paginacao"]["atual"]-1;?></a>        
                                <?php 
}?>

                              
                        <?php 
}?>

                        <?php 
$_fh1_data = (isset($this->scope["paginacao"]["paginas"]) ? $this->scope["paginacao"]["paginas"]:null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['pag'])
	{
/* -- foreach start output */
?> 
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Noticias/pagina/<?php echo $this->scope["pag"]["num"];?>" class="button <?php if ((isset($this->scope["pag"]["current"]) ? $this->scope["pag"]["current"]:null)) {

echo $this->scope["pag"]["current"];

}
else {
?>dark<?php 
}?>"><?php echo $this->scope["pag"]["num"];?></a> 
                        <?php 
/* -- foreach end output */
	}
}?>

                    </div>
                    
                </div>
                
                <?php 
}?>

                
            </section><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>