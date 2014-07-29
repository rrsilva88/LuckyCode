<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
          <div class="grid simple horizontal green">
            <div class="grid-title ">
              <h4>Autorização realizada com sucesso!</h4>
              
            </div>
            <div class="grid-body">
              <div>
                <h3>Deu<span class="semi-bold"> Certo!</span></h3>
               <div class="user-comment-wrapper">
                  <div class="profile-wrapper"> 
                  <img src="<?php echo $this->scope["picture"];?>" alt="" data-src="<?php echo $this->scope["picture"];?>" data-src-retina="<?php echo $this->scope["picture"];?>" width="35" height="35">
                  </div>
                  <div class="comment">
                    <div class="user-name text-black bold"><?php echo $this->scope["nome"];?></div>
                    <div class="preview-wrapper">@ <?php echo $this->scope["username"];?> </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <p>Agora você pode utilizar todos os recursos do nosso sistema!</p>
                <p>Crie agora sua atividade para ter mais ( Likes / Comentários / Seguidores ) <b>Have fun!</b></p>
                
                <a class="btn  btn-info" type="button" onclick="Create('Atividades')"> <span class="pull-left"><i class="fa fa-instagram"></i></span> <span class="bold">&nbsp;&nbsp;Criar Atividade</span></a>
                
              </div>
            </div>
          </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>