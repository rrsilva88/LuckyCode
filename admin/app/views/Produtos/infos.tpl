<table class="table table-striped" id='tbl_infos'>
    <thead>
        <tr>
          <th>Nome</th>
          <th>QTD</th>
          <th>VD %</th>
          <th>Ação</th>
        </tr>
    </thead>
    <tbody>
    
     {foreach $infosProduto ip}
          <tr id='info-{$ip.id_produto_info}'>
            <td style=" text-transform: capitalize;text-align: left !important;">{$ip.nome}</td>
            <td style=" text-transform: capitalize;text-align: left !important;">{$ip.valor_quantidade}</td>
            <td style=" text-transform: capitalize;text-align: left !important;">{$ip.valor_vd}</td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiInfosProduto({$ip.id_produto_info})">Excluir</button></td>
          </tr>
    {/foreach}
    
    
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_Atividadees' class='form-inline'>   

              <input type="text" placeholder='Nome' id='atividade_nome' class="span5">
              <input type="text" placeholder='QTD' id='atividade_qtd' class="span2">
              <input type="text" placeholder='VD %' id='atividade_vd' class="span2">
                
            <button type="button" class="btn  btn-success" onclick="adicionarInfosProduto({$produto.id_produto})">Adicionar</button></td>
</form>

<script type="text/javascript">

function adicionarInfosProduto(id_produto){
    atividade_nome = $("#atividade_nome").val();
    atividade_qtd = $("#atividade_qtd").val();
    atividade_vd = $("#atividade_vd").val();
    serial = "id_produto="+id_produto+'&nome='+atividade_nome+'&valor_quantidade='+atividade_qtd+'&valor_vd='+atividade_vd;
    $.post("Produtos/ajaxSaveProdutoInfo/",serial, 
          function(data){
          if(data.status == true){
             $("#tbl_infos tbody").append(data.html); 
              $("#atividade_nome").val('');
              $("#atividade_qtd").val('');
              $("#atividade_vd").val('');
             
             
          }
          
    }, "json");
     
     
}
function excluiInfosProduto(id_produto_info){
    
    if (confirm("Tem certeza que deseja excluir esse Atividade?")){
        serial = "id_produto_info="+id_produto_info;

        $.post("Produtos/ajaxDeleteProdutoInfo/",serial, 
        function(data){
                if(data.status == true){
                    $("#info-"+id_produto_info).remove();   
                }
        }, "json");
    }
    
}
</script>