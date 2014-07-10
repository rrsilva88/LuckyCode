<?php

class produtosModel extends Model{
    
  
    
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
      
      
    function GetAll(){
      global $DB;
       $select = 'SELECT p.*,c.nome as categoria,
       (SELECT nome FROM categorias where id_categoria = c.id_parent) as categoria_root
        FROM  produtos p
        INNER JOIN categorias c
        ON c.id_categoria = p.id_categoria
        WHERE p.status = 1
        ORDER BY categoria_root,categoria,p.nome ASC
        ;
       ';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
      
      
      
    function Data($id_produto){
      global $DB;
       $select = 'SELECT *
        FROM  produtos
        WHERE
         id_produto = "'.$id_produto.'"
       ';  
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }   
    }
      
      
      
    function Save($dados){
        if($insert = $this->autoInsert('produtos',$dados)){
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
        $id_produto = $dados['id_produto'];
        unset($dados['id_produto']);
        $ret = $this->autoUpdate('produtos',$dados,'WHERE id_produto="'.$id_produto.'"');
        return $ret;
    }
    
    
      
      
      
     
    
    function Delete($dados){
        global $DB;
       $select = 'DELETE FROM 
                        produtos 
                  WHERE 
                    id_produto ="'.$dados['id'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }        
    
            
     function getprodutosRoot($id_produto = 0){
        global $DB;
       $select = 'SELECT * FROM produtos WHERE id_parent ="0"';  
       
       if($id_produto > 0){
           $select .='  AND id_produto <> "'.$id_produto.'"';
           
       }
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
      
      
      function getSabor($nome){
           global $DB;
           $select = 'SELECT * FROM sabores WHERE nome ="'.$nome.'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
      function getSaborProdutoByID($id){
           global $DB;
           $select = '  SELECT * FROM produto_sabores ps
            INNER JOIN sabores s
            ON ps.id_sabor = s.id_sabor
            WHERE ps.id_produto_sabores = "'.$id.'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
      function getSabores(){
          global $DB;
           $select = 'SELECT * FROM sabores';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      function getSaboresProduto($dados){
          global $DB;
           $select = '  SELECT * FROM produto_sabores ps
            INNER JOIN sabores s
            ON ps.id_sabor = s.id_sabor
            WHERE ps.id_produto = "'.$dados['id_produto'].'"
           ';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
      
      
    function SaveSabor($dados){
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
    
    function SaveProdutoSabor($dados){
        if($insert = $this->autoInsert('produto_sabores',$dados)){
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
    
    
    
    function ajaxDeleteProdutoSabor($dados){
        global $DB;
       $select = 'DELETE FROM 
                        produto_sabores 
                  WHERE 
                    id_produto_sabores ="'.$dados['id_produto_sabores'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }        
    
    
    
    
    
      function getAtividades(){
          global $DB;
           $select = 'SELECT * FROM atividades';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
    
    
    
    
    
      function getAtividadesProduto($dados){
          global $DB;
           $select = ' SELECT * FROM produto_atividade pa
            INNER JOIN atividades a
            ON pa.id_atividade = a.id_atividade
            WHERE pa.id_produto = "'.$dados['id_produto'].'"
           ';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
      
    
    
    
      function getAtividadeProdutoByID($id){
           global $DB;
           $select = '  SELECT * FROM produto_atividade pa
            INNER JOIN atividades a
            ON pa.id_atividade = a.id_atividade
            WHERE pa.id_produto_atividade = "'.$id.'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
    
    
    function SaveAtividadeSabor($dados){
        if($insert = $this->autoInsert('produto_atividade',$dados)){
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
    
    
    
    function ajaxDeleteProdutoAtividade($dados){
        global $DB;
       $select = 'DELETE FROM 
                        produto_atividade 
                  WHERE 
                    id_produto_atividade ="'.$dados['id_produto_atividade'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }        
    
    
    
    
    function SaveInfoSabor($dados){
        if($insert = $this->autoInsert('produto_info',$dados)){
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
    
    
    
    function ajaxDeleteProdutoInfo($dados){
        global $DB;
       $select = 'DELETE FROM 
                        produto_info 
                  WHERE 
                    id_produto_info ="'.$dados['id_produto_info'].'"
                  ;';  
       if($ret = $DB->Execute($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }  
    }     
    
    
    
      function getInfoProdutoByID($id){
           global $DB;
           $select = '  SELECT * FROM produto_info
                        WHERE id_produto_info = "'.$id.'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }   
    
    function getInfoProduto($dados){
           global $DB;
           $select = '  SELECT * FROM produto_info
                        WHERE id_produto = "'.$dados['id_produto'].'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }   
    
    
    
              
    
   
    
}
?>