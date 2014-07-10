<?php
include MODELS.'home/homeModel.php';
class home extends Controller{
    function index(){
      
      if($_SESSION['loginADM']){
          $this->Dashboard();
      }else{
          $this->Login();
      }
      
    }
    
    function Login(){   
         $html = $this->dwoo->get('app/views/login.tpl');
         echo $html;  
    }
    function MakeLogin(){
        $dados = $_REQUEST;
        $dados['senha'] = md5($dados['senha']);
        
        $model = new homeModel;
        $ret = $model->login($dados);
        if(isset($ret[0])){
            $_SESSION['loginADM'] = $ret[0];
            $_SESSION['loginADM']['acesso'] = $this->getMenu($ret[0]['id_user']);
            
            $retorno['status'] = true;
            $retorno['retorno'] = $ret[0];
        }else{
            $retorno['status'] = false;    
            $retorno['retorno'] = $dados;
        }
        echo json_encode($retorno);
       
    }
    
    function ajaxMakeMenu(){
        echo '<pre>';
        $_SESSION['loginADM']['acesso'] = $this->getMenu($_SESSION['loginADM']['id_user']);  
        print_r($_SESSION['loginADM']);
        
        
    }
    
    function ajaxGetDadosGrafico(){
         $model = new homeModel();
        $data_antiga =  date('Y-m-01');
       $data_mais =  date('Y-m-d');
       $diferenca = strtotime($data_mais) - strtotime($data_antiga);
       $dias = (int)floor( $diferenca / (60 * 60 * 24));
       // CRIA ARRAY COM OS DIAS
       for ($i = 0; $i <= $dias; $i++) {
            $data_atual =  date('Y-m-d', strtotime("+".$i." days",strtotime($data_antiga)));
            $calendar[]['days'] = $data_atual;
       }  
       
       
  $grafico['pedido'] = $model->getDadosPedidoGrafico();
  $grafico['motoboy'] = $model->getDadosMotoboyGrafico();
  $grafico['users'] = $model->getDadosUsersGrafico();
  
 
  $c = 0;
  $dGrafico['series'][0]['name'] = 'Pedidos';
  $dGrafico['series'][1]['name'] = 'Motoboys';
  $dGrafico['series'][2]['name'] = 'Usuários';
  
  foreach($calendar as $k=>$v){
     
     $dUTC = explode('-',$v['days']);
     $dataUTC = $dUTC[0].','.($dUTC[1] - 1).','.$dUTC[2];
     
     
     $cP = 0;
     foreach($grafico['pedido'] as $pk => $pv){
         if($pv['dia'] == $dUTC[2]){
           
            $dGrafico['series'][0]['dados'][$cP]['data'] =  $dataUTC;
            $dGrafico['series'][0]['dados'][$cP]['total'] = $pv['total'];         
         }
      $cP++;
     }
     
     $cM = 0;
     foreach($grafico['motoboy'] as $mk => $mv){
         if($mv['data'] == $v['days']){
            $dGrafico['series'][1]['dados'][$cM]['data'] =  $dataUTC;
            $dGrafico['series'][1]['dados'][$cM]['total'] =$mv['total'];         
         }
         $cM ++;
     }    
     $cUser = 0;
     foreach($grafico['users'] as $uk => $uv){
         if($uv['data'] == $v['days']){
            $dGrafico['series'][2]['dados'][$cUser]['data'] =  $dataUTC; 
            $dGrafico['series'][2]['dados'][$cUser]['total'] = $uv['total'];         
         }
      $cUser++;   
     }
     
     
     $c++;
     
     
     
 }
 
  if($_GET['d']){
      echo '<pre>';
        print_r($calendar);
        print_r($grafico);
        print_r($dGrafico);
      echo '</pre>';
  }
 
                 
    return $dGrafico;
 }
    
