<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_categoria' value="<?php echo $this->scope["categoria"]["id_categoria"];?>">


<div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          <select name='status' class="span12">
            <option value="0" <?php if ((isset($this->scope["categoria"]["status"]) ? $this->scope["categoria"]["status"]:null) == 0) {
?>SELECTED="SELECTED"<?php 
}?>>Inativo</option>
            <option value="1" <?php if ((isset($this->scope["categoria"]["status"]) ? $this->scope["categoria"]["status"]:null) == 1) {
?>SELECTED="SELECTED"<?php 
}?>>Ativo</option>
         
          </select>
          
        </div>
  </div>

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="<?php echo $this->scope["categoria"]["nome"];?>" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Alias" value="<?php echo $this->scope["categoria"]["alias"];?>"  readonly='readonly' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
          <input type="text" placeholder="Descrição" value="<?php echo $this->scope["categoria"]["descricao"];?>"   name='descricao' class="span12">
        </div>
  </div>
          
  
 
  <div class="control-group">
    <label class="control-label">RAIZ</label>
        <div class="controls">
          <select name='id_parent' class="span12">
          <option value="0">HOME</option>
          <?php 
$_fh0_data = (isset($this->scope["listaCategorias"]) ? $this->scope["listaCategorias"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['cat'])
	{
/* -- foreach start output */
?>
            <option value="<?php echo $this->scope["cat"]["id_categoria"];?>" <?php if ((isset($this->scope["categoria"]["id_parent"]) ? $this->scope["categoria"]["id_parent"]:null) == (isset($this->scope["cat"]["id_categoria"]) ? $this->scope["cat"]["id_categoria"]:null)) {
?>SELECTED="SELECTED"<?php 
}?>>HOME > <?php echo $this->scope["cat"]["nome"];?></option>  
          <?php 
/* -- foreach end output */
	}
}?>

          </select>
          
        </div>
  </div>
  
  
 
</form>



<script type="text/javascript">




function UpdateCategoria(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Categorias/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                 window.location.href = "<?php echo $_SESSION['sys']['base_url'];?>Categorias/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar essa categoria!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>