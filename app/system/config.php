<?php
/***************************** 
 *  ARQUIVO DE CONFIGURAÇÃO  *
 *****************************/
 
 

// IF AMBIENTE DESENVOLVIMENTO
if($_SERVER['SERVER_NAME'] == 'localhost'){
        
    #########
    #  DB
    #########            
    # Endereço servidor
    //$server = 'www.dcanm.mobi'; 
    $server = 'localhost'; 
    # Usuario servidor
    $user = 'root';
    # Senha servidor
    $pwd = '';
    # Database servidor
    $db = 'luckycode';

    ###########
    #   SYS
    ##########
    // DEV;
    #################
    #   BASE URL
    ###################
    preg_match('/www/', $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
        define("BASE_URL","http://localhost/git/LuckyCode/");    
    }else{
        define("BASE_URL","http://localhost/git/LuckyCode/");
    }

    
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
    $db = 'luckycode';

    ###########
    #   SYS
    ##########
 
    #################
    #   BASE URL
    ###################
    preg_match('/www/', $_SERVER['SERVER_NAME'], $matches);
    if(isset($matches[0])){
          define("BASE_URL","http://www.luckycode.com.br/");  
    }else{
          define("BASE_URL","http://luckycode.com.br/);  
    }

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

# SESSION SYS
$_SESSION['sys']['base_url'] = BASE_URL;



