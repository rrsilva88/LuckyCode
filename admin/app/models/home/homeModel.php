<?php

class homeModel extends Model{
    
    function login($dados){
        global $DB;
        $sql = "SELECT * FROM sys_users 
                WHERE 
                email='".$dados['email']."'
                and
                senha = '".$dados['senha']."'
                ";
        $dados = $DB->GetAll($sql);
        
       
        if(is_array($dados)){
            return $dados;
        }else{
            var_dump($DB->ErrorMsg());
            return false;
        }
    }
    
    function GetDataUsers(){
         global $DB;
        $sql = 'SELECT COUNT(*) as total,DATE_FORMAT(data_criado,"%d-%m-%Y") as data FROM nm_user
WHERE DATE_FORMAT(data_criado,"%m-%Y") = DATE_FORMAT(NOW(),"%m-%Y")
GROUP BY DATE_FORMAT(data_criado,"%d-%m-%Y");';
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    function GetDataPedidos(){
         global $DB;
        $sql = 'SELECT COUNT(*) as total,DATE_FORMAT(data_requisicao,"%d-%m-%Y") as data FROM nm_pedido
WHERE DATE_FORMAT(data_requisicao,"%m-%Y") = DATE_FORMAT(NOW(),"%m-%Y")
GROUP BY DATE_FORMAT(data_requisicao,"%d-%m-%Y");';
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function GetDataMotoboy(){
         global $DB;
        $sql = 'SELECT COUNT(*) as total,DATE_FORMAT(data,"%d-%m-%Y") as data FROM nm_motoboy
WHERE DATE_FORMAT(data,"%m-%Y") = DATE_FORMAT(NOW(),"%m-%Y")
GROUP BY DATE_FORMAT(data,"%d-%m-%Y");';
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getEmailClienteSemResposta(){
        global $DB;
        $sql = 'SELECT * FROM nm_pedido 
                INNER JOIN nm_user
                ON nm_user.id_user = nm_pedido.id_user
                WHERE 
                DATE_FORMAT(nm_pedido.data_requisicao,"%Y-%m-%d") = DATE_ADD(DATE(CURRENT_TIMESTAMP), INTERVAL -1 DAY)
                AND nm_pedido.status = 1;
                
                ';
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getDadosPedidoGrafico(){
       global $DB;
       
        $sql ='SELECT COUNT(DISTINCT(id_pedido)) as total,DATE_FORMAT(data_requisicao,"%Y-%m-%d") as data,
        DATE_FORMAT(data_requisicao,"%d") as dia, 
        DATE_FORMAT(data_requisicao,"%m") as mes, 
        DATE_FORMAT(data_requisicao,"%Y") as ano 
        FROM nm_pedido WHERE DATE_FORMAT(data_requisicao,"%m/%Y") = "'.date("m/Y").'" GROUP BY DATE_FORMAT(data_requisicao,"%d/%m/%Y")';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getDadosMotoboyGrafico(){
       global $DB;
       
        $sql ='SELECT COUNT(DISTINCT(id_motoboy)) as total,DATE_FORMAT(data,"%Y-%m-%d") as data,
        DATE_FORMAT(data,"%d") as dia, 
        DATE_FORMAT(data,"%m") as mes, 
        DATE_FORMAT(data,"%Y") as ano 
        FROM nm_motoboy WHERE DATE_FORMAT(data,"%m/%Y") = "'.date("m/Y").'" GROUP BY DATE_FORMAT(data,"%d/%m/%Y")';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getDadosUsersGrafico(){
       global $DB;
       
        $sql ='SELECT COUNT(DISTINCT(id_user)) as total,DATE_FORMAT(data_criado,"%Y-%m-%d") as data,
        DATE_FORMAT(data_criado,"%d") as dia, 
        DATE_FORMAT(data_criado,"%m") as mes, 
        DATE_FORMAT(data_criado,"%Y") as ano 
        FROM nm_user WHERE DATE_FORMAT(data_criado,"%m/%Y") = "'.date("m/Y").'" GROUP BY DATE_FORMAT(data_criado,"%d/%m/%Y")';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    
    
     function getTotalUser(){
       global $DB;
       
        $sql ='
               
               SELECT COUNT(DISTINCT(id_user)) as total,(SELECT COUNT(DISTINCT(id_user)) as total
               FROM nm_user WHERE DATE_FORMAT(data_criado,"%m/%Y") = "'.date("m/Y").'") as total_mes
               FROM nm_user
               ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
     function getTotalMotoboy(){
       global $DB;
       
         $sql ='SELECT COUNT(DISTINCT(id_motoboy)) as total,(SELECT COUNT(DISTINCT(id_motoboy)) as total 
        FROM nm_motoboy WHERE DATE_FORMAT(data,"%m/%Y") = "'.date("m/Y").'") as total_mes 
        FROM nm_motoboy ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    
    
    function getTotalPedido(){
       global $DB;
       
        $sql ='SELECT COUNT(DISTINCT(id_pedido)) as total,(SELECT COUNT(DISTINCT(id_pedido)) as total
        FROM nm_pedido WHERE DATE_FORMAT(data_requisicao,"%m/%Y") = "'.date("m/Y").'" ) as total_mes
        FROM nm_pedido';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    
    
    function getTopBairros(){
       global $DB;
       
        $sql ='SELECT remetente_bairro,COUNT(id_pedido) as total  FROM nm_pedido WHERE remetente_bairro != "" GROUP BY remetente_bairro ORDER BY total DESC LIMIT 10;';
        $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getTopUsers(){
          global $DB;
        $sql ='SELECT np.id_user,nu.nome,COUNT(id_pedido) as total  FROM nm_pedido np
        INNER JOIN nm_user nu 
        ON nu.id_user = np.id_user
        GROUP BY np.id_user ORDER BY total DESC LIMIT 10';
        
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
        
    }
    
    function getTopMotoboys(){
      global $DB;     
        $sql = "
        SELECT npm.id_motoboy,nm.nome,COUNT(id_pedido_motoboy) as total,
        (SELECT COUNT(id_pedido_motoboy) as total  FROM nm_pedido_motoboy npm2 INNER JOIN nm_pedido np ON np.id_pedido = npm2.id_pedido WHERE npm2.status = 2 and id_motoboy = npm.id_motoboy  AND np.status = 3  ) as total_concluidas  
        FROM nm_pedido_motoboy npm
        INNER JOIN nm_motoboy nm
        ON nm.id_motoboy = npm.id_motoboy
        GROUP BY npm.id_motoboy ORDER BY total_concluidas DESC ,total DESC   LIMIT 10
        
        ";
        
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
    }
    
    function getPreMotoboy(){
         global $DB;    
        $sql = "
        
        SELECT count(*) as total FROM nm_pre_motoboy;
        ";
          
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }  
     
    
    function getStatusMotoboy(){
         global $DB;    
        $sql = "
        
        SELECT count(*) as total,status FROM nm_motoboy GROUP BY status ORDER BY status ASC;
        ";
           $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            
            
            foreach($dados as $k=>$v){
                 switch($v['status']){
                            case '0':
                            case 0:
                             #$dados[$k]['nome_status'] = 'Indisponivel';
                             $ret['indisponivel']['nome'] = 'Indisponivel';
                             $ret['indisponivel']['total'] = $v['total'];
                            break;
                            
                            case '1':
                            case 1:
                            #$dados[$k]['nome_status'] = 'Disponivel';
                            $ret['disponivel']['nome'] = 'Disponivel';
                            $ret['disponivel']['total'] = $v['total'];
                             
                            break;
                            
                            case '2':
                            case 2:
                               # $dados[$k]['nome_status'] = 'Entregando';
                                $ret['entregando']['nome'] = 'Entregando';
                                $ret['entregando']['total'] = $v['total'];
                                
                            break;
                            
                            case '3':
                            case 3:
                             #$dados[$k]['nome_status'] = 'Cotando';
                              $ret['cotando']['nome'] = 'Cotando';
                              $ret['cotando']['total'] = $v['total'];
                            break;
                            
                            case '4':
                            case 4:
                                #$dados[$k]['nome_status'] = 'Bloqueado';
                                $ret['bloqueado']['nome'] = 'Bloqueado';
                                $ret['bloqueado']['total'] = $v['total'];
                            break;
                            
                            case '5':
                            case 5:
                            
                                #$dados[$k]['nome_status'] = 'Em Analise';
                                $ret['em_analise']['nome'] = 'Em Analise';
                                $ret['em_analise']['total'] = $v['total'];
                            break;
                            
                            
                        }
                
            }
            return $ret;
        }else{
            return false;
        } 
    }
    
    
    function getTotalAcessos(){
        
        
        
            global $DB;    
        $sql = "
            SELECT count(*) total FROM views;
        ";
          
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
        
        
                          
    }
    
    function getTotalAcessosHoje(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'" ) as total_hoje,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'" ) as total_antes
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    
    function getTotalAcessosProd(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'"   AND type = 1 ) as total_hoje,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'"   AND type =1 ) as total_antes
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    
    function getTotalAcessosCat(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'" AND type =2) as total_hoje ,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'"   AND type =2) as total_antes
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    
    function getTotalAcessosNot(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'"  AND type =3) as total_hoje,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'" AND type =3 ) as total_antes  
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    function getTotalAcessosMenu(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'" AND type =4) as total_hoje  ,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'" AND type =4) as total_antes  
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
    
    
    
    function getTotalAcessosEve(){
        global $DB;    
        $sql = '
            SELECT (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.date("m/Y/d").'" AND type =5) as total_hoje ,
            (SELECT count(*) total FROM views
            WHERE DATE_FORMAT(data,"%m/%Y/%d") = "'.gmdate("m/Y/d", time()-(3600*27)).'" AND type =5) as total_antes  
            ;
        ';
         $dados = $DB->GetAll($sql);
        if(is_array($dados)){
            return $dados;
        }else{
            return false;
        } 
    }
             
    
    
    
    
}
       

?>