    function Dashboard(){
       $data = array();
       $model = new homeModel();
       
       
       $rTotal = $model->getTotalAcessos();
       $totalAcessos = $rTotal[0]['total'];
                        
       
       $rHoje = $model->getTotalAcessosHoje();
       $totalHoje['hoje'] = $rHoje[0]['total_hoje'];
       $totalHoje['antes'] = $rHoje[0]['total_antes'];
       $totalHoje['crescimento'] = abs($rHoje[0]['total_hoje'] - $rHoje[0]['total_antes']);
       
       $Prod = $model->getTotalAcessosProd();
            
       
       $totalProd['hoje'] = ($Prod[0]['total_hoje'] > 0) ? $Prod[0]['total_hoje']: 0;
       $totalProd['antes'] = ($Prod[0]['total_antes'] > 0) ? $Prod[0]['total_antes']: 0;
       $totalProd['crescimento'] = abs($totalProd['hoje'] - $totalProd['antes']);
       
       
       $Cat = $model->getTotalAcessosCat();
       $totalCat['hoje'] = ($Cat[0]['total_hoje'] > 0) ? $Cat[0]['total_hoje']: 0;
       $totalCat['antes'] = ($Cat[0]['total_antes'] > 0) ? $Cat[0]['total_antes']: 0;
       $totalCat['crescimento'] = abs($totalCat['hoje'] - $totalCat['antes']);
       
       $Eve = $model->getTotalAcessosEve();
       $totalEve['hoje'] = ($Eve[0]['total_hoje'] > 0) ? $Eve[0]['total_hoje']: 0;
       $totalEve['antes'] = ($Eve[0]['total_antes'] > 0) ? $Eve[0]['total_antes']: 0;
       $totalEve['crescimento'] = abs($totalEve['hoje'] - $totalEve['antes']);
       
       
       $Not = $model->getTotalAcessosNot();
       $totalNot['hoje'] = ($Not[0]['total_hoje'] > 0) ? $Not[0]['total_hoje']: 0;
       $totalNot['antes'] = ($Not[0]['total_antes'] > 0) ? $Not[0]['total_antes']: 0;
       $totalNot['crescimento'] = abs($totalNot['hoje'] - $totalNot['antes']);

      # echo '<pre>';  
      # print_r($totalHoje);
      # print_r($totalProd);
      # print_r($totalCat);
      # print_r($totalEve);
      # print_r($totalNot);
      # die();
     
       
       
       
       $data['content'][0]['size'] = 2;
       $data['content'][0]['name'] = 'Hoje';
       $data['content'][0]['icon'] = 'icon-user';
       $data['content'][0]['html'] = $this->dwoo->get('app/views/home/total_views.tpl', $totalHoje);
       
       $data['content'][1]['size'] = 2;
       $data['content'][1]['name'] = 'Produtos';
       $data['content'][1]['icon'] = 'icon-user';
       $data['content'][1]['html'] = $this->dwoo->get('app/views/home/total_views.tpl', $totalProd);
       
       $data['content'][2]['size'] = 2;
       $data['content'][2]['name'] = 'Eventos';
       $data['content'][2]['icon'] = 'icon-user';
       $data['content'][2]['html'] = $this->dwoo->get('app/views/home/total_views.tpl', $totalEve);
       
       $data['content'][3]['size'] = 2;
       $data['content'][3]['name'] = 'Noticías';
       $data['content'][3]['icon'] = 'icon-user';
       $data['content'][3]['html'] = $this->dwoo->get('app/views/home/total_views.tpl', $totalNot);
       
       
       $data['content'][4]['size'] = 2;
       $data['content'][4]['name'] = 'Categorias';
       $data['content'][4]['icon'] = 'icon-user';
       $data['content'][4]['html'] = $this->dwoo->get('app/views/home/total_views.tpl', $totalCat);
       
       
       $data['content'][5]['size'] = 2;
       $data['content'][5]['name'] = 'Total Acessos';
       $data['content'][5]['icon'] = 'icon-user';
       $data['content'][5]['html'] = '<h1 class="total_acessos">'.$totalAcessos.'</h1>';
       
       
       
       
       
       /*
       
       
       $data['content'][5]['size'] = 6;
       $data['content'][5]['name'] = 'Top 10 Produtos';
       $data['content'][5]['icon'] = 'icon-user';
       $data['content'][5]['html'] = '---------------------------------------------';
       
       $data['content'][6]['size'] = 6;
       $data['content'][6]['name'] = 'Top 10 Categorias';
       $data['content'][6]['icon'] = 'icon-user';
       $data['content'][6]['html'] = '---------------------------------------------';
       
       $data['content'][7]['size'] = 6;
       $data['content'][7]['name'] = 'Top 10 Eventos';
       $data['content'][7]['icon'] = 'icon-user';
       $data['content'][7]['html'] = '---------------------------------------------';
       
       $data['content'][8]['size'] = 6;
       $data['content'][8]['name'] = 'Top 10 Artigos';
       $data['content'][8]['icon'] = 'icon-user';
       $data['content'][8]['html'] =  '---------------------------------------------';
       
       */                       
   
        
      $html = $this->dwoo->get('app/views/index.tpl', $data);
      echo $html;  
    }
    

