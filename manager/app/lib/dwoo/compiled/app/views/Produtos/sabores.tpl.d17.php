<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><table class="table table-striped" id='tbl_sabores'>
    <thead>
        <tr>
          <th>Cor</th>
          <th>Nome</th>
          <th>Ação</th>
          
        </tr>
    </thead>
    <tbody>
    
    <?php 
$_fh0_data = (isset($this->scope["saboresProduto"]) ? $this->scope["saboresProduto"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['sp'])
	{
/* -- foreach start output */
?>
          <tr id='sabor-<?php echo $this->scope["sp"]["id_produto_sabores"];?>'>
            <td><div style="background-color: <?php echo $this->scope["sp"]["cor"];?>; border-radius: 10px; border: 10px solid <?php echo $this->scope["sp"]["cor"];?>; width: 20px; height: 20px;">&nbsp;</div></td>
            <td style=" text-transform: capitalize;text-align: left !important;"><?php echo $this->scope["sp"]["nome"];?></td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiSaborProduto(<?php echo $this->scope["sp"]["id_produto_sabores"];?>)">Excluir</button></td>
          </tr>
    <?php 
/* -- foreach end output */
	}
}?>

    
      
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_sabores' class='form-inline'>   

              <select id='select_sabor' class="span9">
                <?php 
$_fh1_data = (isset($this->scope["sabores"]) ? $this->scope["sabores"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['sabor'])
	{
/* -- foreach start output */
?>
                    <option value='<?php echo $this->scope["sabor"]["id_sabor"];?>'><?php echo $this->scope["sabor"]["nome"];?></option>
                <?php 
/* -- foreach end output */
	}
}?>

                </select>
            <button type="button" class="btn  btn-success" onclick="adicionarSaborProduto(<?php echo $this->scope["produto"]["id_produto"];?>)">Adicionar</button></td>
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
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>