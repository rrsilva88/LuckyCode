<?php

include MODELS.'Atividades/AtividadesModel.php';
include MODELS.'Contas/ContasModel.php';

class Cron extends Controller{
    function index(){
        
    }
    
    function ListAtividades(){
        $mAtividades = new AtividadesModel();
        $atividades = $mAtividades->GetAll();
        if(is_array($atividades)){
            foreach($atividades as $k=>$v){
                echo $action = BASE_URL.'Cron/ExecAtividade/'.$v['id_atividade']; 
                echo '<br>';
                echo '<br>';
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$action);
                curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
                curl_setopt($ch, CURLOPT_TIMEOUT_MS, 1);
                curl_exec($ch);
                curl_close($ch);        
            }
        }
        
        
        
    }
    
    function ExecAtividade($id_atividade = null){
         global $instagram;
         $params = $this->getParams();
         if(is_null($id_atividade)){
            $id_atividade = $params['0'];
         }
         $mAtividades = new AtividadesModel();
         $mContas = new ContasModel();
         $ret = $mAtividades->Data($id_atividade);
         $updateStatus['status'] = 2;
         $updateStatus['id_atividade'] = $id_atividade;
         
         $mAtividades->Update($updateStatus);
         if(is_array($ret)){
             $atividade = $ret['0'];
             $total_pag = ceil($atividade['quantidade'] / 100);
             
             $total_robots = $mContas->getTotalRobots();
             $total_pag_robos = ceil($total_robots / 100);
             
             $total_logs = $mContas->getTotalLogs($atividade['id_atividade']);
             $logs = $total_logs;
             // Caso o total de robos ativos for menos que a quantidade da atividade;
             if($total_pag_robos < $total_pag){
                $total_pag = $total_pag_robos;
             }
          // Executa por quantidade de paginas   
          for($i = 0; $i <= $total_pag; $i++){
                  // Busca 100 contas randomicas 
                  $contas = $mContas->GetRobots(100,$atividade['id_atividade']); 
                ;
                  if(is_array($contas)){
                      foreach($contas as $k=>$v){
                            $instagram->setAccessToken($v['access_token']);
                            $user = $instagram->getUser();
                            switch($atividade['tipo']){
                                 case 1:  // LIKE
                                 case '1':  // LIKE
                                    $app = $instagram->likeMedia($atividade['insta_media_id']);
                                 break;
                                 case 2:  // COMMENT
                                 case '2':  // COMMENT
                                    $atividade['hashtags'] = str_replace('#','',trim($atividade['hashtags']));
                                    $tags = explode(',',$atividade['hashtags']);
                                    $limit = count($tags);
                                    $text = '';
                                    for($i=0;$i <= rand(0,$limit);$i++){
                                        
                                        $text.= "#".$tags[$i].' ';
                                    }
                                    echo $text;
                                    
                                    $app = $instagram->addMediaComment($atividade['insta_media_id'], $text);
                                 break;
                                 case 3: // FOLLOW
                                 case '3': // FOLLOW
                                    $app =  $instagram->modifyRelationship('follow', $atividade['insta_user_id']);
                                 break;
                                 case 4: // UNFOLLOW
                                 case '4': // UNFOLLOW
                                    $app =  $instagram->modifyRelationship('unfollow', $atividade['insta_user_id']);          
                                 break;
                            }
                            
                            if($app->meta->code == 200){
                                $log['id_conta'] = $v['id_robo'];
                                $log['id_atividade'] = $atividade['id_atividade'];
                                if(isset($text)){
                                    $log['comentario'] = $text;
                                }
                                $log['data'] = date("Y/m/d h:i:s");
                                $mAtividades->SaveLog($log);   
                                $logs++;
                            }else{
                                $updateRobo['id_conta'] = $v['id_robo'];
                                $updateRobo['status'] = 2;
                                $updateRobo['status_message'] = $app->meta->error_message;
                                $mContas->UpdateRobo($updateRobo);
                            }
            #                sleep(1);
                       }
                   }
           #  sleep(5);
          }
          
          if($logs >= $atividade['quantidade']){
             $updateStatus['status'] = 3;
             $updateStatus['id_atividade'] = $id_atividade;
             $mAtividades->Update($updateStatus); 
          }
           
        }else{
            die();        
        }
    }
        
    
}
?>
