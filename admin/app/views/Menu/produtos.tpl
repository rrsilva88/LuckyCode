<table class="table table-striped" id='tbl_produtos' width="100%">
    <thead>
        <tr>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Ação</th>
        </tr>
    </thead>
    <tbody>
    
    {foreach $ListaProdutos lp}
          <tr id='menu-produto-{$lp.id_menu_produto}'>
            <td>{$lp.produto_nome}</td>
            <td style=" text-transform: capitalize;text-align: left !important;">{if $lp.categoria_root == ''} HOME {else} {$lp.categoria_root} {/if} > {$lp.categoria}</td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiProdutoMenu({$lp.id_menu_produto})">Excluir</button></td>
          </tr>
    {/foreach}
    
      
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_sabores' class='form-inline'>   

              <select id='select_produto' class="span9">
                {foreach $produtos produto}
                    <option value='{$produto.id_produto}'>
                        {if $produto.categoria_root == ''} HOME {else} {$produto.categoria_root} {/if} >
                        {$produto.categoria} >
                        {$produto.nome}
                    </option>
                {/foreach}
                </select>
            <button type="button" class="btn  btn-success" onclick="adicionarProdutoMenu({$produto.id_produto})">Adicionar</button></td>
</form>

<script type="text/javascript">

function adicionarProdutoMenu(id_produto){
    id_sabor = $("#select_produto").val();
    serial = "id_menu={$menu.id_menu}&id_produto="+id_sabor;
    $.post("Menu/ajaxSaveProdutoMenu/",serial, 
          function(data){
          if(data.status == true){
             $("#tbl_produtos tbody").append(data.html); 
          }
     }, "json");
     
     
}
function excluiProdutoMenu(id_menu_produto){
    
    if (confirm("Tem certeza que deseja excluir essa relação?")){
        serial = "id_menu_produto="+id_menu_produto;

        $.post("Menu/ajaxDeleteProdutoMenu/",serial, 
        function(data){
                if(data.status == true){
                    $("#menu-produto-"+id_menu_produto).remove();   
                }
        }, "json");
    }
    
}
</script>