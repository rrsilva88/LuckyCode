

function visualizaMotoboy(id_motoboy){
    
window.open(
  base_url+'Motoboy/View/'+id_motoboy,
  '_blank' // <- This is what makes it open in a new window.
);
    
    //window.location.href = base_url+'Motoboy/View/'+id_motoboy;
}   



function Delete(classe,id){
     if (confirm("Tem certeza que deseja deletar esse registro?")){
       $.post(classe+"/ajaxDelete/?id="+id, 
          function(data){
          if(data.status == true){
              alertify.log( 'Deletado com sucesso!', 'success' ); 
          }else{
              alertify.log( 'Erro ao deletar', 'error' ); 
          }
     }, "json");
    
    } 
}

function Visualizar(classe,id){
window.open(
  base_url+classe+'/View/'+id,'_blank' // <- This is what makes it open in a new window.
); 
}
function Cadastrar(classe){
window.open(
  base_url+classe+'/Create/','_self' // <- This is what makes it open in a new window.
); 
}

function bloqueiaMotoboy(id_motoboy){
     $.post("Motoboy/ajaxUpdate/?id_motoboy="+id_motoboy+'&status=4&notifica=1', 
          function(data){
          if(data.status == true){
              $("#status_"+id_motoboy).removeClass('label-success').removeClass('btn-inverse').addClass('label-important').text('Bloqueado');
              alertify.log( 'Motoboy Bloqueado com sucesso!', 'success' ); 
          }else{
              alertify.log( 'Erro ao Bloquear o motoboy!', 'error' ); 
          }
     }, "json");
}   
function desbloqueiaMotoboy(id_motoboy){
     $.post("Motoboy/ajaxUpdate/?id_motoboy="+id_motoboy+'&status=1&notifica=1', 
          function(data){
          if(data.status == true){
              $("#status_"+id_motoboy).removeClass('label-important').removeClass('btn-inverse').addClass('label-success').text('Disponivel');
              alertify.log( 'Motoboy desbloqueado com sucesso!', 'success' ); 
          }else{
              alertify.log( 'Erro ao desbloquear o motoboy', 'error' ); 
          }
     }, "json");
}

function visualizaUser(id_user){
    
    
window.open(
  base_url+'Usuarios/View/'+id_user,
  '_blank' // <- This is what makes it open in a new window.
);
  //window.location.href = base_url+'Usuarios/View/'+id_user;  
}


function visualizaPedido(id_pedido){
    
    
window.open(
  base_url+'Pedido/View/'+id_pedido,
  '_blank' // <- This is what makes it open in a new window.
);
  //window.location.href = base_url+'Usuarios/View/'+id_user;  
}

function cadastrarMotoboy(id_pre_motoboy){
    
    
window.open(
  base_url+'Motoboy/Cadastro/'+id_pre_motoboy,
  '_blank' // <- This is what makes it open in a new window.
);
  //window.location.href = base_url+'Usuarios/View/'+id_user;  
}



function novoMotoboy(){
    
    
window.open(
  base_url+'Motoboy/Cadastro/',
  '_blank' // <- This is what makes it open in a new window.
);
  //window.location.href = base_url+'Usuarios/View/'+id_user;  
}


function viewPreCadastrados(){
    
window.open(
  base_url+'Motoboy/ajaxPreCadastros/',
  '_blank' // <- This is what makes it open in a new window.
);
    
    //window.location.href = base_url+'Motoboy/View/'+id_motoboy;
}   
function countChar(val) {
    var len = val.value.length;
    console.log(len);
    if (len > 1024) {
        val.value = val.value.substring(0, 1024);
    } else {
        $('#charNum').text(1024 - len);
    }
};

function DesabilitarMotoboy(id_motoboy){
    var name = $("#name_"+id_motoboy).html();
    if (confirm("Tem certeza que deseja desabilitar o motoboy: "+name+" ?")){
       $.post("Motoboy/ajaxUpdate/?id_motoboy="+id_motoboy+'&status=6&notifica=1', 
          function(data){
          if(data.status == true){
              $("#status_"+id_motoboy).removeClass('').addClass('label btn-inverse').text('Desabilitado');
              alertify.log( 'Motoboy desabilitado com sucesso!', 'success' ); 
          }else{
              alertify.log( 'Erro ao desabilitar o motoboy', 'error' ); 
          }
     }, "json");
    
    }
    
    
    
}
function HabilitarMotoboy(id_motoboy){
    var name = $("#name_"+id_motoboy).html();
    if (confirm("Tem certeza que deseja Habilitar o motoboy: "+name+" ?")){
       $.post("Motoboy/ajaxUpdate/?id_motoboy="+id_motoboy+'&status=1', 
          function(data){
          if(data.status == true){
              $("#status_"+id_motoboy).removeClass('').addClass('label label-success').text('Disponivel');
              alertify.log( 'Motoboy Habilitado com sucesso!', 'success' ); 
          }else{
              alertify.log( 'Erro ao Habilitar o motoboy', 'error' ); 
          }
     }, "json");
    
    }
    
    
    
}
