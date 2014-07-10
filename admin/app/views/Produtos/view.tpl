<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<form id='frm_motoboy' class='frm_motoboy'>   


<div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          <select name='status' class="span12">
            <option value="0" {if $produto.status == 0}SELECTED="SELECTED"{/if}>Inativo</option>
            <option value="1" {if $produto.status == 1}SELECTED="SELECTED"{/if}>Ativo</option>
         
          </select>
          
        </div>
  </div>

<div class="control-group">
    <label class="control-label">Prioridade</label>
        <div class="controls">
          <select name='prioridade' class="span12">
            <option value="0" {if $produto.prioridade == 0}SELECTED="SELECTED"{/if}>Normal</option>
            <option value="1" {if $produto.prioridade == 1}SELECTED="SELECTED"{/if}>Destacar</option>
         
          </select>
          
        </div>
  </div>


<div class="control-group">
        <label class="control-label">Categoria</label>
        <div class="controls">
          <select name='id_categoria' class="span12">
          {foreach $categorias categoria}
            <option value="{$categoria.id_categoria}" {if $categoria.id_categoria == $produto.id_categoria}SELECTED="SELECTED"{/if} >
            {if $categoria.parent != ''} {$categoria.parent} {else} HOME {/if} > {$categoria.nome}</option>  
          {/foreach}
          </select>
        </div>
  </div>     

            

<div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="hidden" value='{$produto.id_produto}' name='id_produto' class="span10">
          <input type="text" value='{$produto.nome}' placeholder="Nome" value='' name='nome' class="span10">
        </div>
  </div>    
  
<div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" value='{$produto.alias}' placeholder="alias"  class="span10">
        </div>
  </div>    
  
  <div class="control-group">
    <label class="control-label">Apresentação</label>
        <div class="controls">
          <input type="text" placeholder="Apresentação" value='{$produto.apresentacao}' name='apresentacao' class="span12">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Tipo</label>
        <div class="controls">
          <input type="text" placeholder="Tipo" value='{$produto.tipo}' name='tipo' class="span12">
        </div>
  </div>
  
 
  <div class="control-group">
    <label class="control-label">Foto</label>
        <div class="controls">
         <div class='image_preview'>
          {if $produto.foto_produto != ''}
            <img src="{$dwoo.session.sys.base}assets/images/produtos/{$produto.foto_produto}" alt="{$produto.nome}" style='width:250px;'>
          {/if}
        </div>
          <br />
          <input type="file" name='foto' onchange="readFile(this)"> 
        </div>
  </div>
  
  
  <div class="clear"></div>
                     
  
  
<div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
            <textarea id="editor1" name="descricao" rows="100" cols="80">{$produto.descricao}</textarea>
        </div>
  </div>
  
  
  
  
<div class="control-group">
    <label class="control-label">Informações Nutricionais</label>
        <div class="controls">
          <input type="text" name='info_nutricional' value='{$produto.info_nutricional}' placeholder="Exemplo: Porção de 38g (2 medidas)"  class="span10">
        </div>
  </div>    
  
  
  
  
 
  <div class="control-group">
    <label class="control-label">Ficha Tecnica</label>
        <div class="controls">
         <div class='image_preview'>
          {if $produto.ficha_tecnica != ''}
            <a href="{$dwoo.session.sys.base}assets/images/produtos/{$produto.ficha_tecnica}" target='_blank' alt="{$produto.nome}" style='width:250px;'>Arquivo Ficha Tecnica</a>
          {/if}
        </div>
          <br />
          <input type="file" name='ficha_tecnica'> 
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



function UpdateProduto(){
    $(".loading").show();
      for (instance in CKEDITOR.instances) {
    CKEDITOR.instances[instance].updateElement();
}
     $(".frm_motoboy").ajaxForm({
        url: "Produtos/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            console.log(data);
            if(data.status == true){
                alertify.log( 'SUCCESS!', 'success' );  
                window.location.href = base_url+'Produtos/View/'+data.id;
            }else{
                alertify.log( 'Erro tente novamente!', 'error' );  
            }
        }
    }).submit(); 
    
}

// This is a check for the CKEditor class. If not defined, the paths must be checked.
if ( typeof CKEDITOR == 'undefined' )
{
    document.write(
        'Editor não foi carregado com sucesso!<br /> Por favor recarregue a pagina!' ) ;
}
else
{
var editor = CKEDITOR.replace( 'editor1',
 {
     filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
     filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
     filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
     filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
     filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
     filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
 } 
 );


    // Just call CKFinder.setupCKEditor and pass the CKEditor instance as the first argument.
    // The second parameter (optional), is the path for the CKFinder installation (default = "/ckfinder/").
    CKFinder.setupCKEditor( editor, '../' ) ;

    // It is also possible to pass an object with selected CKFinder properties as a second argument.
    // CKFinder.setupCKEditor( editor, { basePath : '../', skin : 'v1' } ) ;
}

   

</script>