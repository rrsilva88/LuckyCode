<table class="table table-striped" id='tbl_sabores'>
    <thead>
        <tr>
          <th>Cor</th>
          <th>Nome</th>
          <th>Ação</th>
          
        </tr>
    </thead>
    <tbody>
    
    {foreach $saboresProduto sp}
          <tr id='sabor-{$sp.id_produto_sabores}'>
            <td><div style="background-color: {$sp.cor}; border-radius: 10px; border: 10px solid {$sp.cor}; width: 20px; height: 20px;">&nbsp;</div></td>
            <td style=" text-transform: capitalize;text-align: left !important;">{$sp.nome}</td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiSaborProduto({$sp.id_produto_sabores})">Excluir</button></td>
          </tr>
    {/foreach}
    
      
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_sabores' class='form-inline'>   

              <select id='select_sabor' class="span9">
                {foreach $sabores sabor}
                    <option value='{$sabor.id_sabor}'>{$sabor.nome}</option>
                {/foreach}
                </select>
            <button type="button" class="btn  btn-success" onclick="adicionarSaborProduto({$produto.id_produto})">Adicionar</button></td>
</form>

<script type="text/javascript">

function adicionarSaborProduto(id_produto){
    id_sabor = $("#select_sabor").val();
    serial = "id_produto="+id_produto+'&id_sabor='+id_sabor;
    
     $.post("Produtos/ajaxSaveProdutoSabor/",serial, 
          function(data){
          if(data.status == true){
             $("#tbl_sabores tbody").append(data.html); 
          }
          
     }, "json");
     
     
}
function excluiSaborProduto(id_produto_sabores){
    
    if (confirm("Tem certeza que deseja excluir esse sabor?")){
        serial = "id_produto_sabores="+id_produto_sabores;

        $.post("Produtos/ajaxDeleteProdutoSabor/",serial, 
        function(data){
                if(data.status == true){
                    $("#sabor-"+id_produto_sabores).remove();   
                }
        }, "json");
    }
    
}
</script>