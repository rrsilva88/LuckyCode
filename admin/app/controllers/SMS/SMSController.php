<?php
include MODELS.'SMS/SMSModel.php';
class SMS extends Controller{
    function index(){
      $dados = array();
      $dados['title'] = 'SMS - Short Message Service';
      
      
       $dados['content'][1]['size'] = 4;
       $dados['content'][1]['name'] = 'Sistema de SMS';
       $dados['content'][1]['icon'] = 'icon-tablet';
       $dados['content'][1]['html'] = $this->dwoo->get('app/views/sms/index.tpl');
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Enviar';
       $dados['content'][1]['footer'][1]['onclick'] = "SendSMS();"; 
       
       $dados['content'][2]['size'] = 8;
       $dados['content'][2]['name'] = 'Status Envio';
       $dados['content'][2]['icon'] = 'icon-cloud-upload';
       $dados['content'][2]['html'] = $this->dwoo->get('app/views/sms/status.tpl');
           
      $html = $this->dwoo->get('app/views/index.tpl', $dados);
      echo $html;  
    }
    
    function ajaxConfigSMS(){
        $dados = $_POST;
        
        $model = new SMSModel();
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
                        $message = str_replace('{nome}',$v['nome'],$dados['mensagem']);
                        $ret = $this->sendSMS($message,$v['tel_celular']);
                        if($ret['success'] == 1){
                            $push['status_envio']  = 1;
                            $motoboys[$k]['envio_gsm'] = 'Enviado';
                        }else{
                            $motoboys[$k]['envio_gsm'] = 'Não enviado';  
                            $push['status_envio']  = 0;  
                        }
                        
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

