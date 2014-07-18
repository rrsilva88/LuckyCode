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
# Adodb - Biblioteca de banco
include 'lib/adodb5/adodb.inc.php';
# Dwoo - Templates
include 'lib/dwoo/dwooAutoload.php';
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
$DB->SetFetchMode(ADODB_FETCH_ASSOC);
####################
##   DWOOO
####################
global $dwoo;
$dwoo = new Dwoo(); 

 