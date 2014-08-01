/*
*  Funções variadas
*  Criar / Deletar / Visualizar
* 
*/


function Create(alias){
      window.location.href = base_url+alias+'/Criar/';
}
       
function View(alias,id){
      window.location.href = base_url+alias+'/Visualizar/'+id;
}

function Delete(alias,id){
   var r = confirm("Tem certeza que deseja excluir esse registro?");
   if (r == true) {
    $.post( base_url+alias+'ajaxDelete', { id: id}, function( data ) {
        if(data.status == true){
             Messenger().post({message: 'Registro deletado com sucesso!',type: 'success',showCloseButton: true});
        }else{
            Messenger().post({message: 'Erro ao deletar esse registro!',type: 'error',showCloseButton: true});
        }
        
        }, "json");    
   } 
}



function ConfigAtividade(tipo,id){
      window.location.href = base_url+'Atividades/Configurar/'+tipo+'/'+id;
}

function SelecionarConta(id){
                   $.post(base_url+'home/ajaxSelectConta',
                    { id: id}, function( data ) {
                    if(data.status == true){
                         Messenger().post({message: 'Conta selecionada com sucesso!',type: 'success',showCloseButton: true});
                         location.reload();
                    }else{
                        Messenger().post({message: 'Erro ao selecionar essa conta!',type: 'error',showCloseButton: true});
                    }
                    
                    }, "json");   
}
