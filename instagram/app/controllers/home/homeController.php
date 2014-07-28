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
        global $instagram;
        $code = $_GET['code'];
        $data = $instagram->getOAuthToken($code);
        echo '<pre>';
        print_r($data);
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
