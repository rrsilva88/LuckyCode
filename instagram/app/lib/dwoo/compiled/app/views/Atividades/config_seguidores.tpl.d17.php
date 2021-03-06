<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Criando uma nova atividade</h4>
                  <div class="tools"><a href="<?php echo $_SESSION['sys']['base_url'];?>Atividades/Configurar/Seguidores/<?php echo $this->scope["api"]["data"]["id"];?>" class="reload"></a></div>
                </div>
                <form id='frm_atividade'>
                <input type="hidden" name="tipo" value="3">
                <input type="hidden" name="insta_media_id" value="">
                <input type="hidden" name="insta_user_id" value="<?php echo $this->scope["api"]["data"]["id"];?>">
                <input type="hidden" name="id_user" value="<?php echo $_SESSION['loginADM']['id_user'];?>">
                <div class="grid-body no-border"> <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="form-group">
                                <label class="form-label">Quantidade de seguidores</label>
                                <div class="controls">
                                  <h1 class="semi-bold" id='qtd_number'>0</h1>
                                  <input type="text" name='quantidade' id='sliderQTD'  class="slider-element form-control span12" data-slider-value="0" data-slider-step="1" data-slider-max="<?php echo $this->scope["limit_qtd"];?>" data-slider-orientation="horizontal" data-slider-selection="after" >
                                </div>
                              </div>
                              
                          
                              
                              <div class="form-group">
                                <label class="form-label">Perfil Selecionado</label>
                                <div class="controls">
                                <input type="hidden" name='thumb' value="<?php echo $this->scope["api"]["data"]["profile_picture"];?>">
                                
                                   
                                    
                                        <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram'>
                                        <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                                          <div class="controller overlay right"></div>
                                        
                                          <div class="overlayer bottom-left fullwidth">
                                            <div class="overlayer-wrapper">
                                              <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                                              <?php if ((isset($this->scope["api"]["data"]["counts"]["followed_by"]) ? $this->scope["api"]["data"]["counts"]["followed_by"]:null) > 0) {
?>
                                                <a href="#" class="hashtags transparent"><?php echo $this->scope["api"]["data"]["counts"]["followed_by"];?> Seguidores </a>
                                              <?php 
}?>

                                              <?php if ((isset($this->scope["api"]["data"]["counts"]["media"]) ? $this->scope["api"]["data"]["counts"]["media"]:null) > 0) {
?>
                                                <a href="#" class="hashtags transparent"><?php echo $this->scope["api"]["data"]["counts"]["media"];?> Mídias  </a>
                                              <?php 
}?>

                                              </div>
                                            </div>
                                          </div>
                                          <img id='pic_instagram' src="<?php echo $this->scope["api"]["data"]["profile_picture"];?>" data-src="<?php echo $this->scope["api"]["data"]["profile_picture"];?>" data-src-retina="<?php echo $this->scope["api"]["data"]["profile_picture"];?>" alt="" class="image-responsive-width hover-effect-img"> 
                                        </div>
                                        </div>
                                     
                                
                                
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="controls">
                                  <button type="button" onclick="Save();" class="btn btn-success btn-cons">Salvar</button>
                                  <button type="button" onclick="Create('Atividades');" class="btn btn-primary btn-cons">Voltar</button>
                                </div>
                              </div>   
                     </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
            
            
            <script type="text/javascript">
            var saveOn = 0;
            $(document).ready(function() {                
                    $(".select2").select2();
                    var sliderQTD =  $('#sliderQTD').slider().on('slide',AtualizaQuantidade).data('slider');
            
            });
        
       
            function AtualizaQuantidade(){
            
                var quantidade = $('.slider .tooltip-inner').html();
                $("#qtd_number").html(quantidade);
                $("#sliderQTD").html(quantidade);
                
            }
            function Save(){
            
                if(saveOn==0){
                    saveOn = 1;
                 $("#frm_atividade").ajaxForm({
                    url: "Atividades/ajaxSave",
                    type:'post',
                    dataType:  'json', 
                    success: function(data) {
                        if(data.status == true){
                            Messenger().post({message: 'Atividade cadastrada com sucesso!',type: 'success',showCloseButton: true});
                            window.location.href = base_url+'Atividades/Visualizar/'+data.id;
                        }else{
                            Messenger().post({message: 'Erro ao processar esse requisição!',type: 'error',showCloseButton: true});
                        }
                    }
                }).submit(); 
            }
                
            }
            </script>
            <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>