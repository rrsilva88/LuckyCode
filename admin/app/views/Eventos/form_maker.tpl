<div>
    <div id='form_preview' style="background-color: #EFEFEF;border: 1px solid #CCCCCC;padding: 10px 30px;">
        <h2 {if !$preview}style='display:none;'{/if}>Preview</h2>
          {if $preview}{$preview}{/if}
    </div>
</div>
  
  

<br />  
<hr>
<h2>Criar Campo</h2>
<form class="form-horizontal" id='frm_maker'>
<input type='hidden' name='id_evento' value='{$evento.id_evento}'>
    <div class="control-group">
        <label class="control-label">Nome</label>
        <div class="controls">
            <input class="span7" name='nome' type="text" placeholder="Nome">
            
        </div>
    </div>

     <div class="control-group">
        <label class="control-label">Tipo</label>
        <div class="controls">
            <select name='type' id='frm_type' class="span7">
                <option value="input" >Texto</option>
                <option value="select" >Seleção</option>
                <option value="radio" >Radio</option>
                <option value="checkbox" >Checkbox</option>
            </select>
            
        </div>
    </div>
    
    <div class="control-group" id='params' style="display:none;">
        <label class="control-label">Parâmetros</label>
        <div class="controls">
            <input class="span7" type="text" name='params' placeholder="">
            <span class="help-inline">Separar com virgula(,)</span>
        </div>
    </div>
    
    <!--div class="control-group">
        <label class="control-label">Máscara</label>
        <div class="controls">
           <select name='mascara' class="span7">
                <option value="">Sem Máscara</option>
                <option value="tel">Telefone</option>
                <option value="data">Data (11/11/1111)</option>
            </select>
            
        </div>
    </div-->

     
    
</form>

<script type="text/javascript">

 $(function() {
    $("#frm_type").change(function(){
      if($("#frm_type").val() == 'input'){
          $("#params").hide();
      }else{
          $("#params").show();    
      }  
        
    }); 
     
     
 });

function AdicionarCampo(){
     serial = $("#frm_maker").serialize();
     $.post("Eventos/ajaxAdicionarCampo/",serial, 
          function(data){
          if(data.status == true){
              $("#form_preview h2").show();
              $("#form_preview").append(data.html);
          }
          
     }, "json");
     
     
}
function excluiCampoEvento(id_evento_form){
    
    if (confirm("Tem certeza que deseja excluir esse campo?")){
        
        
        
        serial = "id_evento_form="+id_evento_form;

        $.post("Eventos/ajaxDeleteCampoEvento/",serial, 
        function(data){
                if(data.status == true){
                    $("#campo-"+id_evento_form).remove();   
                }
        }, "json");
    }
    
}
</script>