

<style type="text/css">


#previewDoc > img {
    width: 100%;
}
#fecharPreviewDoc{
    background-color: #EFEFEF;
    border: 1px solid #CCCCCC;
    color: #000000;
    font-size: 20px;
    font-weight: bold;
    padding: 10px;
    text-align: center;
    width: 100%;
}

</style>
<div id="previewDoc" style="display: none;">
    <div id="fecharPreviewDoc" class='fecharPreviewDoc'>FECHAR</div>
    <img id="img_preview_doc"  class='fecharPreviewDoc' src="">
    
</div>


 <script>
$(function() {
 
     $(".previewDOC").click(function(){
        var src = $(this).attr('src');
        $("#img_preview_doc").attr('src',src);
            $("#FrmDocumentos").hide();
        $("#previewDoc").show();

        
    });

    $(".fecharPreviewDoc").click(function(){
        $("#img_preview_doc").attr('src','');
        $("#previewDoc").hide();
        $("#FrmDocumentos").show();
    });
});
 
function enviaDocumentos(){
    $(".loading").show();
    $("#FrmDocumentos").ajaxForm({
        url: "Motoboy/ajaxSaveDocumentos",
        type:'post',
        dataType:  'json', 
        success: function(data) {
                 window.location.href = base_url+'Motoboy/View/{$id_motoboy}';
        }
    }).submit(); 
    

}
 
 
  function mudaStatusDocumento(id_documento,status){
     serial = 'id_documento='+id_documento+'&status='+status;
     $.post("Motoboy/ajaxMudaStatusDocumento", serial,
          function(data){
          if(data.status == true){
              switch(data.documento_status){
                      case '1':
                        $('#doc_'+id_documento+' .btn-danger').hide();
                        $('#doc_'+id_documento+' .btn-success').html('ACEITOU');
                      break;
                      case '3':
                        $('#doc_'+id_documento+' .btn-success').hide();
                        $('#doc_'+id_documento+' .btn-danger').html('RECUSOU');
                        
                      break;
                  }
               alertify.log( 'Status Alterado com sucesso!', 'success' );   
          }else{
                alertify.log( 'Erro ao processar! Tente novamente!', 'error' );  
          }
     }, "json");
      
      
      
  }
 
 </script> 

<form id='FrmDocumentos'>
<input type="hidden"  name='id_motoboy' value="{$id_motoboy}">
<table class="table table-striped">
        <thead>
            <tr>
              <th align="center">Tipo</th>
              <th align="center">Documento</th>
              <th align="center">Status</th>
            </tr>
        </thead>
        <tbody>
        
        {foreach $documentos documento}
          <tr id='doc_{$documento.id_documento}'>
                <td style='text-align:left !important'>{$documento.tipo}</td>
                {if $documento.caminho != ''}
                    <td style='text-align:left !important'>
                       {if $dwoo.session.loginADM.type >= 3 }
                           {if $documento.status == 0 }
                             <img src='{$documento.caminho}' style="width:100px;" class="previewDOC">
                             <input type='file' name='{$documento.tipo}'  onchange="readFile(this)">
                           {else}
                                 <div class='image_preview' style="width:100px;"><img src='{$documento.caminho}' style="width:100px;" class="previewDOC"></div>
                                  <input type='file' name='{$documento.tipo}'  onchange="readFile(this)">
                           {/if}  
                       {else}
                            {if $documento.status == 3}
                                 <div class='image_preview' style="width:100px;"><img src='{$documento.caminho}' style="width:100px;" class="previewDOC"></div>
                                 <input type='file' name='{$documento.tipo}'  onchange="readFile(this)">
                            {else}
                                <img src='{$documento.caminho}' style="width:100px;" class="previewDOC">
                            {/if}    
                      {/if}  
                    </td>  
                    <td style='text-align:left !important'>
                        {if $documento.status == 1}
                            <button class="btn btn-mini btn-success" id='btn_status_{$documento.id_documento}' type="button">ACEITOU</button>    
                        {elseif $documento.status == 2}
                            <button class="btn btn-mini btn-success" id='btn_status_{$documento.id_documento}' onclick='mudaStatusDocumento("{$documento.id_documento}","1")' type="button">ACEITAR</button>   
                            <button class="btn btn-mini btn-danger"  id='btn_status_{$documento.id_documento}' onclick='mudaStatusDocumento("{$documento.id_documento}","3")' type="button">RECUSAR</button>    
                        {elseif $documento.status == 0}
                            <button class="btn btn-mini" id='btn_status_{$documento.id_documento}' type="button">Não tem</button>   
                        {else}
                            <button class="btn btn-mini btn-danger" id='btn_status_{$documento.id_documento}' type="button">RECUSADO</button>   
                            
                        {/if}
                        <br />
                    </td>
                {else}
                
                    {if $dwoo.session.loginADM.type >= 3 }
                        <td style='text-align:left !important'>
                             <div class='image_preview' style="width:100px;"><img src='#' style="width:100px;" class="previewDOC"></div>
                             <input type='file' name='{$documento.tipo}'  onchange="readFile(this)">
                        
                        </td>
                        
                        <td style='text-align:left !important'>
                               <button class="btn btn-mini"  type="button">Não Enviou</button> 
                        
                        </td>
                    {else}
                        <td>&nbsp;</td>
                        <td>
                            <button class="btn btn-mini"  type="button">Não Enviou</button>   
                        </td>
                    {/if}
                {/if}
          </tr>
        {/foreach}  
        </tbody>      
      </table>
 </form>      
          