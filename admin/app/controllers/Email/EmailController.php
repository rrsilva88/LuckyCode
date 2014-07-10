<?php
include MODELS.'Email/EmailModel.php';
class Email extends Controller{
    function index(){
      $dados = array();
      $dados['title'] = "Email's";
      
      
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = "Sistema de Email's";
       $dados['content'][1]['icon'] = 'icon-bullhorn';
       $dados['content'][1]['html'] = $this->dwoo->get('app/views/sys_email/index.tpl');
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Enviar';
       $dados['content'][1]['footer'][1]['onclick'] = "SendEmail();"; 
       
       $dados['content'][2]['size'] = 12;
       $dados['content'][2]['name'] = 'Status Envio';
       $dados['content'][2]['icon'] = 'icon-cloud-upload';
       $dados['content'][2]['html'] = $this->dwoo->get('app/views/sys_email/status.tpl');
           
      $html = $this->dwoo->get('app/views/index.tpl', $dados);
      echo $html;  
    }
    
    function ajaxConfigEmail(){
        $dados = $_POST;
        
        $model = new EmailModel();
        
        /*
        switch($dados['filtro']){
            case '1':   // Todos os cadastrados
                $users = $model->getAllCadastrados();
            break;
            
            case '2':   // Todos os que fizeram corridas
                $users = $model->getAllComCorridas();
            break;
            
            case '3': // Todos os que ainda não fizeram corridas
                $users = $model->getAllSemCorridas();
            break;
            
            
        } */  
        
        
        
         $users = $model->getAllCadastrados(); 
        
      
        
           
        if(count($users) > 0){
            foreach($users as $k => $v){
                
                
                if($v['email'] != ''){
                    $to = $v['email'];
                    $to_name = $v['nome'];
                    $subject = $dados['titulo'];
                    $content = str_replace('{nome}',ucwords(strtolower($v['nome'])),$dados['content']);
                    $content = str_replace('\"','"',$content);
                    $data['emails'][$k]['email'] = $v['email'];
                    $data['emails'][$k]['nome'] = $v['nome'];
                    $data['emails'][$k]['content'] = $content;
                    
                    #if($v['email'] == 'rafa.dev@live.com'){
                        $envio =  $this->sendEmail($to,$to_name = '',$subject,$content,$from_email ='');
                    #}else{
                   #     $envio['message'] = 'Não enviou!';
                   # }
                    $data['emails'][$k]['status'] = $envio['message'];
                }
            }
            $data['total'] = count($users);
        }else{
            $data = array();
        }
          $html = $this->dwoo->get('app/views/sys_email/lista_email.tpl',$data);
          echo $html;
    }
    
}    

?>
