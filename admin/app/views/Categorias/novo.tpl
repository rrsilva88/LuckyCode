<div id='form'><script>
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$('#cadMotoboy').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
        percent.show();
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function(data) {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
        console.log(data);
        $("#form").hide();
        $("#results").html(data).show();
    },
    complete: function(data) {
         console.log(data);
         
        
    }
}); 

})();       
</script>


<div class='forms'>
     <h1>Criar Motoboy</h1>
    <form id='cadMotoboy' action="Motoboy/Save" method="post" enctype="multipart/form-data">
        <input type='hidden' name='return' value='html' />
        <input type='hidden' name='latitude' id='remetente_lat' />
        <input type='hidden' name='longitude'  id='remetente_lng' /> 
        <table>
            <tr>
                <td>
                    <input type="text" name='nome' placeholder='Nome'>
                </td>
            </tr>
             <tr>
                <td>
                    <input type="text" name='endereco' id='remetente_endereco' onChange='calculaRota()'  placeholder='Endereço'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='rg' placeholder='RG'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='cpf' placeholder='CPF'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='cnh' placeholder='CNH'>
                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="text" name='tel_fixo' placeholder='Telefone Fixo'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='tel_celular' placeholder='Telefone Celular'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='tel_emergencia' placeholder='Telefone Emergencia'>
                </td>
            </tr>
            
             <tr>
                <td>
                    <input type="file" name='foto' placeholder='Foto'>
                    <div class="progress" style="display:none;">
                        <div class="bar"></div >
                        <div class="percent">0%</div >
                    </div>
                </td>
            </tr>
            
            
       
       
   
            
        </table>
         <button type='submit'>Cadastrar</button>
       </form>
   
</div>

</div>
<div id='results'>
</div>