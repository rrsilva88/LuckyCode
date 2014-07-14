<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<form id='frm_motoboy' class='frm_motoboy'>



      <div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          
          <select name='status'>
            <option value='1' <?php if ((isset($this->scope["noticia"]["status"]) ? $this->scope["noticia"]["status"]:null) == 1) {
?>SELECTED='SELECTED'<?php 
}?>>Visivel</option>  
            <option value='0' <?php if ((isset($this->scope["noticia"]["status"]) ? $this->scope["noticia"]["status"]:null) == 0) {
?>SELECTED='SELECTED'<?php 
}?>>Oculto</option>  
          </select>
          
        </div>
  </div>

                        

<div class="control-group">
    <label class="control-label">Título</label>
        <div class="controls">
          <input type="text" placeholder="Título" value='<?php echo $this->scope["noticia"]["titulo"];?>' name='titulo' class="span10">
          <input type="hidden"  value='<?php echo $this->scope["noticia"]["id_noticia"];?>'name='id_noticia'  class="span2">
          <input type="text" placeholder="Data" value='<?php echo $this->scope["noticia"]["data"];?>' class='date' name='data'  class="span2">
        </div>
  </div>    
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Sub-título" value='<?php echo $this->scope["noticia"]["alias"];?>' class="span12" readonly="readonly">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Sub-título</label>
        <div class="controls">
          <input type="text" placeholder="Sub-título" value='<?php echo $this->scope["noticia"]["subtitulo"];?>' name='subtitulo' class="span12">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Chamada</label>
        <div class="controls">
         <textarea cols="10" rows="10"  style="min-height:150px !important;" placeholder="Chamada" value='' name='chamada' class="span12"><?php echo $this->scope["noticia"]["chamada"];?></textarea>
        </div>
  </div>
  
  
  
  <div class="control-group">
    <label class="control-label">Foto Chamada</label>
        <div class="controls">
        <div class='image_preview'>
          <?php if ((isset($this->scope["noticia"]["foto_chamada"]) ? $this->scope["noticia"]["foto_chamada"]:null) != '') {
?>
            <img src="<?php echo $_SESSION['sys']['base'];?>uploads/<?php echo $this->scope["noticia"]["foto_chamada"];?>" alt="<?php echo $this->scope["noticia"]["titulo"];?>" style='width:50px;float:left;'>
          <?php 
}?>

        </div>
          <br />
          <input type="file" name='foto' onchange="readFile(this)"> 
        </div>
  </div>

      
  
  
<div class="control-group">
    <label class="control-label">Conteúdo</label>
        <div class="controls">
            <textarea id="editor1" name="content_html" rows="100" cols="80">
              <?php echo $this->scope["noticia"]["content_html"];?>

            </textarea>
        </div>
  </div>
  
  
</form>



<script type="text/javascript">

    $(function() {
        $(".date").datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            showAnim:"slideDown",
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        });
    });


   function readFile(input){
        var nm_file = $(input).val();
        var regex = /(jpg|jpeg|png|gif)$/i;
        match = regex.exec(nm_file);
        if(match != null){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $('<img>').attr('src', e.target.result).attr('style','width: 60px ! important; ');
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

function UpdateNoticias(){
    $(".loading").show();
      for (instance in CKEDITOR.instances) {
    CKEDITOR.instances[instance].updateElement();
}
    
     $(".frm_motoboy").ajaxForm({
         
        url: "Noticias/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                alertify.log( 'SUCCESS!', 'success' );  
                window.location.href = base_url+'Noticias/View/<?php echo $this->scope["noticia"]["id_noticia"];?>';
            }else{
                alertify.log( 'ERROR! TRY AGAIN!', 'error' );  
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