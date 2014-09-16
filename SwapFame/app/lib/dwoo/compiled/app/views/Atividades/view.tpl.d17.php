<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4><b>Atividade #<?php echo $this->scope["atividade"]["id_atividade"];?></b></h4>
                  <div class="tools">
                      <span>Status:<b>
                        <?php if ((isset($this->scope["atividade"]["status"]) ? $this->scope["atividade"]["status"]:null) == 1) {
?><span class=" label-info" style="padding:5px;border-radius:5px;"> Ativo (na fila) </span><?php 
}?>

                        <?php if ((isset($this->scope["atividade"]["status"]) ? $this->scope["atividade"]["status"]:null) == 2) {
?><span class="label-warning" style="padding:5px;border-radius:5px;"> Processando </span><?php 
}?>

                        <?php if ((isset($this->scope["atividade"]["status"]) ? $this->scope["atividade"]["status"]:null) == 3) {
?><span class=" label-success" style="padding:5px;border-radius:5px;"> Concluída </span><?php 
}?>

                        <?php if ((isset($this->scope["atividade"]["status"]) ? $this->scope["atividade"]["status"]:null) == 4) {
?><span class="label-important" style="padding:5px;border-radius:5px;"> Cancelada </span><?php 
}?>

                      
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
                                        <?php if ((isset($this->scope["atividade"]["tipo"]) ? $this->scope["atividade"]["tipo"]:null) == 1) {
?>Curtir<?php 
}?>

                                        <?php if ((isset($this->scope["atividade"]["tipo"]) ? $this->scope["atividade"]["tipo"]:null) == 2) {
?>Comentários<?php 
}?>

                                        <?php if ((isset($this->scope["atividade"]["tipo"]) ? $this->scope["atividade"]["tipo"]:null) == 3) {
?>Seguidores<?php 
}?>

                                    </b></label>
                                <div class="controls">
                                    
                                </div>
                          </div> 
                                   
                            
                              <div class="form-group">
                                <label class="form-label">Quantidade:<b  id='qtd_number'><?php if ((isset($this->scope["atividade"]["quantidade"]) ? $this->scope["atividade"]["quantidade"]:null)) {

echo $this->scope["atividade"]["quantidade"];

}?></b></label>
                                <div class="controls">
                                    
                                </div>
                              </div>
                              
                              
                              <div class="form-group">
                                <label class="form-label"><?php if ((isset($this->scope["atividade"]["tipo"]) ? $this->scope["atividade"]["tipo"]:null) < 3) {
?>Mídia selecionada<?php 
}
if ((isset($this->scope["atividade"]["tipo"]) ? $this->scope["atividade"]["tipo"]:null) == 3) {
?>Perfil selecionado<?php 
}?></label>
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
                                          <img id='pic_instagram' src="<?php echo $this->scope["atividade"]["thumb"];?>" data-src="<?php echo $this->scope["atividade"]["thumb"];?>" data-src-retina="<?php echo $this->scope["atividade"]["thumb"];?>" alt="" class="image-responsive-width hover-effect-img"> 
                                        </div>
                                        </div>
                                       
                                
                                
                                </div>
                              </div>
                              <div class="clearfix"></div>
                              <div class="form-group">
                                <div class="controls">
                                  <a href="<?php echo $_SESSION['sys']['base_url'];?>Atividades/"  class="btn btn-success btn-cons">Voltar</a>
                                </div>
                              </div>   
                     </div>
                      <div class="col-md-6 col-sm-6 col-xs-6">
                        
                        
                        <?php if ((isset($this->scope["logs"]) ? $this->scope["logs"] : null)) {
?> 
                        
                        
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
                            <?php 
$_fh0_data = (isset($this->scope["logs"]) ? $this->scope["logs"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['log'])
	{
/* -- foreach start output */
?>
                                <tr>
                                    <td><?php echo $this->scope["log"]["id_log_atividade"];?></td>
                                    <td><?php echo $this->scope["log"]["usuario"];?></td>
                                    <td><?php echo $this->scope["log"]["data"];?></td>
                                    
                                </tr>
                            <?php 
/* -- foreach end output */
	}
}?>    
                            </tbody>
                        </table>
                        <br>
                        (*) lista apenas as últimas 10 interações.
                        <?php 
}
else {
?>
                             <h2>Aviso:</h2>
                            <h3><b>Essa atividade ainda não foi iniciada, aguarde alguns momentos pois ela se encontra na fila de atividades.</b></h3>
                        <?php 
}?>

                        <?php if ((isset($this->scope["percent"]) ? $this->scope["percent"] : null)) {
?>
                            <Br/>
                            <h2>Processo em <?php echo $this->scope["percent"];?>%</h2>  
                        <?php 
}?>

                     </div>
                     
                  </div>
                </div>
                </form>
              </div>
            </div>
            
            
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
            <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>