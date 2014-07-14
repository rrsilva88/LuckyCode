<?php

class TutoriaisModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM tutoriais
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_tutorial){
      global $DB;
       $select = 'SELECT *,DATE_FORMAT(data,"%d/%m/%Y") as data
        FROM  tutoriais
        WHERE
         id_tutorial = "'.$id_tutorial.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM tutoriais WHERE id_tutorial ="'.$dados['id_tutorial'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('tutoriais',$dados)){
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
        $id_tutorial = $dados['id_tutorial'];
        unset($dados['id_tutorial']);
        $ret = $this->autoUpdate('tutoriais',$dados,'WHERE id_tutorial="'.$id_tutorial.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        tutoriais 
                  WHERE 
                    id_tutorial ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>