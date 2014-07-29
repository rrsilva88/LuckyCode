<?php

class homeModel extends Model{
    
    function login($dados){
        global $DB;
        $sql = "SELECT * FROM sys_users 
                WHERE 
                email='".$dados['email']."'
                and
                senha = '".$dados['senha']."'
                and status = 1 
                ";
        $dados = $DB->GetAll($sql);
        
       
        if(is_array($dados)){
            return $dados;
        }else{
            var_dump($DB->ErrorMsg());
            return false;
        }
    }
    
    function SaveContaInsta($dados){
        
         global $DB;
        
        $sql = "
        INSERT INTO contas_user (id_user,instagram_id,nome,username,picture,access_token,code,status) 
            VALUES (".$dados['id_user'].",".$dados['instagram_id'].",'".$dados['nome']."','".$dados['username']."','".$dados['picture']."','".$dados['access_token']."','".$dados['code']."',1)
        ON DUPLICATE KEY UPDATE 
            nome = '".$dados['nome']."',
            username = '".$dados['username']."',
            picture = '".$dados['picture']."',
            access_token = '".$dados['access_token']."',
            code = '".$dados['code']."'
        ;
        ";
       ;
        if($dados = $DB->Execute($sql)){
            return true;
        }else{
            var_dump($DB->ErrorMsg());
            return false;
        }
        
    }
    
    
                 
               
             
    
    
    
    
}
       

?>
