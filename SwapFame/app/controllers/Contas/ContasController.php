<?php
include MODELS.'Contas/ContasModel.php';

class Contas extends Controller{
    function index(){
        $model = new ContasModel();
        $data['sidebar'] = true;
        $this->getContasInstagram();
        $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Contas/list.tpl');
        $html = $this->dwoo->get('app/views/index.tpl', $data);
        echo $html; 
    }
    function Visualizar(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_user'] = $params[0]; 
         $model = new ContasModel();
         $uData = $model->Data($dados['id_user']);
         echo "<pre>";
         print_r($uData);
        /*
         $dados['title'] = '#'.$uData['0']['id_user'].' '.$uData['0']['nome'];
         $dados['usuario'] = $uData[0];
         $data['sidebar'] = true;   
         $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Contas/view.tpl', $dados);
         */
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;  
      
    
    }
    
    function Criar(){
        
        if(isset($_SESSION['accounts'])){
            
             global $instagram;
             $instagram->setAccessToken($_SESSION['accounts'][0]['access_token']);
           #  $feed = $instagram->getUserMediaPag('self',20,'742694257546252578_275684371');
             $feed = $instagram->getUserMediaPag('self',20);
             #$feed = $instagram->getUserFeed();
             
             if(isset($feed->meta->error_type)){
                  $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/error_callback_instagram.tpl');  
             }else{
                 $result = $instagram->pagination($feed);
                 
                 
                 
                 $dados['api'] = $this->object_to_array_recusive($result);
                 
             #    echo '<pre>';
             #    print_r($dados['api']);
             #    die();
                 $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Contas/list.tpl',$dados);
                 $scroll['max_id'] = $dados['api']['pagination']['next_max_id'];
                 $data['content']['rows'][1]['widgets'][2] =  $this->dwoo->get('app/views/Contas/ScriptScroll.tpl',$scroll);
             }
             
             
        }else{
            $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/login_instagram.tpl');
        }
            
        $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;  
      
    }
    
    function Configurar(){
       global $instagram;
       $params = $this->getParams();
       $tipo = $params[0];
       $instagram->setAccessToken($_SESSION['accounts'][0]['access_token']);
       switch($tipo){
           case 'Midia':
               $media_id = $params[1];
               $media = $instagram->getMedia($media_id);
               $result = $this->object_to_array_recusive($media);
               $dados = array();
               $dados['pic'] = $result['data'];
               $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Contas/config_media.tpl',$dados);        
           break;
           case 'Seguidores':
           
           break;
       }
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;    
    }
    
    function ajaxGetPaginaFeed(){
             global $instagram;
             $instagram->setAccessToken($_SESSION['accounts'][0]['access_token']);
             $feed = $instagram->getUserMediaPag('self',20,$_GET['max_id']);
             
             if(isset($feed->meta->error_type)){
                 $ret['status'] = false;
             }else{
                 $result = $instagram->pagination($feed);
                 $dados['api'] = $this->object_to_array_recusive($result);
                 $ret['status'] = true;
                 $ret['html'] =  $this->dwoo->get('app/views/Contas/list_clear.tpl',$dados);
                 $ret['max_id'] = $dados['api']['pagination']['next_max_id'];
             }
             
             echo json_encode($ret);
             
        
        
    }
    
    function ajaxUpdate(){
       $dados = $_POST;
       $model = new ContasModel();  
       $ret = $model->Update($dados);
       if($ret){
            $retorno['status'] = true; 
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        echo json_encode($retorno);
        
        
    }
    function ajaxSave(){
       $dados = $_POST;
       $model = new ContasModel(); 
       $dados['data_criada'] = date("Y/m/d h:i:s");
       $ret = $model->Save($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $ret['id'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        
     #   print_r($retorno);
        echo json_encode($retorno);
        
        
    }
    
    function ajaxDelete(){
       $dados = $_REQUEST;
       $model = new ContasModel(); 
       $ret = $model->Delete($dados);
       if($ret){
           
           if($_SESSION['account_selected']['id_conta_user'] == $dados['id']){
               unset($_SESSION['account_selected']);
           }
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    function ajaxConvertRobos(){
        
         $model = new ContasModel();
         $robos = file ('contas.csv');
               echo '<pre>';
         foreach($robos as $robo){
            $access = explode(':',$robo);
            $conta = array();
            $conta['usuario'] =  $access['0'];
            $conta['senha'] =  $access['1'];
            $conta['status'] = 0;
            
            print_r($conta);
           $ret =  $model->SaveRobo($conta);
           print_r($ret);
           echo "<h1:";
         }    
    }
    function ajaxListRobo(){
         $model = new ContasModel();
         $robo = $model->getAccountRobo();
         $instagram = new Instagram(array(
              'apiKey'      => INSTA_KEY,
              'apiSecret'   => INSTA_SECRET,
              'apiCallback' => CALLBACK_INSTAGRAM
            ));
         $config = array(
                  'basic',
                  'likes',
                  'comments',
                  'relationships'
         );
         $link = $instagram->getLoginUrl($config);
         $robo['link'] = "<a href='$link' target='_blank'>Autenticar</a>";
         echo  $this->dwoo->get('app/views/Contas/robo.tpl',$robo);
         }
    
   function teste(){
       echo "AQUI!";
   }
         
    
}
?>

