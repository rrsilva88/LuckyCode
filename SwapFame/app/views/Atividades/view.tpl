<div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4><b>Atividade #{$atividade.id_atividade}</b></h4>
                  <div class="tools">
                      <span>Status:<b>
                        {if $atividade.status == 1}<span class=" label-info" style="padding:5px;border-radius:5px;"> Ativo (na fila) </span>{/if}
                        {if $atividade.status == 2}<span class="label-warning" style="padding:5px;border-radius:5px;"> Processando </span>{/if}
                        {if $atividade.status == 3}<span class=" label-success" style="padding:5px;border-radius:5px;"> Concluída </span>{/if}
                        {if $atividade.status == 4}<span class="label-important" style="padding:5px;border-radius:5px;"> Cancelada </span>{/if}
                      
                      </b></span>  
                  
                  </div>
                </div>
                <form id='frm_atividade'>
                    <div class="grid-body no-border"> <br>
                    <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                      <h2>Dados Atividade</h2>  
                          <div class="form-group">
                                <label class="form-label">Tipo: <b>
                                        {if $atividade.tipo == 1}Curtir{/if}
                                        {if $atividade.tipo == 2}Comentários{/if}
                                        {if $atividade.tipo == 3}Seguidores{/if}
                                    </b></label>
                                <div class="controls">
                                    
                                </div>
                          </div> 
                                   
                            
                              <div class="form-group">
                                <label class="form-label">Quantidade:<b  id='qtd_number'>{if $atividade.quantidade}{$atividade.quantidade}{/if}</b></label>
                                <div class="controls">
                                    
                                </div>
                              </div>
                              
                              
                              <div class="form-group">
                                <label class="form-label">{if $atividade.tipo < 3 }Mídia selecionada{/if}{if $atividade.tipo == 3}Perfil selecionado{/if}</label>
                                <div class="controls">
                                        <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram'>
                                        <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                                          <div class="controller overlay right"></div>
                                        
                                          <div class="overlayer bottom-left fullwidth">
                                            <div class="overlayer-wrapper">
                                              <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                                                <p class="p-t-5 p-b-5 ">
                                                </p>
                                              </div>
                                            </div>
                                          </div>
                                          <img id='pic_instagram' src="{$atividade.thumb}" data-src="{$atividade.thumb}" data-src-retina="{$atividade.thumb}" alt="" class="image-responsive-width hover-effect-img"> 
                                        </div>
                                        </div>
                                       
                                
                                
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="controls">
                                  <a href="{$dwoo.session.sys.base_url}Atividades/"  class="btn btn-success btn-cons">Voltar</a>
                                </div>
                              </div>   
                     </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        
                        
                        {if $logs} 
                        
                        
                        <h2>Estatísticas</h2>
                        <table class="table table-hover no-more-tables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Usuário</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach $logs log}
                                <tr>
                                    <td>{$log.id_log_atividade}</td>
                                    <td>{$log.usuario}</td>
                                    <td>{$log.data}</td>
                                    
                                </tr>
                            {/foreach}    
                            </tbody>
                        </table>
                        <br>
                        (*) lista apenas as últimas 10 interações.
                        {else}
                             <h2>Aviso:</h2>
                            <h3><b>Essa atividade ainda não foi iniciada, aguarde alguns momentos pois ela se encontra na fila de atividades.</b></h3>
                        {/if}
                        {if $percent}
                            <Br/>
                            <h2>Processo em {$percent}%</h2>  
                        {/if}
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
                    //$(".select2").select2();
                    //var sliderQTD =  $('#sliderQTD').slider().on('slide',AtualizaQuantidade).data('slider');
            
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
            {/literal}