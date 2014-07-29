<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
  <div class="grid solid red">
    <div class="grid-title">
      <h4>Ops! Houston we have a problem!</h4>
    </div>
    <div class="grid-body">
      <h3>Ocorreu um<span class="semi-bold"> Problema</span></h3>
      <p>
      Durante o processo de autenticação ocorreu algum problema:
      <ul>
        <li>O Servidor do Instagram ficou instavel durante o processo</li>
        <li>Você não deu as permissões necessárias para o sistema funcionar</li>
        <li>Seu token de acesso expirou</li>
      </ul>
      </p>
      <a class="btn btn-primary" type="button" href="<?php echo $_SESSION['sys']['auth_link'];?>"> <span class="pull-left"><i class="fa fa-instagram"></i></span> <span class="bold">&nbsp;&nbsp;Tentar novamente</span></a>
    </div>
  </div>
</div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>