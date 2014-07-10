<?php

class SaboresModel extends Model{
    
  
    
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
      
      
    function Data($id_sabor){
      global $DB;
       $select = 'SELECT *
        FROM  sabores
        WHERE
         id_sabor = "'.$id_sabor.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
      
      
      
    function Save($dados){
        if($insert = $this->autoInsert('sabores',$dados)){
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
        $id_sabor = $dados['id_sabor'];
        unset($dados['id_sabor']);
        $ret = $this->autoUpdate('sabores',$dados,'WHERE id_sabor="'.$id_sabor.'"');
        return $ret;
    }
    
    
      
      
      
     
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        sabores 
                  WHERE 
                    id_sabor ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }        
    
                 
    
   
    
}
?>