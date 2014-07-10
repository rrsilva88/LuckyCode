<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_sabor' value="<?php echo $this->scope["sabor"]["id_sabor"];?>">

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="<?php echo $this->scope["sabor"]["nome"];?>" name='nome' class="span12">
        </div>
  </div>

    <div class="control-group">
            <label class="control-label">Cor</label>
              <div class="controls">
                <div data-color-format="hex" data-color="<?php echo $this->scope["sabor"]["cor"];?>" class="input-append color colorpicker colorpicker-hex">
                  <input type="text" name='cor' value="<?php echo $this->scope["sabor"]["cor"];?>">
                  <span class="add-on"><i style="background-color: <?php echo $this->scope["sabor"]["cor"];?>;"></i></span>
                </div>
              </div>
          </div>
                  
 
</form>



<script type="text/javascript">




function UpdateSabor(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Sabores/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                 alertify.log( 'Atualizado com sucesso!', 'success' );  
                 window.location.href = "<?php echo $_SESSION['sys']['base_url'];?>Sabores/View/"+data.id;
            }else{
                alertify.log( 'Erro ao atualizar esse sabor!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>