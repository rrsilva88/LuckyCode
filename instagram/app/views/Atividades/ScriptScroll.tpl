<!-- VARIAVEL DE CONTROLE PARA PAGINAÇÃO SCROLL-->
<input type='hidden' id='max_id_instagram' value='{$max_id}'>
<input type='hidden' id='loading_scroll' value='0'>
 {literal}
<script>

    
$(document).ready(function () {
    $(window).scroll(function(){

        if($(window).scrollTop() == $(document).height() - $(window).height()){
            if($("#loading_scroll").val() == 0){
                if($("#max_id_instagram").val() != null){
                Messenger().hideAll();
                $("#loading_scroll").val(1)
                     Messenger().post({message: 'Carregando mais fotos',type: 'success',showCloseButton: true});
                    $.get("Atividades/ajaxGetPaginaFeed/?max_id="+$("#max_id_instagram").val(), function(data) {
                        $("#loading_scroll").val(0)
                        Messenger().hideAll();
                            if(data.status == true){
                               $("#max_id_instagram").val(data.max_id)
                               $("#list_feed_instagram").append(data.html);
                            }else{
                                Messenger().post({message: 'Suas fotos acabaram',type: 'success',showCloseButton: true});
                            }
                    },'json');
                    
                }else{
                    Messenger().post({message: 'Não mais existe registros',type: 'success',showCloseButton: true});
                }
            }
        }
        
    });
});

</script>
{/literal}