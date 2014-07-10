<form id='frm_user' class='frm_user'>
 
  
  <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
         <input type="hidden"  value='{$user.id_user}' name='id_user' class="span12">
          <input type="text" placeholder="Email" value='{$user.nome}' name='nome' class="span12">
          <!--span class="help-inline">Helpful text here.</span-->
        </div>
  </div>
  
  
  
  <div class="control-group">
    <label class="control-label">Email</label>
        <div class="controls">
          <input type="text" placeholder="Email" value='{$user.email}' name='email' class="span12">
          <!--span class="help-inline">Helpful text here.</span-->
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">CPF</label>
        <div class="controls">
          <input type="text" placeholder="CPF" value='{$user.cpf}' name='cpf' class="span12">
          <!--span class="help-inline">Helpful text here.</span-->
        </div>
  </div>
  
  <div class="control-group">
    <label class="control-label">CNPJ</label>
        <div class="controls">
          <input type="text" placeholder="CNPJ" value='{$user.cnpj}' name='cnpj' class="span12">
          <!--span class="help-inline">Helpful text here.</span-->
        </div>
  </div>
  
  
</form>



<script type="text/javascript">



$(function() {


  $(".tel").mask("(99) 9-9999-999?9").focusout(function(){
            var phone, element;
            var element = $(this);
            element.unmask();
            phone = element.val().replace(/\D/g, '');
            if(phone.length > 10) {
                element.mask("(99) 9-9999-999?9");
            } else {
                element.mask("(99) 9999-9999?9");
            }
        }).trigger('focusout');
        
   $(".cep").mask("99999-999");     
   $(".rg").mask("99.999.999-9");     
   $(".cpf").mask("999.999.999-99");     
   $(".condumoto").mask("999.999-99");   
});



   function readFile(input){
        var nm_file = $(input).val();
        var regex = /(jpg|jpeg|png|gif)$/i;
        match = regex.exec(nm_file);
        if(match != null){
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $('<img>').attr('src', e.target.result).attr('style','width: 60px ! important; float: left;');
                    $(input).parent().find('.image_preview').html(img);
                    //$()
                }
                reader.readAsDataURL(input.files[0]);
            }
              
        }else{
          alert('Só e permitido enviar arquivos com extensão (.jpg/.jpeg/.png/.gif)');
        }
}



function UpdateUser(){
     $(".frm_user").ajaxForm({
        url: "Usuarios/ajaxUpdate",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            console.log(data);
            if(data.status == true){
                $("#foto_old").val(data.retorno.foto);
                alertify.log( 'Dados atualizados com sucesso!', 'success' );  
            }else{
                alertify.log( 'Erro ao atualizar!', 'error' );  
            }
        }
    }).submit(); 
    
    
}
</script>