<?php

class Model{
   function __construct() {
        global $dwoo,$DB,$params;
        $this->dwoo = $dwoo;
        $this->DB = $DB;
        $this->params = $params; 
   }
   function select($SQL){
        global $DB;  
        if($ret = $DB->GetAll($SQL)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
       
   }
    function autoInsert($TABLE='',$VARS='',$SQL=''){
        global $DB;
        if(isset($VARS['debug'])){
            unset($VARS['debug']);
        }
        
        
        while(list($k,$v)=@each($VARS)){
            $column.= ", $k";
            $values.= ", '$v'";
        }
        $column = substr($column, 1);
        $values = substr($values, 1);
        ($SQL) ? $sql = $SQL : $sql  = "INSERT INTO $TABLE ($column) VALUES ($values)";
        if($_GET['debug']){
            echo $sql;
        }               
        if($ret = $DB->Execute($sql)){
            return $this->lastID($TABLE);
        }else{
            return $DB->ErrorMsg();
        }
        
   }
     function lastID($TABLE=''){
         $sql = "DESCRIBE $TABLE;";
         $dados = $this->select($sql);
         $fieldid = $dados[0][0];
         $sql = "SELECT MAX(".$fieldid.") as id FROM $TABLE;";
         $dados = $this->select($sql);
         return $dados[0]['id']; 
    }
   
   
   function autoUpdate($TABLE='',$VARS='',$WHERE='',$SQL=''){
        global $DB;
        unset($VARS['debug']);
        while(list($k,$v)=@each($VARS)){
            $set.= ", $k='$v'";
        }
        $set = substr($set, 1);
        ($SQL) ? $sql = $SQL : $sql  = "UPDATE $TABLE SET $set $WHERE";
        if($_GET['debug']){
            echo $sql;
        }
        if($ret = $DB->Execute($sql)){
            return true;
        }else{
            return $DB->ErrorMsg();
        }
        
   }
   
   function addLog($dados){
       $ret = $this->autoInsert('sys_logs',$dados);
       return $ret;
   }
   
   
   function getMenuDB($id_user){
       
       
        global $DB;  
        $SQL = 'SELECT p.id_perfil, p.perfil,m.id_menu,m.menuid, m.classe, m.metodo, m.menu,m.icon,m.visible,m.ordem  FROM `sys_acesso` AS a
                INNER JOIN sys_menu as m ON a.id_menu = m.id_menu
                INNER JOIN sys_perfil as p ON a.id_perfil = p.id_perfil
                INNER JOIN sys_user_perfil as ap ON p.id_perfil= ap.id_perfil
                INNER JOIN sys_users as sa ON sa.id_user= ap.id_user
                WHERE sa.id_user = "'.$id_user.'" AND m.ativo = 1  AND a.ativo = 1
                ORDER BY 
                m.ordem ASC;';
        if($ret = $DB->GetAll($SQL)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
       
       
       
   }
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
   
   
   
         
    function savePush($dados){
        if($insert = $this->autoInsert('nm_push',$dados)){
            if(is_numeric($insert)){
                $ret['id'] = $insert;
            }else{
                $ret = $insert;
            }
            return $ret;
        }else{
            return $DB->ErrorMsg(); 
        }
    }  
   
         
    function saveSMS($dados){
        if($insert = $this->autoInsert('nm_sms',$dados)){
            if(is_numeric($insert)){
                $ret['id'] = $insert;
            }else{
                $ret = $insert;
            }
            return $ret;
        }else{
            return $DB->ErrorMsg(); 
        }
    }  
   
   
   
    
}
?>