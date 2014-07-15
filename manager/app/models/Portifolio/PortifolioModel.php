<?php

class PortifolioModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM portifolio
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_portifolio){
      global $DB;
       $select = 'SELECT *,DATE_FORMAT(data,"%d/%m/%Y") as data
        FROM  portifolio
        WHERE
         id_portifolio = "'.$id_portifolio.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM portifolio WHERE id_portifolio ="'.$dados['id_portifolio'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('portifolio',$dados)){
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
        $id_portifolio = $dados['id_portifolio'];
        unset($dados['id_portifolio']);
        $ret = $this->autoUpdate('portifolio',$dados,'WHERE id_portifolio="'.$id_portifolio.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        portifolio 
                  WHERE 
                    id_portifolio ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>