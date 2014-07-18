<?php

class homeModel extends Model{
    
    function login($email,$pass){
        global $DB;
        $sql = "SELECT * FROM rf_users 
                WHERE 
                email='".$email."'
                and
                senha = '".$pass."'
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
    
    
    function saveContato($dados){
               global $DB;
        if($insert = $this->autoInsert('contato',$dados)){
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
    function createUser($dados){
        global $DB;
        $insert = "INSERT INTO 
                   rf_users 
                   (`fb_id`,`fb_access_token`,`name`,`email`,`senha`,`birthday`,`status`)
                   VALUES
                   ('".$dados['id']."','".$dados['fb_access_token']."','".$dados['name']."','".$dados['email']."','".$dados['senha']."','".$dados['birthday']."',1);
                    ";
        if($DB->Execute($insert)){
            return true;
        }else{
            return false;
        }
    }
    
    
      function homeProducts(){
        global $DB;
        $sql = "SELECT  pu.*,ct.alias as categoria_alias,
             (SELECT alias FROM  categorias WHERE id_categoria = ct.id_parent) as categoria_root
             FROM produtos pu 
                 INNER JOIN categorias ct
                 ON ct.id_categoria = pu.id_categoria 
                AND pu.status = '1'
                ORDER BY RAND()
                LIMIT 9
                
                
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function getTotalPaginasCategorias($id_categoria){
      global $DB;
         $sql = "SELECT  count(DISTINCT(pu.id_produto)) as total FROM produtos pu 
                 INNER JOIN categorias ct
                 ON ct.id_categoria = pu.id_categoria 
                WHERE
                 ct.id_parent = '".$id_categoria."'
                 AND pu.status = 1
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }   
    }
    function getTotalPaginasMenu($id_menu){
      global $DB;
         $sql = "SELECT  count(DISTINCT(pu.id_produto)) as total FROM produtos pu 
                 INNER JOIN categorias ct
                    ON ct.id_categoria = pu.id_categoria
                 LEFT JOIN menu_produto np
                    ON np.id_produto = pu.id_produto
                 WHERE
                 np.id_menu = '".$id_menu."'
                 AND pu.status = 1
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }   
    }
    
    
    function RouteisProduct($alias,$id_categoria){
        global $DB;
        $sql = "SELECT * FROM produtos 
                WHERE alias = '".$alias."'
                AND id_categoria = '".$id_categoria."
                AND status = 1'
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    function getProdutosSubCategoria($id_categoria,$pagina){
        global $DB;
         $sql = "SELECT  pu.*,ct.alias as categoria_alias FROM produtos pu 
                 INNER JOIN categorias ct
                 ON ct.id_categoria = pu.id_categoria 
                WHERE
                 pu.id_categoria = '".$id_categoria."'
                 AND pu.status = 1
                 LIMIT $pagina,".NUM_PER_PAGE."
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    function getProdutosCategoria($id_categoria,$pagina){
        global $DB;
         $sql = "SELECT pu.*,ct.alias as categoria_alias FROM produtos pu 
                 INNER JOIN categorias ct
                 ON ct.id_categoria = pu.id_categoria
                WHERE
                 ct.id_parent = '".$id_categoria."'
                 AND pu.status = 1
                 LIMIT $pagina,".NUM_PER_PAGE."
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    
    
    
    function getProdutosSubMenu($id_menu,$pagina){
        global $DB;
         $sql = "SELECT pu.*,ct.alias as categoria_alias,
                (SELECT alias FROM  categorias WHERE id_categoria = ct.id_parent) as categoria_root
                FROM produtos pu 
                 INNER JOIN categorias ct
                    ON ct.id_categoria = pu.id_categoria
                 LEFT JOIN menu_produto np
                    ON np.id_produto = pu.id_produto
                 WHERE
                 np.id_menu = '".$id_menu."'
                 AND pu.status = 1
                 LIMIT $pagina,".NUM_PER_PAGE."
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function getProdutosMenu($id_menu,$pagina){
        global $DB;
         $sql = "SELECT pu.*,ct.alias as categoria_alias,
                (SELECT alias FROM  categorias WHERE id_categoria = ct.id_parent) as categoria_root
                FROM produtos pu 
                 INNER JOIN categorias ct
                    ON ct.id_categoria = pu.id_categoria
                 LEFT JOIN menu_produto np
                    ON np.id_produto = pu.id_produto
                 WHERE
                 np.id_menu = '".$id_menu."'
                 AND pu.status = 1
                 LIMIT $pagina,".NUM_PER_PAGE."
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function RouteisCategoria($route,$id_parent = 0){
        global $DB;
        $sql = "SELECT * FROM categorias 
                WHERE alias = '".$route."'
                AND id_parent = '".$id_parent."'
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function RouteisMenu($route,$id_parent = 0){
        global $DB;
        $sql = "SELECT * FROM menu 
                WHERE alias = '".$route."'
                AND id_parent = '".$id_parent."'
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function getNoticias($pagina){
        global $DB;
        $sql = "SELECT * FROM vm_noticias 
                ORDER BY data DESC
                LIMIT ".$pagina." , 10
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
    
    
    
      function getSaboresProduto($id_produto){
          global $DB;
           $select = '  SELECT * FROM produto_sabores ps
            INNER JOIN sabores s
            ON ps.id_sabor = s.id_sabor
            WHERE ps.id_produto = "'.$id_produto.'"
           ';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
    
    
      function getAtividadesProduto($id_produto){
          global $DB;
           $select = ' SELECT * FROM produto_atividade pa
            INNER JOIN atividades a
            ON pa.id_atividade = a.id_atividade
            WHERE pa.id_produto = "'.$id_produto.'"
           ';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }
      
      
    
    function getInfosProduto($id_produto){
           global $DB;
           $select = '  SELECT * FROM produto_info
                        WHERE id_produto = "'.$id_produto.'"';  
           
           if($ret = $DB->GetAll($select)){
                return $ret;
           }else{
                return $DB->ErrorMsg();
           }
      }   
    
}
       

?>
