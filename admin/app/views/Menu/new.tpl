<form id='frm_motoboy' class='formAjax'>
 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" name='nome' class="span12">
        </div>
  </div>
  
  
  <div class="control-group">
    <label class="control-label">Foto Background</label>
        <div class="controls">
        <div class='image_preview'>
         
         
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
          {foreach $menus menu}
            <option value="{$menu.id_menu}">HOME > {$menu.nome}</option>  
          {/foreach}
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




function SaveMenu(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Menu/ajaxSave",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                 window.location.href = "{$dwoo.session.sys.base_url}Menu/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar essa categoria!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script>