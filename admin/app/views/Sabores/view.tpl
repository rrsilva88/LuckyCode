<form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_sabor' value="{$sabor.id_sabor}">

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="{$sabor.nome}" name='nome' class="span12">
        </div>
  </div>

    <div class="control-group">
            <label class="control-label">Cor</label>
              <div class="controls">
                <div data-color-format="hex" data-color="{$sabor.cor}" class="input-append color colorpicker colorpicker-hex">
                  <input type="text" name='cor' value="{$sabor.cor}">
                  <span class="add-on"><i style="background-color: {$sabor.cor};"></i></span>
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
                 window.location.href = "{$dwoo.session.sys.base_url}Sabores/View/"+data.id;
            }else{
                alertify.log( 'Erro ao atualizar esse sabor!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script>