<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><form id='frm_motoboy' class='formAjax'>
 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
          <input type="text" placeholder="Descrição"  name='descricao' class="span12">
        </div>
  </div>
   
  
 
  <div class="control-group">
    <label class="control-label">RAIZ</label>
        <div class="controls">
          <select name='id_parent' class="span12">
          <option value="0">HOME</option>
          <?php 
$_fh0_data = (isset($this->scope["categorias"]) ? $this->scope["categorias"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['categoria'])
	{
/* -- foreach start output */
?>
            <option value="<?php echo $this->scope["categoria"]["id_categoria"];?>">HOME > <?php echo $this->scope["categoria"]["nome"];?></option>  
          <?php 
/* -- foreach end output */
	}
}?>

          </select>
          
        </div>
  </div>
  
  
 
</form>



<script type="text/javascript">

   


function SaveCategoria(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Categorias/ajaxSave",
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