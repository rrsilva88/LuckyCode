<?php

class NoticiasModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM noticias
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_noticia){
      global $DB;
       $select = 'SELECT *,DATE_FORMAT(data,"%d/%m/%Y") as data
        FROM  noticias
        WHERE
         id_noticia = "'.$id_noticia.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM noticias WHERE id_noticia ="'.$dados['id_noticia'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
              global $DB;
        if($insert = $this->autoInsert('noticias',$dados)){
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
        $id_noticia = $dados['id_noticia'];
        unset($dados['id_noticia']);
        $ret = $this->autoUpdate('noticias',$dados,'WHERE id_noticia="'.$id_noticia.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        noticias 
                  WHERE 
                    id_noticia ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>