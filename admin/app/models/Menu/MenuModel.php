<?php

class MenuModel extends Model{
    
  
    
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
      
      
    function Data($id_menu){
      global $DB;
       $select = 'SELECT *
        FROM  menu
        WHERE
         id_menu = "'.$id_menu.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
      
      
      
    function Save($dados){
        if($insert = $this->autoInsert('menu',$dados)){
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
    
    
      
    function SaveProdutoMenu($dados){
        if($insert = $this->autoInsert('menu_produto',$dados)){
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
    
    function getProdutosMenu($id){
        
       global $DB;
       $select = '
       
         SELECT np.*,p.nome as produto_nome,c.nome as categoria,
       (SELECT nome FROM categorias where id_categoria = c.id_parent) as categoria_root
        FROM  menu_produto np
        INNER JOIN produtos p
        ON
        np.id_produto = p.id_produto
        INNER JOIN categorias c
        ON c.id_categoria = p.id_categoria
        WHERE
        np.id_menu =  "'.$id.'"
        
        ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
         
    }
    
    function getProdutoMenuByID($id){
         global $DB;
       $select = '
       
        SELECT np.*,p.nome as produto_nome,c.nome as categoria,
       (SELECT nome FROM categorias where id_categoria = c.id_parent) as categoria_root
        FROM  menu_produto np
        INNER JOIN produtos p
        ON
        np.id_produto = p.id_produto
        INNER JOIN categorias c
        ON c.id_categoria = p.id_categoria
        WHERE
        id_menu_produto =  "'.$id.'"
        
        ';  
        
        
        
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
        
    }
    
    
    
    
    function ajaxDeleteProdutoMenu($dados){
        global $DB;
       $select = 'DELETE FROM 
                        menu_produto 
                  WHERE 
                    id_menu_produto ="'.$dados['id_menu_produto'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }       
    
    
    function Update($dados){
        $id_menu = $dados['id_menu'];
        unset($dados['id_menu']);
        $ret = $this->autoUpdate('menu',$dados,'WHERE id_menu="'.$id_menu.'"');
        return $ret;
    }
    
    
      
      
      
     
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        menu 
                  WHERE 
                    id_menu ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }       
    
    
     
    
    
     
    
            
     function getmenuRoot($id_menu = 0){
        global $DB;
       $select = 'SELECT * FROM menu WHERE id_parent ="0"';  
       
       if($id_menu > 0){
           $select .='  AND id_menu <> "'.$id_menu.'"';
           
       }
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
              
     function getAllmenu($id_menu = 0){
        global $DB;
       $select = 'SELECT *,(SELECT nome FROM menu  WHERE id_menu = cat.id_parent) as parent FROM menu cat WHERE status = 1 and id_parent > 0';  
       
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
              
    
   
    
}
?>