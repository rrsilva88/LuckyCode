<?php
include MODELS.'Push/PushModel.php';
class Push extends Controller{
    function index(){
      $dados = array();
      $dados['title'] = 'Push Notification';
      
      
       $dados['content'][1]['size'] = 4;
       $dados['content'][1]['name'] = 'Sistema de Push';
       $dados['content'][1]['icon'] = 'icon-bullhorn';
       $dados['content'][1]['html'] = $this->dwoo->get('app/views/push/index.tpl');
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Enviar';
       $dados['content'][1]['footer'][1]['onclick'] = "SendPush();"; 
       
       $dados['content'][2]['size'] = 8;
       $dados['content'][2]['name'] = 'Status Envio';
       $dados['content'][2]['icon'] = 'icon-cloud-upload';
       $dados['content'][2]['html'] = $this->dwoo->get('app/views/push/status.tpl');
           
      $html = $this->dwoo->get('app/views/index.tpl', $dados);
      echo $html;  
    }
    
    function ajaxConfigPush(){
        $dados = $_POST;
        
        $model = new PushModel();
        switch($dados['filtro']){
            case '1':   // Todos os cadastrados
                $motoboys = $model->getAllCadastrados();
            break;
            
            case '2':   // Todos disponíveis
                $motoboys = $model->getAllDisponiveis();
            break;
            
            case '3': // Todos indisponívies
                $motoboys = $model->getAllIndisponiveis();
            break;
            
            case '4': // Todos que fizeram corrida nos ultimos 7 dias
                $motoboys = $model->getAllCorridas();
            break;
        }       
             
         if(count($motoboys) > 0){
            foreach($motoboys as $k => $v){
                        $results['id_motoboy'] = $v['id_motoboy'];
                        $results['method'] = 'message';
                        $results['message'] = $dados['mensagem'];
                        $message = $dados['mensagem'];
                        $ret = $this->sendGCM(array($v['token_push']),$message,$results);
                        if($ret['success'] == 1){
                            $push['status_envio']  = 1;
                            $motoboys[$k]['envio_gsm'] = 'Enviado';
                        }else{
                            $motoboys[$k]['envio_gsm'] = 'Não enviado';  
                            $push['status_envio']  = 0;  
                        }
                        
                        
                        
                        $push['id_motoboy'] =  $v['id_motoboy'];
                        $push['mensagem'] =  $dados['mensagem'];
                        $push['data'] =  date('Y-m-d H:i:s');
                        $model->savePush($push);
                        
                        
                        
                        
            }
        }else{
            $motoboys = array();
        }
          $data['motoboys'] = $motoboys;
          $html = $this->dwoo->get('app/views/push/lista_motoboys.tpl',$data);
          echo $html;
    }
    
}    

?>
