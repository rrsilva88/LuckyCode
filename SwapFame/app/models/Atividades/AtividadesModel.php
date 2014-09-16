<?php

class AtividadesModel extends Model{
    
    
    function GetAll(){
      global $DB;
       $select = 'SELECT * FROM atividade where status = 1;
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_atividade){
      global $DB;
       $select = 'SELECT *
        FROM  atividade
        WHERE
         id_atividade = "'.$id_atividade.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM atividade WHERE id_atividade ="'.$dados['id_atividade'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    function GetLogAtividade($id_atividade){
       global $DB;
       $select = 'SELECT la.*,c.usuario,DATE_FORMAT(la.data, "%d/%m/%Y %H:%i:%s") as data FROM log_atividade la 
        INNER JOIN contas c
        ON c.id_conta = la.id_conta
        WHERE la.id_atividade ="'.$id_atividade.'"
        ORDER BY la.id_log_atividade DESC
        LIMIT 0,10
       ;';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    function GetTotalLogAtividade($id_atividade){
       global $DB;
       $select = 'SELECT count(*) as total FROM log_atividade 
        WHERE id_atividade ="'.$id_atividade.'"
        
       ;';  
       
       if($ret = $DB->GetAll($select)){
            return $ret[0]['total'];
       }else{
            return $DB->ErrorMsg();
       }  
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('atividade',$dados)){
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
        $id_atividade = $dados['id_atividade'];
        unset($dados['id_atividade']);
        $ret = $this->autoUpdate('atividade',$dados,'WHERE id_atividade="'.$id_atividade.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        atividade 
                  WHERE 
                    id_atividade ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    } 
    
    
    
    
    function SaveLog($dados){
              global $DB;
        if($insert = $this->autoInsert('log_atividade',$dados)){
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