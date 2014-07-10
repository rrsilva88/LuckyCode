<?php
class Controller extends System{
   function __construct() {
        global $dwoo,$DB;
        parent::__construct();
        $this->dwoo = $dwoo;
        $this->DB = $DB;
   }
   
   
 
  
   function addView($dados){
        
       $dados['controller'] = $this->getController();
       $dados['action'] = $this->getAction();
       
       $params = $this->getParams();
       if(is_array($params)){
            $dados['params'] = serialize($params);
       }
       $dados['data'] = date( 'Y-m-d H:i:s');
       $dados['ip'] = $_SERVER['REMOTE_ADDR'];
       $dados['referer'] = $_SERVER['HTTP_REFERER'];
       
       $model = new Model(); 
       $ret = $model->saveView($dados);
       if(is_numeric($ret['id'])){
           return true;
       }else{
           return false;
       }
         
   }
   
   
   function addLog($id_user = ''){
            $model = new Model();
            if($id_user != ''){
                $dLog['id_user'] = $id_user;    
            }else{
                $dLog['id_user'] = $_GET['id_user'];
            }
            
            $dLog['method'] = $this->getController();
            $dLog['action'] = $this->getAction();
            $dLog['ip'] = $_SERVER['REMOTE_ADDR'];
            $dLog['date'] = date( 'Y-m-d H:i:s');
            $model->addLog($dLog);    
            
   }
   function submitForms($dados){
       $act = explode('_',$dados['action']);
       $controller = $act[0];
       $action = $act[1];
       $controller_path = CONTROLLERS.$controller.'/'.$controller.'Controller.php';
       require_once($controller_path);
            $app = new $controller();
            if(method_exists($app,$action)){    
                $ret = $app->$action($dados);
                return $ret;
            }else{
                return false;
            }
   }
   
   function makeReturnJson($code,$message = NULL,$array = NULL){
       $json['code'] = $code;
       $json['message'] = $message;
       $json['results'] = $array;
       return json_encode($json);
   }
   
   
   
}

?>
