<?php

class EmailModel extends Model{
    
    function getAllCadastrados(){
        global $DB;
        $sql = "
                SELECT * FROM 
                users
                ;
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
  

}   