<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>    <section class="portfolio wrapper">

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
                        <a href="<?php echo $_SESSION['sys']['base_url'];?>Portifolio"  class="button">Ver Mais</a>
                    </p>
                
                </div>
                
                <div class="unit three-quarters">
                
                    <div id="home-portfolio" class="portfolio-items">
                    
                   <?php $this->scope["c"]=1?>

                    <?php 
$_fh0_data = (isset($this->scope["portifolios"]) ? $this->scope["portifolios"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['portifolio'])
	{
/* -- foreach start output */
?>
                        <?php if ((isset($this->scope["c"]) ? $this->scope["c"] : null) == 1 || (isset($this->scope["c"]) ? $this->scope["c"] : null) == 6) {
?>
                            <?php $this->scope["dimensao"]='width="336" height="336"'?>

                        <?php 
}
else {
?>
                            <?php $this->scope["dimensao"]='width="165" height="165"'?>

                        <?php 
}?>

                        <div class="item w2 wordpress-themes">
                            <a href="<?php echo $_SESSION['sys']['base_url'];?>Portfolio/View/<?php echo $this->scope["portifolio"]["alias"];?>"><img src="<?php echo $_SESSION['sys']['base_url'];?>uploads/<?php echo $this->scope["portifolio"]["foto_chamada"];?>" <?php echo $this->scope["dimensao"];?>  alt="" /></a>
                            <div class="overlay">
                                <a href="<?php echo $_SESSION['sys']['base_url'];?>Portfolio/View/<?php echo $this->scope["portifolio"]["alias"];?>" class="icon-document"  alt='Detalhes Projeto' title='Detalhes'></a>
                                <a href="<?php echo $this->scope["portifolio"]["link"];?>" target="_blank" class="icon-zoom" alt='Visitar' title='Visitar'></a>
                            </div>
                        </div>
                        <?php $this->scope["c"]=((isset($this->scope["c"]) ? $this->scope["c"] : null) + 1)?>

                    <?php 
/* -- foreach end output */
	}
}?>

                        
                        
                    
                    </div>
                
                </div>
            
            </div>

        </section><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>