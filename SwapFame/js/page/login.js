function LoginAdmin(){
     serial = $("#frm_login").serialize();
     $.post("home/MakeLogin", serial,
          function(data){
              console.log(data);
          if(data.status == true){
                window.location.href = base_url;
          }else{
                alertify.log( 'Email ou senha incorretos!', 'error' );  
          }
     }, "json");
}   