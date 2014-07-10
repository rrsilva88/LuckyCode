<?php
/***************************** 
 *  ARQUIVO DE CONFIGURAÇÃO  *
 *****************************/
 
 
$pattern = '/www/';
// IF AMBIENTE DESENVOLVIMENTO
if($_SERVER['SERVER_NAME'] == 'www.dcanm.mobi'){
        
    #########
    #  DB
    #########            
    # Endereço servidor
    //$server = 'www.dcanm.mobi'; 
    $server = 'localhost'; 
    # Usuario servidor
    $user = 'master';
    # Senha servidor
    $pwd = 'Th3M0nk3y';
    # Database servidor
    $db = 'probiotica';

    ###########
    #   SYS
    ##########
    // DEV;
    define("APP_KEY",'AIzaSyBHv9IeQMAp-OXgjImw5nE4aBbckOmI6TQ');
    #################
    #   BASE URL
    ###################
    
    define("PATCH_IMAGES",'/home/dcanmmob/public_html/probiotica_site/uploads/');
    define("PATCH_IMAGES_PRODUTO",'/home/dcanmmob/public_html/probiotica_site/assets/images/produtos/');
    
    preg_match($pattern, $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
        define("BASE_URL","http://www.dcanm.mobi/probiotica_site/admin/");    
    }else{
        define("BASE_URL","http://dcanm.mobi/probiotica_site/admin/");
    }
    define('BASE_SITE','http://dcanm.mobi/probiotica_site/');

    
}else{ // AMBIENTE PRODUCAO

/*
    #########
    #  DB
    ######### 
    # Endereço servidor
    $server = 'localhost'; 
    # Usuario servidor
    $user = 'root';
    # Senha servidor
    $pwd = 'xBaEH0';
    # Database servidor
    $db = 'nowmotos';

    ###########
    #   SYS
    ##########
    define("APP_KEY",'AIzaSyDjVSORHohUivAEh0fz07RR1hCGTagJOOs');
    define("PATCH_MOTOBOY_IMAGES",'/var/www/html/pedido/fotos/motoboy/');
    define("PATCH_MOTOBOY_FOTOS",'/var/www/html/pedido/fotos/');
    define("PATCH_MOTOBOY_FOTOS_WEB",'http://www.vaimoto.com.br/pedido/fotos/');

    #################
    #   BASE URL
    ###################
    preg_match($pattern, $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
          define("BASE_URL","http://www.vaimoto.com.br/");  
    }else{
          define("BASE_URL","http://vaimoto.com.br/");  
    }
*/
}



####################
##   GLOBAL CONFIG'S
####################
#DB tipo banco de dados
$DB = NewADOConnection('mysql');
###################
##  SYS CONFIGS
###################
//CAMINHO PASTA APP
define("BASE","app/");
define("SYS","system/");
define("CONTROLLERS",BASE."controllers/");
define("MODELS",BASE."models/");
define("VIEWS",BASE."views/");
define("LIB",BASE."lib/");
define("HELPERS",SYS."helpers/");
define("DEBUG",false);

#EMAIL
define("FROM_EMAIL",'contato@intercolegial.globo.com');
define("NAME_EMAIL",'Intercolegial');

# SESSION SYS
$_SESSION['sys']['base_url'] = BASE_URL;
$_SESSION['sys']['base'] = BASE_SITE;




