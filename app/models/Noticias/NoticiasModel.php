<?php
     
class NoticiasModel extends Model{
    
    
    function getNoticias($pagina){
        global $DB;
        /*  COM PAGINAÇÃO
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM vm_noticias 
                WHERE status = 1
                ORDER BY data,id_noticia DESC
                LIMIT ".$pagina." , 10
                ";
        */        
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM artigos 
                WHERE status = 1
                ORDER BY artigos.data DESC , artigos.id_artigo DESC
                ";        
                
                
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
               
    function GetAll(){
       global $DB;
        $sql = "SELECT * FROM artigos
                WHERE status = 1 
                ORDER BY data DESC
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }  
    }
    function DataAlias($dados){
       global $DB;
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada  FROM artigos 
                WHERE alias = '".$dados['alias']."'
                AND status = 1 
                ORDER BY data DESC
                ";
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }  
    }
    
}
       

?>