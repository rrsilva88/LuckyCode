<?php

class UserModel extends Model{
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM adm_users WHERE email ="'.$dados['email'].'" AND senha = "'.$dados['senha'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
       unset($dados['return']);
       if($insert = $this->autoInsert('nm_user',$dados)){
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
    
    function Update($dados){
        $id_user = $dados['id_user'];
        unset($dados['id_user']);
        $ret = $this->autoUpdate('ps_users',$dados,'WHERE id_user="'.$id_user.'"');
        return $ret;
    }
    
}



?>