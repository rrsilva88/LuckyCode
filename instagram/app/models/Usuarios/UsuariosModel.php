<?php

class UsuariosModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM sys_users
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_user){
      global $DB;
       $select = 'SELECT *
        FROM  sys_users
        WHERE
         id_user = "'.$id_user.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM sys_users WHERE id_user ="'.$dados['id_user'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('sys_users',$dados)){
            if(is_numeric($insert)){
                $ret['id'] = $insert;
            }else{
            
                return $DB->ErrorMsg(); 
                #$ret = $insert;
            }
            return $ret;
        }else{
            return $DB->ErrorMsg(); 
        }
    }
    
    function Update($dados){
        $id_user = $dados['id_user'];
        unset($dados['id_user']);
        $ret = $this->autoUpdate('sys_users',$dados,'WHERE id_user="'.$id_user.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        sys_users 
                  WHERE 
                    id_user ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>