<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="total" style="color:<?php echo $this->scope["color"];?>;">
    <div title="MÊS" alt="MÊS" class='mes'>
    <p>
        <span>Mês</span><br />
        <b><?php echo $this->scope["total_mes"];?></b>
    </p>
    </div> 
    <div class='divider_total'>/</div>
    <div class='geral' title="GERAL" alt="GERAL">
    <p>
        <span>Geral</span><br />
        <b><?php echo $this->scope["total"];?></b>
    </p>
    
    
    </div>

</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>