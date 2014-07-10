<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_menu' value="<?php echo $this->scope["menu"]["id_menu"];?>">


<div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          <select name='status' class="span12">
            <option value="0" <?php if ((isset($this->scope["menu"]["status"]) ? $this->scope["menu"]["status"]:null) == 0) {
?>SELECTED="SELECTED"<?php 
}?>>Inativo</option>
            <option value="1" <?php if ((isset($this->scope["menu"]["status"]) ? $this->scope["menu"]["status"]:null) == 1) {
?>SELECTED="SELECTED"<?php 
}?>>Ativo</option>
         
          </select>
          
        </div>
  </div>

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="<?php echo $this->scope["menu"]["nome"];?>" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Alias" value="<?php echo $this->scope["menu"]["alias"];?>"  readonly='readonly' class="span12">
        </div>
  </div>
  
  
  
  <div class="control-group">
    <label class="control-label">Foto Background</label>
        <div class="controls">
         <div class='image_preview'>
          <?php if ((isset($this->scope["menu"]["foto_banner"]) ? $this->scope["menu"]["foto_banner"]:null) != '') {
?>
            <img src="<?php echo $_SESSION['sys']['base'];?>assets/images/produtos/<?php echo $this->scope["menu"]["foto_banner"];?>" alt="<?php echo $this->scope["menu"]["nome"];?>" style='width:250px;'>
          <?php 
}?>

        </div>
          <br />
          <input type="file" name='foto' onchange="readFile(this)"> 
        </div>
  </div>
  
  
 
  <div class="control-group">
    <label class="control-label">RAIZ</label>
        <div class="controls">
          <select name='id_parent' class="span12">
          <option value="0">HOME</option>
          <?php 
$_fh0_data = (isset($this->scope["listaMenu"]) ? $this->scope["listaMenu"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['lista'])
	{
/* -- foreach start output */
?>
            <option value="<?php echo $this->scope["lista"]["id_menu"];?>" <?php if ((isset($this->scope["menu"]["id_parent"]) ? $this->scope["menu"]["id_parent"]:null) == (isset($this->scope["lista"]["id_menu"]) ? $this->scope["lista"]["id_menu"]:null)) {
?>SELECTED="SELECTED"<?php 
}?>>HOME > <?php echo $this->scope["lista"]["nome"];?></option>  
          <?php 
/* -- foreach end output */
	}
}?>

          </select>
          
        </div>
  </div>
  
  
 
</form>



<script type="text/javascript">


   function readFile(input){
        var nm_file = $(input).val();
        var regex = /(jpg|jpeg|png|gif)$/i;
        match = regex.exec(nm_file);
        if(match != null){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $('<img>').attr('src', e.target.result).attr('style','width: 250px ! important;');
                    $(input).parent().find('.image_preview').html(img);
                    //$()
                }
                reader.readAsDataURL(input.files[0]);
            }
              
        }else{
          $(input).val('');
          alert('Só e permitido enviar arquivos com extensão (.jpg/.jpeg/.png/.gif)');
        }
}



function UpdateMenu(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Menu/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                window.location.href = "<?php echo $_SESSION['sys']['base_url'];?>Menu/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar esse menu!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>