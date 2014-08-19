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
            $nome = explode(' ',$ret['0']['nome']);
            $_SESSION['loginADM']['primeiro_nome'] = $nome[0];
            if(isset($nome[1])){
                $_SESSION['loginADM']['sobrenome'] = $nome[1];
            }
            $_SESSION['loginADM']['acesso'] = $this->getMenu($ret[0]['id_user']);
            $this->getContasInstagram();
            
            $retorno['status'] = true;
            $retorno['retorno'] = $ret[0];
        }else{
            $retorno['status'] = false;    
            $retorno['retorno'] = $dados;
        }
        echo json_encode($retorno);
       
    }
   function ajaxSelectConta(){
       $id = $_REQUEST['id'];
       unset($_SESSION['account_selected']);
       $_SESSION['account_selected'] = $_SESSION['accounts'][$id]; 
       $retorno['status'] = true;
       echo json_encode($retorno);
      
   }
    
    function ajaxMakeMenu(){
        echo '<pre>';
        $_SESSION['loginADM']['acesso'] = $this->getMenu($_SESSION['loginADM']['id_user']);  
        print_r($_SESSION['loginADM']);
        
        
    }
    
    function Dashboard(){
       $data = array();
       $data['sidebar'] = true;
       
       
       #$data['content']['rows'][1]['widgets'][1] = $this->dwoo->get('app/views/dashboard/test.tpl');
       #$data['content']['rows'][1]['widgets'][2] = $this->dwoo->get('app/views/dashboard/test.tpl');
       #$data['content']['rows'][1]['widgets'][3] = $this->dwoo->get('app/views/dashboard/test.tpl');
       
       /*
       $data['content']['rows'][2]['widget'][1] = '';
       $data['content']['rows'][2]['widget'][2] = '';
       
       
       $data['content']['rows'][3]['widget'][1] = '';*/
       
       
       
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;  
    }
    
    function ajaxInstagramCallback(){
        global $instagram,$dwoo;
        
        $code = $_GET['code'];
        $retApi = $instagram->getOAuthToken($code);
        
   
                     
        if(isset($_GET['type'])){
                 echo '<pre>';

               if($retApi->access_token){
                    $dados['access_token'] = $retApi->access_token;
                    $dados['nome'] = $retApi->user->full_name;
                       $dados['code'] = $code;
                    $dados['usuario'] = $retApi->user->username;
                    $dados['status'] = 1;
                    $model = new homeModel();
                    
                    echo "<pre>";
                    print_r($dados);
                    $ret = $model->SaveContaInstaRobo($dados);
                    print_r($ret);
                }
        }else{
                
                if($retApi->access_token){
                    $dados['id_user'] = $_SESSION['loginADM']['id_user'];
                    $dados['access_token'] = $retApi->access_token;
                    $dados['instagram_id'] = $retApi->user->id;
                    $dados['nome'] = $retApi->user->full_name;
                    $dados['username'] = $retApi->user->username;
                    $dados['picture'] = $retApi->user->profile_picture;
                    $dados['code'] = $code;
                    $model = new homeModel();
                    $model->SaveContaInsta($dados);
                    $this->getContasInstagram();
                    $data['sidebar'] = true; 
                    $data['content']['rows'][1]['widgets'][1] =  $dwoo->get('app/views/callback_instagram.tpl',$dados);  
                    
                    
                }else{
                    
                    $data['sidebar'] = true; 
                    $data['content']['rows'][1]['widgets'][1] =  $dwoo->get('app/views/error_callback_instagram.tpl');  
                   
                }
                
        }
        
        $html = $this->dwoo->get('app/views/index.tpl', $data);
        echo $html;  
        
            
      
    }
   
    
    function ajaxAtividades(){
       # $this->getAtividadesUser();
        echo '<pre>';
        print_r($_SERVER);
        
        die();
        
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
    
   
    function nao_existe(){
        
        echo '<center><h1>ERRO 404</h1></center>';
    }
    
}
?>