    function ajaxSESS(){
        echo '<pre>';
            print_r($_SESSION);
        echo '</pre>';
    }
    
    
    
    function Logout(){
        unset($_SESSION);
        session_destroy();
        if(!$_SESSION['login']){
            $retorno['status'] = true;
        }else{
            $retorno['status'] = false;    
        }
        echo json_encode($retorno);
    }
    
    function getStats(){
          $model = new homeModel;
          $ret = $model->getStats();    
          
          $retorno = $ret[0];
          
          $retorno['total_envio_valor'] = $retorno['total_envio_valor'] + $retorno['total_aceitou']  + $retorno['total_recusados'] + $retorno['total_nao_repsondeu']  ;
          $retorno['total_envio_valor_percent'] = round((($retorno['total_enviou_valor'] / $retorno['total']) * 100));
          $retorno['total_aceitou_percent'] = round((($retorno['total_aceitou'] / $retorno['total']) * 100));
          $retorno['total_recusados_percent'] = round((($retorno['total_recusados'] / $retorno['total']) * 100));
          $retorno['total_nao_respondeu_percent'] = round((($retorno['total_nao_respondeu'] / $retorno['total']) * 100));
          /*
            Array
            (
                [0] => 32
                [total] => 32
                [1] => 21
                [total_enviou_valor] => 21
                [2] => 9
                [total_aceitou] => 9
                [3] => 1
                [total_recusados] => 1
                [4] => 1
                [total_nao_repsondeu] => 1
                [total_envio_valor_percent] => 65.625
                [total_aceitou_percent] => 28.125
                [total_recusados_percent] => 3.125
                [total_nao_repsondeu_percent] => 3.125
            )
          */  
          
          $_SESSION['stats'] = $retorno;
          
          
    }
    
    function VerificaPedidoClientes(){
       $model = new homeModel();
       $ret = $model->getEmailClienteSemResposta();
       foreach($ret as $k=>$v){
           $to = $v['email'];
           $to_name = $v['nome'];
           $subject = 'Comunicado - VaiMoto';
           $content = $this->dwoo->get('app/views/emails/comunicado_vaimoto.tpl',$v);
           $this->sendEmail($to,$to_name = '',$subject,$content,'bruno.mendes@vaimoto.com.br');
       }
       $dados = array();
       $dados['clientes'] = $ret;
       echo  $content = $this->dwoo->get('app/views/emails/lista_comunicado_vaimoto.tpl',$dados);
       $to[1]= 'bruno.mendes@vaimoto.com.br';
       $to[2]= 'daniel@dcanm.com.br';
       $to[3]= 'rrsilvadev@gmail.com';
       $to_name = 'Rafael Rodrigues';
       $subject = "Lista Clientes - Sem Resposta Motoboy's";
       $ret = $this->sendEmail($to,$to_name = '',$subject,$content,'sys@vaimoto.com.br');
    }
    
    function nao_existe(){
        
        echo '<center><h1>ERRO 404</h1></center>';
    }
    
}
?>
