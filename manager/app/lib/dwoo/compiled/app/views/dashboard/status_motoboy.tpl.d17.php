<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>    <div style="margin-bottom:15px;" class="row-fluid status_motoboy">
      <a href="#" class="btn  btn-box bubble  span4 tips"><i class="icon-thumbs-down"><br/><?php echo $this->scope["indisponivel"]["nome"];?></i><span><?php echo $this->scope["indisponivel"]["total"];?></span></a>
      <a href="#" class="btn  btn-box  bubble bubble-info span4 tips" > <i class="icon-thumbs-up"><br/><?php echo $this->scope["disponivel"]["nome"];?></i><span><?php echo $this->scope["disponivel"]["total"];?></span></a>
      <a href="#" class="btn  btn-box span4  " ><i class="icon-truck"><br/><?php echo $this->scope["entregando"]["nome"];?></i><span><?php echo $this->scope["entregando"]["total"];?></span></a>
    </div>
    
    
    <div class="row-fluid status_motoboy" style="margin-bottom:15px;">
      <a style="margin-bottom:0;"  href="#" class="btn  btn-box bubble  bubble-warning span4 tips" ><i class="icon-ban-circle"><br/><?php echo $this->scope["bloqueado"]["nome"];?></i><span><?php echo $this->scope["bloqueado"]["total"];?></span></a>
      <a style="margin-bottom:0;" data-title="" href="#" class="btn   btn-box span4 tips" ><i class="icon-eye-open"><br/><?php echo $this->scope["em_analise"]["nome"];?></i><span><?php echo $this->scope["em_analise"]["total"];?></span></a>
      <a style="margin-bottom:0;" data-title="" href="#" class="btn  btn-box span4 tips" ><i class="icon-edit"><br/><?php echo $this->scope["pre_cadastro"]["nome"];?></i><span><?php echo $this->scope["pre_cadastro"]["total"];?></span></a>
    </div>
    
    <div class="alert alert-info">
     Controle de status dos motoboys    
    </div>

<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>