<form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_menu' value="{$menu.id_menu}">


<div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          <select name='status' class="span12">
            <option value="0" {if $menu.status == 0}SELECTED="SELECTED"{/if}>Inativo</option>
            <option value="1" {if $menu.status == 1}SELECTED="SELECTED"{/if}>Ativo</option>
         
          </select>
          
        </div>
  </div>

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="{$menu.nome}" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Alias" value="{$menu.alias}"  readonly='readonly' class="span12">
        </div>
  </div>
  
  
  
  <div class="control-group">
    <label class="control-label">Foto Background</label>
        <div class="controls">
         <div class='image_preview'>
          {if $menu.foto_banner != ''}
            <img src="{$dwoo.session.sys.base}assets/images/produtos/{$menu.foto_banner}" alt="{$menu.nome}" style='width:250px;'>
          {/if}
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
          {foreach $listaMenu lista}
            <option value="{$lista.id_menu}" {if $menu.id_parent == $lista.id_menu}SELECTED="SELECTED"{/if}>HOME > {$lista.nome}</option>  
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



function UpdateMenu(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Menu/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                window.location.href = "{$dwoo.session.sys.base_url}Menu/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar esse menu!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script>