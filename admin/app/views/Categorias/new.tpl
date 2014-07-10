<form id='frm_motoboy' class='formAjax'>
 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
          <input type="text" placeholder="Descrição"  name='descricao' class="span12">
        </div>
  </div>
   
  
 
  <div class="control-group">
    <label class="control-label">RAIZ</label>
        <div class="controls">
          <select name='id_parent' class="span12">
          <option value="0">HOME</option>
          {foreach $categorias categoria}
            <option value="{$categoria.id_categoria}">HOME > {$categoria.nome}</option>  
          {/foreach}
          </select>
          
        </div>
  </div>
  
  
 
</form>



<script type="text/javascript">

   


function SaveCategoria(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Categorias/ajaxSave",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                 window.location.href = "{$dwoo.session.sys.base_url}Categorias/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar essa categoria!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script>