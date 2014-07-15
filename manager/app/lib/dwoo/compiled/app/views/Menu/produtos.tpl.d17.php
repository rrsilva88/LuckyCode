<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><table class="table table-striped" id='tbl_produtos' width="100%">
    <thead>
        <tr>
          <th>Nome</th>
          <th>Categoria</th>
          <th>Ação</th>
        </tr>
    </thead>
    <tbody>
    
    <?php 
$_fh0_data = (isset($this->scope["ListaProdutos"]) ? $this->scope["ListaProdutos"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['lp'])
	{
/* -- foreach start output */
?>
          <tr id='menu-produto-<?php echo $this->scope["lp"]["id_menu_produto"];?>'>
            <td><?php echo $this->scope["lp"]["produto_nome"];?></td>
            <td style=" text-transform: capitalize;text-align: left !important;"><?php if ((isset($this->scope["lp"]["categoria_root"]) ? $this->scope["lp"]["categoria_root"]:null) == '') {
?> HOME <?php 
}
else {
?> <?php echo $this->scope["lp"]["categoria_root"];?> <?php 
}?> > <?php echo $this->scope["lp"]["categoria"];?></td>
            <td><button type="button" class="btn btn-mini btn-danger" onclick="excluiProdutoMenu(<?php echo $this->scope["lp"]["id_menu_produto"];?>)">Excluir</button></td>
          </tr>
    <?php 
/* -- foreach end output */
	}
}?>

    
      
    </tbody>      
  </table>
  
  

<br />  
<form id='frm_sabores' class='form-inline'>   

              <select id='select_produto' class="span9">
                <?php 
$_fh1_data = (isset($this->scope["produtos"]) ? $this->scope["produtos"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['produto'])
	{
/* -- foreach start output */
?>
                    <option value='<?php echo $this->scope["produto"]["id_produto"];?>'>
                        <?php if ((isset($this->scope["produto"]["categoria_root"]) ? $this->scope["produto"]["categoria_root"]:null) == '') {
?> HOME <?php 
}
else {
?> <?php echo $this->scope["produto"]["categoria_root"];?> <?php 
}?> >
                        <?php echo $this->scope["produto"]["categoria"];?> >
                        <?php echo $this->scope["produto"]["nome"];?>

                    </option>
                <?php 
/* -- foreach end output */
	}
}?>

                </select>
            <button type="button" class="btn  btn-success" onclick="adicionarProdutoMenu(<?php echo $this->scope["produto"]["id_produto"];?>)">Adicionar</button></td>
</form>

<script type="text/javascript">

function adicionarProdutoMenu(id_produto){
    id_sabor = $("#select_produto").val();
    serial = "id_menu=<?php echo $this->scope["menu"]["id_menu"];?>&id_produto="+id_sabor;
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
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>