<?php

session_start();
error_reporting(0);   
ini_set('display_errors', '0'); 

if(isset($_GET['debug'])){
echo '<pre>';
error_reporting(E_ALL);   
ini_set('display_errors', '1'); 
echo '</pre>';
}
date_default_timezone_set('America/Sao_Paulo');
# Adodb - Biblioteca de banco
include 'lib/adodb5/adodb.inc.php';
# Dwoo - Templates
include 'lib/dwoo/dwooAutoload.php';



# Instagram LIB
include 'lib/instagram/instagram.class.php';

# LIB HIGHCHART
include 'lib/HighchartsPHP/Highchart.php';
# Configurações
include 'system/config.php';







# SYSTEM - URL - SET CONTROLLER - SET ACTION  - SET PARAMS
include 'system/class.System.php';
# MVC
include 'system/class.Controller.php' ;
include 'system/class.Model.php';




####################
##   DB
####################
global $DB;
$DB->Connect($server, $user, $pwd, $db); 
mysql_set_charset('utf8');

####################
##   DWOOO
####################
global $dwoo;
$dwoo = new Dwoo();

####################
##   INSTAGRAM
####################


global $instagram;
  $instagram = new Instagram(array(
      'apiKey'      => INSTA_KEY,
      'apiSecret'   => INSTA_SECRET,
      'apiCallback' => CALLBACK_INSTAGRAM
    ));
$config = array(
      'basic',
      'likes',
      'comments'
);


$_SESSION['sys']['auth_link'] = $instagram->getLoginUrl($config);

?>