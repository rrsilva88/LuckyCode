<?php

class UsuariosModel extends Model{
    
    function Get($dados){
       global $DB;
       $select = 'SELECT * FROM nm_user WHERE id_user ="'.$dados['id_user'].'";';  
       
       if($ret = $DB->GetAll($select)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
    }
  
    
     function getStats($dados){
        global $DB;
        $sql = "SELECT 
                (SELECT count(*)  FROM nm_pedido WHERE id_user ='".$dados['id_user']."') as total,
                (SELECT count(*)  FROM nm_pedido WHERE id_user ='".$dados['id_user']."' AND status=1) as total_ativo,
                (SELECT count(*)  FROM nm_pedido WHERE id_user ='".$dados['id_user']."' AND status=2) as total_entregando,
                (SELECT count(*)  FROM nm_pedido WHERE id_user ='".$dados['id_user']."' AND status=3) as total_entregue,
                (SELECT count(*)  FROM nm_pedido WHERE id_user ='".$dados['id_user']."' AND status=4) as total_cancelado
                ;";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
    
    
    
      function Query($sql){
        global $DB;
       
       
       if($ret = $DB->GetAll($sql)){
            return $ret;
       }else{
            return $DB->ErrorMsg();
       }
      }
    
    
    
    function Update($dados){
            global $DB;
            $id_user = $dados['id_user']; 
            unset($dados['id_user']);
            $ret = $this->autoUpdate('nm_user',$dados,'WHERE id_user="'.$id_user.'"');
            if(!$ret){
                return $DB->ErrorMsg();  
                  
            }else{
                return $ret;  
            }
            
    }
    
    
   
   
    
}



?>