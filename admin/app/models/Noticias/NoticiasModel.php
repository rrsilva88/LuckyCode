<?php

class NoticiasModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM artigos
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_artigo){
      global $DB;
       $select = 'SELECT *,DATE_FORMAT(data,"%d/%m/%Y") as data
        FROM  artigos
        WHERE
         id_artigo = "'.$id_artigo.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM artigos WHERE id_artigo ="'.$dados['id_artigo'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
        if($insert = $this->autoInsert('artigos',$dados)){
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
        $id_artigo = $dados['id_artigo'];
        unset($dados['id_artigo']);
        $ret = $this->autoUpdate('artigos',$dados,'WHERE id_artigo="'.$id_artigo.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        artigos 
                  WHERE 
                    id_artigo ="'.$dados['id_artigos'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>