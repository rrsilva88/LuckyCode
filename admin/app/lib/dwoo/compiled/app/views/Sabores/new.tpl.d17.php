<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><form id='frm_motoboy' class='formAjax'>
 <div class="control-group">
    <label class="control-label">Nome</label>
        <div class="controls">
          <input type="text" placeholder="Nome" name='nome' class="span12">
        </div>
</div>     



    <div class="control-group">
            <label class="control-label">HEX</label>
              <div class="controls">
                <div data-color-format="rgb" data-color="rgb(255, 146, 180)" class="input-append color colorpicker colorpicker-hex">
                  <input type="text" name='cor' value="">
                  <span class="add-on"><i style="background-color: rgb(105, 42, 61);"></i></span>
                </div>
              </div>
          </div>
   
                         


<script type="text/javascript">

   


function SaveSabor(){
    $(".loading").show();
     $(".formAjax").ajaxForm({
        url: "Sabores/ajaxSave",
        type:'post',
        dataType:  'json', 
        success: function(data) {
            $(".loading").hide();
            if(data.status == true){
                 window.location.href = "<?php echo $_SESSION['sys']['base_url'];?>Sabor/View/"+data.id;
            }else{
                alertify.log( 'Erro ao cadastrar esse produto!', 'error' );  
            } 
        }
    }).submit(); 
    
    
}
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>