<?php

class SMSModel extends Model{
    
    function getAllCadastrados(){
        global $DB;
        $sql = "
                SELECT id_motoboy,nome,token_push,tel_celular FROM 
                nm_motoboy
                WHERE tel_celular != '';
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
    
    function getAllDisponiveis(){
        global $DB;
        $sql = "
                SELECT id_motoboy,nome,token_push,tel_celular FROM 
                nm_motoboy
                WHERE tel_celular != ''
                AND status = 1;
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
    
    function getAllIndisponiveis(){
        global $DB;
        $sql = "
                SELECT id_motoboy,nome,token_push,tel_celular FROM 
                nm_motoboy
                WHERE tel_celular != ''
                AND status = 0
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    }
       
    function getAllCorridas(){
        global $DB;
        $sql = "
                SELECT m.id_motoboy,m.nome,m.token_push,m.tel_celular,DATE_FORMAT(data_requisicao,'%Y-%m-%d') as data_requisicao 
                FROM nm_pedido_motoboy npm 
                INNER JOIN nm_pedido np
                ON np.id_pedido = npm.id_pedido
                INNER JOIN nm_motoboy m ON m.id_motoboy = npm.id_motoboy
                WHERE np.status = 3
                AND npm.status = 2 
                AND m.tel_celular != '' 
                AND DATE_FORMAT(data_requisicao,'%Y-%m-%d') >= '".date('Y-m-d', strtotime('-7 days',strtotime(date('Y-m-d'))))."';
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
    
    
} 

}   