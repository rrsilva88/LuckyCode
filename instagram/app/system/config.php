<?php
/***************************** 
 *  ARQUIVO DE CONFIGURAÇÃO 
 * MANAGER
 *  *
 *****************************/
 
 
$pattern = '/www/';
// IF AMBIENTE DESENVOLVIMENTO

// IF AMBIENTE DESENVOLVIMENTO
if($_SERVER['SERVER_NAME'] == 'localhost'){
        
    #########
    #  DB
    #########            
    # Endereço servidor
    $server = 'localhost'; 
    # Usuario servidor
    $user = 'root';
    # Senha servidor
    $pwd = '';
    # Database servidor
    $db = 'instagram';

    ###########
    #   SYS
    ##########
    // DEV;
    #################
    #   BASE URL
    ###################
    preg_match('/www/', $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
        define("BASE_URL","http://localhost/git/LuckyCode/instagram/");    
    }else{
        define("BASE_URL","http://localhost/git/LuckyCode/instagram/");
    }
    
    
    define("INSTA_KEY","82596154753047fab93426aa01643390");
    define("INSTA_SECRET","a5ffd4caefa0462fa45974893b180230");
    
    
    define("PATCH_IMAGES","C:\Users\Rafa\Documents\GitHub\LuckyCode\instagram\\");
    define("BASE_SITE","http://localhost/git/LuckyCode/instagram/");
    
}else{ // AMBIENTE PRODUCAO


    #########
    #  DB
    ######### 
    # Endereço servidor
    $server = 'localhost'; 
    # Usuario servidor
    $user = 'root';
    # Senha servidor
    $pwd = 'r1a2f3a4';
    # Database servidor
    $db = 'instagram';

    ###########
    #   SYS
    ##########
 
    #################
    #   BASE URL
    ###################
    preg_match('/www/', $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
          define("BASE_URL","http://www.luckycode.com.br/instagram/");  
    }else{
          define("BASE_URL","http://luckycode.com.br/instagram/");  
    }
    define("PATCH_IMAGES","/var/www/html/");
    define("BASE_SITE","http://luckycode.com.br/instagram/");
    
    
    define("INSTA_KEY","71914354b8024239b149f2176ef96743");
    define("INSTA_SECRET","f8953f9a124746f49667246168203445");
    
    

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
define("FROM_EMAIL",'contato@luckycode.com.br');
define("NAME_EMAIL",'LuckyCode');

#INSTAGRAM

define("CALLBACK_INSTAGRAM",BASE_URL.'ajaxInstagramCallback');

        
        if(isset($_GET['d'])){
            echo CALLBACK_INSTAGRAM;
        }
# SESSION SYS
$_SESSION['sys']['title'] = 'InstaUP';
$_SESSION['sys']['base_url'] = BASE_URL;
$_SESSION['sys']['base'] = BASE_SITE;





