<?php

class EventosModel extends Model{
    
    
    function GetAll($dados){
      global $DB;
       $select = 'SELECT * FROM eventos
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Data($id_evento){
      global $DB;
        $select = 'SELECT *,DATE_FORMAT(data_ini,"%d/%m/%Y") as data_ini,DATE_FORMAT(data_fim,"%d/%m/%Y") as data_fim
        FROM  eventos
        WHERE
         id_evento = "'.$id_evento.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM eventos WHERE id_evento ="'.$dados['id_evento'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function Save($dados){
        if($insert = $this->autoInsert('eventos',$dados)){
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
    
    function getInscritosEvento($id_evento){
          global $DB;
       $select = 'SELECT id.*,ef.*
FROM inscricao_dados id
INNER JOIN inscricao  i
ON id.id_inscricao = i.id_inscricao
LEFT JOIN evento_form ef
ON ef.id_evento_form = id.id_evento_form
where i.id_evento = '.$id_evento.'
ORDER BY ef.id_evento_form  ASC

;';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    
    function SaveCampo($dados){
        if($insert = $this->autoInsert('evento_form',$dados)){
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
    
    function getCamposEvento($id_evento){
           global $DB;
       $select = 'SELECT * FROM evento_form WHERE id_evento ="'.$id_evento.'" ORDER BY id_evento_form ASC;';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
    
    function Update($dados){
        $id_evento = $dados['id_evento'];
        unset($dados['id_evento']);
        $ret = $this->autoUpdate('eventos',$dados,'WHERE id_evento="'.$id_evento.'"');
        return $ret;
    }
    
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        eventos 
                  WHERE 
                    id_evento ="'.$dados['id_eventos'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    function DeleteCampoEvento($dados){
        global $DB;
       $select = 'DELETE FROM 
                        evento_form 
                  WHERE 
                    id_evento_form ="'.$dados['id_evento_form'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }           
    
}



?>