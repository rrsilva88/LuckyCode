<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <base href='{$dwoo.session.sys.base_url}'>
    <link rel="stylesheet" href="css/styles.css" />
    <title>NowMoto</title>
    <script>
        /* VARIAVEIS GLOBAIS */
        var base_url = "{$dwoo.session.sys.base_url}"; /* BASE_URL PARA REQUISIÇÕES AJAX*/
        var id_user  = "{$dwoo.session.user.id_user}"; /* ID_USUARIO LOGADO */
        var numRangeKM  =  0;
        var limiteInvites  =  0;
        var loopInvite;
        var loopLista; 
        var loopCotacao; 
        var numContacao  =  0;
        var motoboys;
       
        
      
     
     
     
        
    </script>
    <link rel="stylesheet" href="css/flick/jquery-ui-1.10.3.custom.css" />
    <script src="js/jquery-1.9.1.js"></script>
    <script src="js/jquery-ui-1.10.3.custom.min.js"></script>
    
    <!--script type='text/javascript' src='js/jquery.min.js'></script-->
    <script type='text/javascript' src='js/jquery.form.min.js'></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&language=pt-BR"></script>
    
     <!-- noty -->
     <script type="text/javascript" src="js/noty/jquery.noty.js"></script>
     <script type="text/javascript" src="js/noty/layouts/topRight.js"></script>
     <!-- noty themes -->
     <script type="text/javascript" src="js/noty/themes/default.js"></script>



    
    <script type="text/javascript" src="js/functions.js"></script>
    
    
</head>
<body>

