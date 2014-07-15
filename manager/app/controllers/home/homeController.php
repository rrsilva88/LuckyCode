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
    
    function Dashboard(){
       $data = array();
   
       
       
       
       $data['content'][0]['size'] = 12;
       $data['content'][0]['name'] = 'DESENVOLVIMENTO';
       $data['content'][0]['icon'] = 'icon-user';
       $data['content'][0]['html'] = 'DASHBOARD';
       
   
        
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
    
   
    function nao_existe(){
        
        echo '<center><h1>ERRO 404</h1></center>';
    }
    
}
?>
