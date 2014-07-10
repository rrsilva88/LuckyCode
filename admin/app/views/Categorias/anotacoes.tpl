
              <div class="widget-comments clearfix slimscroll">
              
                <ul id='lista_anotacoes'>
                 {if $anotacoes}  
                     {foreach $anotacoes anotacao}
                          <li>
                            <div class="comment-bubble">
                              <h4>{$anotacao.assunto} - <strong>{$anotacao.nome}</strong></h4>
                              {$anotacao.mensagem}
                              <div class="date">{$anotacao.data}</div>
                              
                            </div>
                          </li>
                      {/foreach}
                  {/if}
                </ul>
              </div>
               
              
              
              
<div id="example_modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id='frm_anotacao'>
    <input type='hidden' value='{$id_motoboy}' name='id_motoboy'>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Criar Anotação</h3>
      </div>
      <div class="modal-body">
       
       <div class="control-group">
          <label class="control-label">Assunto</label>
          <div class="controls">
            <!--input type="text" placeholder="Digite um assunto..." id="an_assunto" name='assunto'  style="width: 525px;"-->
            <select name='assunto'>
                <option value='Documentos'>Documentos</option>
                <option value='Aplicativo'>Aplicativo</option>
                <option value='DDD'>DDD</option>
                <option value='Sem interesse'>Sem interesse</option>
            </select>
          </div>
        </div>
        
        <div class="control-group">
          <label class="control-label">Mensagem</label>
          <div class="controls">
            <textarea  id="an_mensagem" placeholder="Digite sua mensagem..." name='mensagem'  style="width: 525px; height: 200px;"></textarea>
          </div>
        </div>
       
       
       
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal"  type="button"  aria-hidden="true">Fechar</button>
        <button class="btn btn-primary" data-dismiss="modal"  type="button"  aria-hidden="true" onclick='salvaAnotacao();'>Salvar</button>
      </div>
</form>      
    </div> 
    
 <script type="text/javascript">
 
 function salvaAnotacao(){
         $(".loading").show();
         var serial = $("#frm_anotacao").serialize();
         $.post("Motoboy/ajaxSaveAnotacao", serial,
          function(data){
              $("#an_assunto").val('');
              $("#an_mensagem").val('');
         
              console.log(data);
              
          if(data.status == true){
              
              var li = $("<li>").prependTo("#lista_anotacoes");
                var div = $("<div>").addClass('comment-bubble').html(data.data.mensagem).appendTo(li);
                    var divDate = $("<div>").addClass('date').html(data.data.data).appendTo(div);
                    var h4  = $("<h4>").html(data.data.assunto+' - <strong>'+data.data.nome+'</strong>').prependTo(div)
              
              
               alertify.log( 'Anotação realizada com sucesso!', 'success' );   
          }else{
                alertify.log( 'Erro ao processar! Tente novamente!', 'error' );  
          }
          
          $(".loading").hide();
          
          
     }, "json");
          
          
         return false;
 }
 </script>   