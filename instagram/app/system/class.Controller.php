<?php
class Controller extends System{
   function __construct() {
        global $dwoo,$DB;
        parent::__construct();
        $this->dwoo = $dwoo;
        $this->DB = $DB;
        // APPLE
        if(isset($_REQUEST['ci_session'])){
            unset($_REQUEST['ci_session']);
            unset($_REQUEST['url']);
            unset($_REQUEST['PHPSESSID']);
        }
        if(isset($_REQUEST['_ga'])){
            unset($_REQUEST['_ga']);
        }
        
            
        if(isset($_SESSION['loginADM'])){
           $controller = $this->getController();
           $action = $this->getAction(); 
           if(!$this->checkAccess($controller,$action)){
                 $config['controller'] = $controller;
                 $config['action'] = $action;
                 $html = $this->dwoo->get('app/views/sem_permissao.tpl',$config);
                 die($html);
           }
        }else{
           $controller = $this->getController();
           $action = $this->getAction(); 
           if(!$this->checkAccess($controller,$action)){
                 $config['controller'] = $controller;
                 $config['action'] = $action;
                 $html = $this->dwoo->get('app/views/sem_permissao.tpl',$config);
                 die($html);
           }        
        }    
   }  
   
   function makeReturnJson($code,$message = NULL,$array = NULL){
       $json['code'] = $code;
       $json['message'] = $message;
       $json['results'] = $array;
       return json_encode($json);
   }
   
   function checkAccess($controller,$action){
       
       
           $status = false;
           if($controller == 'home' && ($action == 'index' || $action == 'Logout' || $action == 'MakeLogin'|| $action == 'ajaxInstagramCallback') || strpos($action, "ajax") !== false || strpos($controller, "ajax") !== false){
              $status = true; 
           }else{
               
               $status = false;        
               $perfil = $_SESSION['sys']['app']['perfil_selecionado'];
               $perms = $_SESSION['loginADM']['acesso'][$perfil]['acesso'];
               if(is_array($perms)){
                   foreach($perms as $key => $val){
                       if(strtolower($val['classe']) == strtolower($controller)){
                          if($action != ''){
                               if($val['metodo'] == ''){
                                  $val['metodo'] = 'index';
                               }
                               if(strtolower($val['metodo']) == strtolower($action)){  
                                     $status = true;      
                               }else{
                                    $status = false; 
                                        if(isset($val['childrens'])){
                                            foreach($val['childrens'] as $k => $v){
                                                 if(strtolower($v['metodo']) == strtolower($action) && strtolower($v['classe']) == strtolower($controller)){
                                                          $status = true;   
                                                 }   
                                            }
                                    }
                               }     
                           }else{
                             $status = true;   
                           }
                          
                       }
                   }
              } 
          }
       
       
      return $status;
       
   } 
   
   function getContasInstagram(){
        $model = new Model();
        $contas = $model->getContasInstagram($_SESSION['loginADM']['id_user']);
        if(is_array($contas)){
            if(isset($_SESSION['accounts'])){
                unset($_SESSION['accounts']);
                $_SESSION['accounts'] = $contas;
            }else{
                $_SESSION['accounts'] = $contas;
            }
        }
   }  
   
   function getMenu($id_admin){
        $model = new Model();
        $menu = $model->getMenuDB($id_admin);
        
        $c=0;
        foreach($menu as $k => $v){
            $idperfil = $v['id_perfil'];
            if(!isset($_SESSION['sys']['app']['perfil_selecionado'])){
                $_SESSION['sys']['app']['perfil_selecionado'] = $idperfil;
            }
            
            $perms[$idperfil]['id_perfil'] = $v['id_perfil'];
            $perms[$idperfil]['name'] = $v['perfil'];
            $idmenu = $v['id_menu'];// Menu filho
            
            if($v['menuid'] > 0){
                $menuid = $v['menuid'];
                $perms[$idperfil]['acesso'][$menuid]['childrens'][$idmenu]['classe'] = $v['classe'];
                $perms[$idperfil]['acesso'][$menuid]['childrens'][$idmenu]['metodo'] = $v['metodo'];
                $perms[$idperfil]['acesso'][$menuid]['childrens'][$idmenu]['menu'] = $v['menu'];    
                $perms[$idperfil]['acesso'][$menuid]['childrens'][$idmenu]['icon'] = $v['icon'];    
                $perms[$idperfil]['acesso'][$menuid]['childrens'][$idmenu]['visible'] = $v['visible'];    
            }else{
                $perms[$idperfil]['acesso'][$idmenu]['classe'] = $v['classe'];
                $perms[$idperfil]['acesso'][$idmenu]['metodo'] = $v['metodo'];
                $perms[$idperfil]['acesso'][$idmenu]['menu'] = $v['menu'];    
                $perms[$idperfil]['acesso'][$idmenu]['icon'] = $v['icon'];    
                $perms[$idperfil]['acesso'][$idmenu]['visible'] = $v['visible'];    
                $perms[$idperfil]['acesso'][$idmenu]['ordem'] = $v['ordem'];    
            }
            
            
            
            $c++;
            ksort($perms[$idperfil]['acesso']);
        }
        if($perms){
            return $perms;
        }else{
            return false;
        }
       
   } 
   
   
   
}
?>