<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><table class="table table-striped" id='tbl_atividades'>
    <thead>
        <tr>
          <th>Nome</th>
          <th>Ação</th>
        </tr>
    </thead>
    <tbody>
     
    <?php 
$_fh0_data = (isset($this->scope["atividadesProduto"]) ? $this->scope["atividadesProduto"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['ap'])
	{
/* -- foreach start output */
?>
          <tr id='atividade-<?php echo $this->scope["ap"]["id_produto_atividade"];?>'>
            <td style=" text-transform: capitalize;text-align: left !important;"><?php echo $this->scope["ap"]["nome"];?></td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiAtividadeProduto(<?php echo $this->scope["ap"]["id_produto_atividade"];?>)">Excluir</button></td>
          </tr>
    <?php 
/* -- foreach end output */
	}
}?>

    
    
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_Atividadees' class='form-inline'>   

              <select id='select_atividade' class="span9">
                <?php 
$_fh1_data = (isset($this->scope["atividades"]) ? $this->scope["atividades"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['atividade'])
	{
/* -- foreach start output */
?>
                    <option value='<?php echo $this->scope["atividade"]["id_atividade"];?>'><?php echo $this->scope["atividade"]["nome"];?></option>
                <?php 
/* -- foreach end output */
	}
}?>

              </select>
            <button type="button" class="btn  btn-success" onclick="adicionarAtividadeProduto(<?php echo $this->scope["produto"]["id_produto"];?>)">Adicionar</button></td>
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
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>