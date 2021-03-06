<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Criando uma nova atividade</h4>
                  <div class="tools"><a href="<?php echo $_SESSION['sys']['base_url'];?>Atividades/Configurar/Midia/<?php echo $this->scope["media_id"];?>" class="reload"></a></div>
                </div>
                  <form id='frm_user'>
                <div class="grid-body no-border"> <br>
                  <div class="row">
                  
                  
                  
                  
                  
                    <div class="col-md-12 col-sm-12 col-xs-12">
                  
                  <div class="form-group">
                        <label class="form-label">Selecione um tipo</label>
                        <div class="controls">
                                <div class="radio radio-success">
                                    <input id="tipo_instagram_1" type="radio" name="tipo" value="1" checked="checked">
                                    <label for="tipo_instagram_1">Curtir</label>
                                    <input id="tipo_instagram_2" type="radio" name="tipo" value="2">
                                    <label for="tipo_instagram_2">Comentários</label>
                                </div>
                        </div>
                  </div> 
                           
                    
                      <div class="form-group">
                        <label class="form-label">Quantidade</label>
                        <div class="controls">
                          <input type="text" name='quantidade'   class="form-control span4">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Mídia Selecionada</label>
                        <div class="controls">
                        
                            <?php if ((isset($this->scope["pic"]) ? $this->scope["pic"] : null)) {
?>
                                <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram_<?php echo $this->scope["pic"]["id"];?>'>
                                <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                                  <div class="controller overlay right"></div>
                                
                                  <div class="overlayer bottom-left fullwidth">
                                    <div class="overlayer-wrapper">
                                      <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                                      <?php if ((isset($this->scope["pic"]["likes"]["count"]) ? $this->scope["pic"]["likes"]["count"]:null) > 0) {
?>
                                        <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["likes"]["count"];?> Likes </a>
                                      <?php 
}?>

                                      <?php if ((isset($this->scope["pic"]["comments"]["count"]) ? $this->scope["pic"]["comments"]["count"]:null) > 0) {
?>
                                        <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["comments"]["count"];?> Comentários  </a>
                                      <?php 
}?>

                                       
                                        <p class="p-t-5 p-b-5 ">
                                        <?php if ((isset($this->scope["pic"]["caption"]["text"]) ? $this->scope["pic"]["caption"]["text"]:null)) {
?>
                                            <?php echo $this->scope["pic"]["caption"]["text"];?>

                                          <?php 
}
else {
?>
                                                ...    
                                          <?php 
}?>

                                        </p>
                                      </div>
                                    </div>
                                  </div>
                                  <img id='pic_instagram_<?php echo $this->scope["pic"]["id"];?>' src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src-retina="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" alt="" class="image-responsive-width hover-effect-img"> 
                                </div>
                                </div>
                            <?php 
}?>   
                        
                        
                        </div>
                      </div>
                                      
                       <div class="clearfix"></div>
                      
                      
                      <div class="form-group">
                        <div class="controls">
                          <button type="button" onclick="Create('Atividades');" class="btn btn-primary btn-cons">Escolher Outra</button>
                          <button type="button" onclick="Save();" class="btn btn-success btn-cons">Salvar</button>
                        </div>
                      </div>   
                      
                 
                      
                      
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
            
            
            <script type="text/javascript">
            $(document).ready(function() {                
                    $(".select2").select2();
            
            });
            function Save(){
                 $("#frm_user").ajaxForm({
                    url: "Usuarios/ajaxSave",
                    type:'post',
                    dataType:  'json', 
                    success: function(data) {
                        if(data.status == true){
                            Messenger().post({message: 'Usuário cadastrado com sucesso!',type: 'success',showCloseButton: true});
                            window.location.href = base_url+'Usuarios/Visualizar/'+data.id;
                        }else{
                            Messenger().post({message: 'Erro ao processar esse requisição!',type: 'error',showCloseButton: true});
                        }
                    }
                }).submit(); 
                
            }
            </script>
            <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>