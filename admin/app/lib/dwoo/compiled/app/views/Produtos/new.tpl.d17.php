<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<form id='frm_motoboy' class='frm_motoboy'>   


   <div class="control-group">
        <label class="control-label">Categoria</label>
        <div class="controls">
          <select name='id_categoria' class="span12">
          <?php 
$_fh0_data = (isset($this->scope["categorias"]) ? $this->scope["categorias"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['categoria'])
	{
/* -- foreach start output */
?>
            <option value="<?php echo $this->scope["categoria"]["id_categoria"];?>">  <?php if ((isset($this->scope["categoria"]["parent"]) ? $this->scope["categoria"]["parent"]:null) != '') {
?> <?php echo $this->scope["categoria"]["parent"];?> <?php 
}
else {
?> HOME <?php 
}?> > <?php echo $this->scope["categoria"]["nome"];?></option>  
          <?php 
/* -- foreach end output */
	}
}?>

          </select>
        </div>
  </div>           

<div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value='' name='nome' class="span10">
        </div>
  </div>    
  
  <div class="control-group">
    <label class="control-label">Apresentação</label>
        <div class="controls">
          <input type="text" placeholder="Apresentação" value='' name='apresentacao' class="span12">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Tipo</label>
        <div class="controls">
          <input type="text" placeholder="Tipo" name='tipo' class="span12">
        </div>
  </div>
  
 
  <div class="control-group">
    <label class="control-label">Foto</label>
        <div class="controls">
        <div class='image_preview'>
         
         
        </div>
          <br />
          <input type="file" name='foto' onchange="readFile(this)"> 
        </div>
  </div>
  
  
  
                     
  
  
<div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
            <textarea id="editor1" name="descricao" rows="100" cols="80"></textarea>
        </div>
  </div>
  
  
  
  
<div class="control-group">
    <label class="control-label">Informações Nutricionais</label>
        <div class="controls">
          <input type="text" name='info_nutricional' value='' placeholder="Exemplo: Porção de 38g (2 medidas)"  class="span10">
        </div>
  </div>    
  
  
 
  <div class="control-group">
    <label class="control-label">Ficha Tecnica</label>
        <div class="controls">
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



function SaveProduto(){
    $(".loading").show();
      for (instance in CKEDITOR.instances) {
    CKEDITOR.instances[instance].updateElement();
}
     $(".frm_motoboy").ajaxForm({
        url: "Produtos/ajaxSave",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            console.log(data);
            $(".loading").hide();
            if(data.status == true){
                alertify.log( 'SUCCESS!', 'success' );  
               // window.location.href = base_url+'Produtos/View/'+data.id;
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

   

</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>