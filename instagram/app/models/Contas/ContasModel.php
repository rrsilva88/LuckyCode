<?php

class ContasModel extends Model{
    
    
    function GetAll(){
      global $DB;
       $select = 'SELECT * FROM contas_user WHERE id_user = "'.$_SESSION['loginADM']['id_user'].'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_conta_user){
      global $DB;
       $select = 'SELECT *
        FROM  contas_user
        WHERE
         id_conta_user = "'.$id_conta_user.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM contas_user WHERE id_conta_user ="'.$dados['id_conta_user'].'" and id_user = "'.$_SESSION['loginADM']['id_user'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('contas_user',$dados)){
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
        $id_conta_user = $dados['id_conta_user'];
        unset($dados['id_conta_user']);
        $ret = $this->autoUpdate('contas_user',$dados,'WHERE id_conta_user="'.$id_conta_user.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        contas_user 
                  WHERE 
                    id_conta_user ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>