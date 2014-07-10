<table class="table table-striped" id='tbl_atividades'>
    <thead>
        <tr>
          <th>Nome</th>
          <th>Ação</th>
        </tr>
    </thead>
    <tbody>
     
    {foreach $atividadesProduto ap}
          <tr id='atividade-{$ap.id_produto_atividade}'>
            <td style=" text-transform: capitalize;text-align: left !important;">{$ap.nome}</td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiAtividadeProduto({$ap.id_produto_atividade})">Excluir</button></td>
          </tr>
    {/foreach}
    
    
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_Atividadees' class='form-inline'>   

              <select id='select_atividade' class="span9">
                {foreach $atividades atividade}
                    <option value='{$atividade.id_atividade}'>{$atividade.nome}</option>
                {/foreach}
              </select>
            <button type="button" class="btn  btn-success" onclick="adicionarAtividadeProduto({$produto.id_produto})">Adicionar</button></td>
</form>

<script type="text/javascript">

function adicionarAtividadeProduto(id_produto){
    id_atividade = $("#select_atividade").val();
    serial = "id_produto="+id_produto+'&id_atividade='+id_atividade;
    
    
     $.post("Produtos/ajaxSaveProdutoAtividade/",serial, 
          function(data){
          if(data.status == true){
             $("#tbl_atividades tbody").append(data.html); 
          }
          
     }, "json");
     
     
}
function excluiAtividadeProduto(id_produto_atividade){
    
    if (confirm("Tem certeza que deseja excluir esse Atividade?")){
        serial = "id_produto_atividade="+id_produto_atividade;

        $.post("Produtos/ajaxDeleteProdutoAtividade/",serial, 
        function(data){
                if(data.status == true){
                    $("#atividade-"+id_produto_atividade).remove();   
                }
        }, "json");
    }
    
}
</script>