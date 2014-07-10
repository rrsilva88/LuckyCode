<?php
include MODELS.'User/UserModel.php';
class User extends Controller{
    function index(){
      $data = array();
      $data['content'][] = $this->dwoo->get('app/views/user/novo.tpl',$data);
      $html = $this->dwoo->get('app/views/index.tpl', $data);
      echo $html;  
    }
    
    function Save(){
        $dados = $_REQUEST;
        $model = new UserModel();
        $dados['senha'] = md5($dados['senha']);
        $ret = $model->Save($dados);
        if($ret['id'] > 0){
            $retorno['status'] = true;   
            $retorno['id_user'] = $ret['id'];
            $retorno['retorno'] = $dados;
            $dadosLogin = $dados;
            $dadosLogin['return'] = 'return';
            $retorno['login'] = $this->Login($dadosLogin);
           $retorno['retorno']['html'] = $this->dwoo->get('app/views/user/menulogado.tpl',$dados);
            
        }else{
            $retorno['status'] = false;
            $retorno['retorno'] = $ret;
        }
        switch($dados['return']){
            # JSON
            case 'json':
                echo json_encode($retorno);
            break;
            # DEFAULT  / HTML
            default:
            case 'html':
                echo '<pre>';
                    print_r($retorno);
                echo '</pre>';
            break;
        }
    }
    
    
    function Get(){
        $dados = $_REQUEST;
        $model = new UserModel();
        $dados['senha'] = md5($dados['senha']);
        $ret = $model->Save($dados);
        if($ret['id'] > 0){
            $retorno['status'] = true;   
            $retorno['id_user'] = $ret['id'];
            $retorno['dados'] = $dados;
        }
        switch($dados['return']){
            # JSON
            case 'json':
                echo json_encode($retorno);
            break;
            # DEFAULT  / HTML
            default:
            case 'html':
                echo '<pre>';
                    print_r($retorno);
                echo '</pre>';
            break;
        }
    }
    
    function Login($dados = array()){
      if(count($dados) == 0){
        $dados = $_REQUEST;
        $dados['senha'] = md5($dados['senha']);
      }
      //print_r($dados);
       
     
      switch($dados['return']){
            # JSON
            case 'json':
                 if($dados['email'] !='' && $dados['senha'] !=''){
                      $model = new UserModel();
                      $ret = $model->Get($dados);
                      if(is_array($ret)){
                        $retorno['status'] = true;
                        $retorno['retorno'] = $ret[0];
                        $_SESSION['user'] = $ret[0];
                        $retorno['retorno']['html'] = $this->dwoo->get('app/views/user/menulogado.tpl',$dados);
                        
                      }else{
                        $retorno['status'] = false;
                        $retorno['retorno'] = $ret; 
                      }
                      echo json_encode($retorno);   
                }
            break;
            case 'return':
                 if($dados['email'] !='' && $dados['senha'] !=''){
                      $model = new UserModel();
                      $ret = $model->Get($dados);
                       if(is_array($ret)){
                        $retorno['status'] = true;
                        $retorno['retorno'] = $ret[0];
                        $_SESSION['user'] = $ret[0];
                      }else{
                        $retorno['status'] = false;
                        $retorno['retorno'] = $ret; 
                      }
                      return $retorno;
                }
            break;
            # DEFAULT  / HTML
            default:
            case 'html':
                  $data = array();
                  $data['content'][] = $this->dwoo->get('app/views/user/login.tpl',$data);
                  $html = $this->dwoo->get('app/views/index.tpl', $data);
                  echo $html; 
            break;
      }
      
      
    }
    function Sair(){
        unset($_SESSION['user']);
        
        if(isset($_SESSION['user'])){
            $retorno['status'] = false;    
            
        }else{
            $retorno['status'] = true;
            
        }
        
         echo json_encode($retorno);   
    }
    function Session(){
        print_r($_SESSION);
    }
    
}
?>
