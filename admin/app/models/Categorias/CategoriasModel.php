<?php

class CategoriasModel extends Model{
    
  
    
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
      
      
    function Data($id_categoria){
      global $DB;
       $select = 'SELECT *
        FROM  categorias
        WHERE
         id_categoria = "'.$id_categoria.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
      
      
      
    function Save($dados){
        if($insert = $this->autoInsert('categorias',$dados)){
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
        $id_categoria = $dados['id_categoria'];
        unset($dados['id_categoria']);
        $ret = $this->autoUpdate('categorias',$dados,'WHERE id_categoria="'.$id_categoria.'"');
        return $ret;
    }
    
    
      
      
      
     
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        categorias 
                  WHERE 
                    id_categoria ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }        
    
            
     function getCategoriasRoot($id_categoria = 0){
        global $DB;
       $select = 'SELECT * FROM categorias WHERE id_parent ="0"';  
       
       if($id_categoria > 0){
           $select .='  AND id_categoria <> "'.$id_categoria.'"';
           
       }
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
              
     function getAllCategorias($id_categoria = 0){
        global $DB;
       $select = 'SELECT *,(SELECT nome FROM categorias  WHERE id_categoria = cat.id_parent) as parent FROM categorias cat WHERE status = 1 and id_parent > 0';  
       
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
              
    
   
    
}
?>