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
   
   function GetRootMenu(){
       global $DB;

       $select = 'SELECT * FROM categorias WHERE STATUS = 1 AND id_parent = 0';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }

    }
    
   function GetChildMenu($id_categoria){
       global $DB;

       $select = 'SELECT * FROM categorias WHERE STATUS = 1 AND id_parent = '.$id_categoria;  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }

    }
    
    
   
   function GetRootMenuSidebar(){
       global $DB;

       $select = 'SELECT * FROM menu WHERE STATUS = 1 AND id_parent = 0';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }

    }
    
   function GetChildMenuSidebar($id_menu){
       global $DB;

       $select = 'SELECT * FROM menu WHERE STATUS = 1 AND id_parent = '.$id_menu;  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }

    }
    
    
    
    function getLastNoticias(){
        global $DB;
          
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM artigos 
                WHERE status = 1
                ORDER BY artigos.data DESC , artigos.id_artigo DESC
                LIMIT 3
                ";        
                
                
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
    
    
    
    
    function GetLastEventos(){
        global $DB;
          
        $sql = "SELECT *,
                DATE_FORMAT( `data_ini` , '%d') as dia,
                DATE_FORMAT( `data_ini` , '%m') as mes,
                DATE_FORMAT( `data_ini` , '%Y') as ano,
                DATE_FORMAT( `data_ini` , '%d/%m/%Y') as data_ini_formatada 
                FROM eventos 
                WHERE status = 1
                AND DATE_FORMAT( `data_fim` , '%d-%m-%Y') >= '".date("d-m-Y")."'
                LIMIT 3
                ;
                ";        
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
    
    
   
   
    function autoInsert($TABLE='',$VARS='',$SQL=''){
        global $DB;
        unset($VARS['debug']);
        
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
         global $DB;
         
         
         $DB->SetFetchMode(ADODB_FETCH_BOTH);
         $sql = "DESCRIBE $TABLE;";
         $dados = $this->select($sql);
         $fieldid = $dados[0][0];
         $sql = "SELECT MAX(".$fieldid.") as id FROM $TABLE;";
         $dados = $this->select($sql);
         
         $DB->SetFetchMode(ADODB_FETCH_ASSOC);
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
   
   
    function saveView($dados){
         if($insert = $this->autoInsert('views',$dados)){
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
