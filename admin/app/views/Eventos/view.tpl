<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

<form id='frm_motoboy' class='frm_motoboy'>



      <div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          
          <select name='status'>
            <option value='1' {if $evento.status == 1}SELECTED='SELECTED'{/if}>Visivel</option>  
            <option value='0' {if $evento.status == 0}SELECTED='SELECTED'{/if}>Oculto</option>  
          </select>
          
        </div>
  </div>

                        

<div class="control-group">
    <label class="control-label">Título</label>
        <div class="controls">
          <input type="text" placeholder="Título" value='{$evento.titulo}' name='titulo' class="span12">
          <input type="hidden"  value='{$evento.id_evento}'name='id_evento'  class="span2">
          
        </div>
  </div>    
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Sub-título" value='{$evento.alias}' class="span12" readonly="readonly">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Sub-título</label>
        <div class="controls">
          <input type="text" placeholder="Sub-título" value='{$evento.subtitulo}' name='subtitulo' class="span12">
        </div>
  </div>
  
  
  <div class="control-group">
    <label class="control-label">Tipo</label>
        <div class="controls">
          <select name='tipo'>
            <option value="Geral" {if $evento.tipo == 'Geral'}SELECTED='SELECTED'{/if}>Geral</option>
            <option value="Nutrição" {if $evento.tipo == 'Nutrição'}SELECTED='SELECTED'{/if}>Nutrição</option>
            <option value="Treino" {if $evento.tipo == 'Treino'}SELECTED='SELECTED'{/if}>Treino</option>
          </select>
        </div>
  </div>
  
  
  <div class="control-group">
    <label class="control-label">Datas</label>
        <div class="controls">
           <input type="text" placeholder="Início" value='{$evento.data_ini}' name='data_ini' class="span2 date">
           <input type="text" placeholder="Termino" value='{$evento.data_fim}' name='data_fim' class="span2 date">
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">Data Termino</label>
        <div class="controls">
           
        </div>
  </div>
  
  
  
  <div class="control-group">
    <label class="control-label">Chamada</label>
        <div class="controls">
         <textarea cols="10" rows="10"  style="min-height:150px !important;" placeholder="Chamada" value='' name='chamada' class="span12">{$evento.chamada}</textarea>
        </div>
  </div>
  
      
  
  
  
  
  <div class="control-group">
    <label class="control-label">Foto Chamada</label>
        <div class="controls">
        <div class='image_preview'>
          {if $evento.foto_chamada != ''}
            <img src="{$dwoo.session.sys.base}uploads/{$evento.foto_chamada}" alt="{$evento.titulo}" style='width:50px;float:left;'>
          {/if}
        </div>
          <br />
          <input type="file" name='foto' onchange="readFile(this)"> 
        </div>
  </div>

      
  
  
<div class="control-group">
    <label class="control-label">Conteúdo</label>
        <div class="controls">
            <textarea id="editor1" name="content_html" rows="100" cols="80">
              {$evento.content_html}
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

function UpdateEventos(){
    $(".loading").show();
      for (instance in CKEDITOR.instances) {
    CKEDITOR.instances[instance].updateElement();
}
    
     $(".frm_motoboy").ajaxForm({
         
        url: "Eventos/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                alertify.log( 'SUCCESS!', 'success' );  
                window.location.href = base_url+'Eventos/View/{$evento.id_evento}';
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

   

</script>