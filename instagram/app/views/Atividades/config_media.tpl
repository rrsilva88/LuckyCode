<div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Criando uma nova atividade</h4>
                  <div class="tools"><a href="{$dwoo.session.sys.base_url}Atividades/Configurar/Midia/{$pic.id}" class="reload"></a></div>
                </div>
                <form id='frm_atividade'>
                <input type="hidden" name="insta_media_id" value="{$pic.id}">
                <input type="hidden" name="insta_user_id" value="{$pic.user.id}">
                <input type="hidden" name="id_user" value="{$dwoo.session.loginADM.id_user}">
                <div class="grid-body no-border"> <br>
                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-group">
                                <label class="form-label">Selecione um tipo</label>
                                <div class="controls">
                                        <div class="radio radio-success">
                                            <input id="tipo_instagram_1" onclick="hideHashtags()" type="radio" name="tipo" value="1" checked="checked">
                                            <label for="tipo_instagram_1">Curtir</label>
                                            <input id="tipo_instagram_2" onclick="showHashtags()" type="radio" name="tipo" value="2">
                                            <label for="tipo_instagram_2">Comentários</label>
                                        
                                        </div>
                                </div>
                          </div> 
                                   
                            
                              <div class="form-group">
                                <label class="form-label">Quantidade</label>
                                <div class="controls">
                                <h1 class="semi-bold" id='qtd_number'>{$limit_qtd}</h1>
                                  <input type="text" name='quantidade' id='sliderQTD'  class="slider-element form-control span12" data-slider-value="{$limit_qtd}" data-slider-step="1" data-slider-max="{$limit_qtd}" data-slider-orientation="horizontal" data-slider-selection="after" >
                                </div>
                              </div>
                              
                              <div class="form-group" id='field_hashtag' style="display:none;">
                                <label class="form-label">Hashtags</label>
                                <div class="controls">
                                  <input type="text" name='hashtags'   class="form-control span12 tagsinput" data-role="tagsinput" >
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <label class="form-label">Mídia Selecionada</label>
                                <div class="controls">
                                <input type="hidden" name='thumb' value="{$pic.images.standard_resolution.url}">
                                
                                    {if $pic}
                                    
                                        <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram_{$pic.id}'>
                                        <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                                          <div class="controller overlay right"></div>
                                        
                                          <div class="overlayer bottom-left fullwidth">
                                            <div class="overlayer-wrapper">
                                              <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                                              {if $pic.likes.count > 0}
                                                <a href="#" class="hashtags transparent">{$pic.likes.count} Likes </a>
                                              {/if}
                                              {if $pic.comments.count > 0}
                                                <a href="#" class="hashtags transparent">{$pic.comments.count} Comentários  </a>
                                              {/if}
                                               
                                                <p class="p-t-5 p-b-5 ">
                                                {if $pic.caption.text}
                                                    {$pic.caption.text}
                                                  {else}
                                                        ...    
                                                  {/if}
                                                </p>
                                              </div>
                                            </div>
                                          </div>
                                          <img id='pic_instagram_{$pic.id}' src="{$pic.images.standard_resolution.url}" data-src="{$pic.images.standard_resolution.url}" data-src-retina="{$pic.images.standard_resolution.url}" alt="" class="image-responsive-width hover-effect-img"> 
                                        </div>
                                        </div>
                                    {/if}   
                                
                                
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="controls">
                                  <button type="button" onclick="Save();" class="btn btn-success btn-cons">Salvar</button>
                                  <button type="button" onclick="Create('Atividades');" class="btn btn-primary btn-cons">Escolher Outra</button>
                                </div>
                              </div>   
                     </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
            
            {literal}
            <script type="text/javascript">
            var saveOn = 0;
            $(document).ready(function() {                
                    $(".select2").select2();
                    var sliderQTD =  $('#sliderQTD').slider().on('slide',AtualizaQuantidade).data('slider');
            
            });
        
        function showHashtags(){
        $("#field_hashtag").show();
        }
        function hideHashtags(){
        $("#field_hashtag").hide();
        }
       
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
            {/literal}