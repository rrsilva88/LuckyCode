<?php

class AtividadesModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM atividade
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
    
}



?>