<form id='frm_motoboy' class='formAjax'>
<input type="hidden" name='id_categoria' value="{$categoria.id_categoria}">


<div class="control-group">
    <label class="control-label">Visibilidade</label>
        <div class="controls">
          <select name='status' class="span12">
            <option value="0" {if $categoria.status == 0}SELECTED="SELECTED"{/if}>Inativo</option>
            <option value="1" {if $categoria.status == 1}SELECTED="SELECTED"{/if}>Ativo</option>
         
          </select>
          
        </div>
  </div>

 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" value="{$categoria.nome}" name='nome' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Alias</label>
        <div class="controls">
          <input type="text" placeholder="Alias" value="{$categoria.alias}"  readonly='readonly' class="span12">
        </div>
  </div>
  <div class="control-group">
    <label class="control-label">Descrição</label>
        <div class="controls">
          <input type="text" placeholder="Descrição" value="{$categoria.descricao}"   name='descricao' class="span12">
        </div>
  </div>
          
  
 
  <div class="control-group">
    <label class="control-label">RAIZ</label>
        <div class="controls">
          <select name='id_parent' class="span12">
          <option value="0">HOME</option>
          {foreach $listaCategorias cat}
            <option value="{$cat.id_categoria}" {if $categoria.id_parent == $cat.id_categoria}SELECTED="SELECTED"{/if}>HOME > {$cat.nome}</option>  
          {/foreach}
          </select>
          
        </div>
  </div>
  
  
 
</form>



<script type="text/javascript">




function UpdateCategoria(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Categorias/ajaxUpdate",
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