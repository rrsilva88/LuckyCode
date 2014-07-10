<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div id='status_envio'>
     <div class="alert alert-info">
        Controle de envio de email's, será executado após você configurar e enviar os email's. 
    </div>  

</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>