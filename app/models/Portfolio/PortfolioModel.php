<?php
     
class PortfolioModel extends Model{
    
    
    function getportifolio(){
        global $DB;
        /*  COM PAGINAÇÃO
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM vm_portifolio 
                WHERE status = 1
                ORDER BY data,id_noticia DESC
                LIMIT ".$pagina." , 10
                ";
        */        
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM portifolio 
                WHERE status = 1
                ORDER BY portifolio.data DESC , portifolio.id_tutorial DESC
                ";        
                
                
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
    
    function getRandom(){
        global $DB;
       $sql =" SELECT * FROM `portifolio` ORDER BY RAND() LIMIT 0,9";
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        }
        
        
    }
    function TotalPaginas(){
       $sql = "SELECT count(*) as total FROM portifolio 
                WHERE status = 1
                ";    
                 global $DB;
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
           # $dados[0]['total'] = 32;
            $total = round($dados[0]['total'] / 10);
            return $total;
        }else{
            return 0;
        }          
                 
        
        
    }
               
    function GetAll($pagina = 0){
       global $DB;
       $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada FROM portifolio
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
        $sql = "SELECT *,DATE_FORMAT( `data` , '%d/%m/%Y') as data_formatada  FROM portifolio 
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