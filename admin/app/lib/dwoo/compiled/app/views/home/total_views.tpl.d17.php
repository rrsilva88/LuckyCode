<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>
<div class='total_views'>
    <div class='today'><p><?php echo $this->scope["hoje"];?></p><small>Total</small></div>
    <div class='up'><i class="icon-arrow-up"></i><small><?php echo $this->scope["crescimento"];?></small></div>
    <div class='last'>Ontem: <?php echo $this->scope["antes"];?></div>
</div>


<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>