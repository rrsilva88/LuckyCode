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
    
    function GetRobot(){
        global $DB;
       $select = 'SELECT * FROM contas WHERE status = 1 ORDER BY RAND() LIMIT 0,1';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
        
    }
    
    function GetRobots($limit,$id_atividade){
       global $DB;
        
       $select = '
      
      
                    SELECT c.*,c.id_conta as id_robo FROM contas c
                    WHERE c.id_conta 
                    NOT IN (SELECT id_conta FROM log_atividade WHERE id_atividade = '.$id_atividade.')
                    AND c.status = 1
                    ORDER BY RAND() 
                    LIMIT 0,'.$limit;  
       
         
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
        
    }
    
    function getTotalRobots(){
         global $DB;
       $select = 'SELECT count(*) as total FROM contas WHERE status = 1';  
       
       if($ret = $DB->GetAll($select)){
            return $ret[0]['total'];
       }else{
            return $DB->ErrorMsg();
       }
        
    }
    function getTotalLogs($id_atividade){
         global $DB;
       $select = 'SELECT count(*) as total FROM log_atividade WHERE id_atividade = '.$id_atividade;  
       
       if($ret = $DB->GetAll($select)){
            return $ret[0]['total'];
       }else{
            return $DB->ErrorMsg();
       }
        
    }
    
    function getAccountRobo(){
         global $DB;
       $select = 'SELECT * FROM contas WHERE status = 0 LIMIT 1';  
       
       if($ret = $DB->GetAll($select)){
            return $ret[0];
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function UpdateRobo($dados){
        $id_conta = $dados['id_conta'];
        unset($dados['id_conta']);
        $ret = $this->autoUpdate('contas',$dados,'WHERE id_conta="'.$id_conta.'"');
        return $ret;
    }
    
    function SaveRobo($dados){
              global $DB;
        if($insert = $this->autoInsert('contas',$dados)){
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
    
    
    
}



?>