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
    
    
                 
               
             
    
    
    
    
}
       

?>
