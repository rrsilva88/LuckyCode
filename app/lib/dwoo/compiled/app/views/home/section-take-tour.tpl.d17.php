<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><section class="take-tour">
            
            <div class="wrapper">
            
                <div class="grid">
                
                    <div class="unit whole">
            
                        <a href="<?php echo $_SESSION['sys']['base_url'];?>Contato" class="button pull-right">Contato</a>
                        <h4>Desenvolvemos <span class="pick-out">Sites, Aplicativos , Sistemas e Mídias Sociais!</span></h4>
                        
                        
                    </div>
                    
                </div>
                
            </div>
            
        </section><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>