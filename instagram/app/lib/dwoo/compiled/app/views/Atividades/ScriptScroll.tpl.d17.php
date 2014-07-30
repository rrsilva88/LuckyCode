<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!-- VARIAVEL DE CONTROLE PARA PAGINAÇÃO SCROLL-->
<input type='hidden' id='max_id_instagram' value='<?php echo $this->scope["max_id"];?>'>
 
<script>


$(document).ready(function () {
    $(window).scroll(function(){
        if($(window).scrollTop() == $(document).height() - $(window).height()){
             Messenger().post({message: 'Carregando mais fotos',type: 'success',showCloseButton: true});
            $.get("Atividades/ajaxGetPaginaFeed/?max_id="+$("#max_id_instagram").val(), function(data) {
                    if(data.status == true){
                       $("#max_id_instagram").val(data.max_id)
                       $("#list_feed_instagram").append(data.html);
                    }else{
                        Messenger().post({message: 'Suas fotos acabaram',type: 'success',showCloseButton: true});
                    }
            },'json');
            
        }
    });
});

</script>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>