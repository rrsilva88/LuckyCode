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
    $db = 'swapfame';

    ###########
    #   SYS
    ##########
    // DEV;
    #################
    #   BASE URL
    ###################
    preg_match('/www/', $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
        define("BASE_URL","http://localhost/git/LuckyCode/SwapFame/");    
    }else{
        define("BASE_URL","http://localhost/git/LuckyCode/SwapFame/");
    }
    
    
    define("INSTA_KEY","ae6c40bbf5ee48b1b570a002be77f413");
    define("INSTA_SECRET","ab5a99fdcfda4a4586aec338ef15d006");
    
    define("PATCH_IMAGES","C:\Users\Rafa\Documents\GitHub\LuckyCode\SwapFame\\");
    define("BASE_SITE","http://localhost/git/LuckyCode/SwapFame/");
    
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
          define("BASE_URL","http://www.luckycode.com.br/SwapFame/");  
    }else{
          define("BASE_URL","http://luckycode.com.br/SwapFame/");  
    }
    define("PATCH_IMAGES","/var/www/html/");
    define("BASE_SITE","http://luckycode.com.br/SwapFame/");
    
    
    define("INSTA_KEY","ae6c40bbf5ee48b1b570a002be77f413");
    define("INSTA_SECRET","ab5a99fdcfda4a4586aec338ef15d006");
    
    

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
$_SESSION['sys']['title'] = 'SwapFame';
$_SESSION['sys']['base_url'] = BASE_URL;
$_SESSION['sys']['base'] = BASE_SITE;





