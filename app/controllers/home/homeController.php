<?php
include MODELS.'home/homeModel.php';
include MODELS.'Portfolio/PortfolioModel.php';
class home extends Controller{
    function index(){
      $data = array();
      $model = new homeModel(); 
      $mPortfolio = new PortfolioModel(); 
      
      $dados['portifolios'] =   $mPortfolio->getRandom();
      $data['sections'][0] = $this->dwoo->get('app/views/home/section-slider.tpl'); 
      $data['sections'][1] = $this->dwoo->get('app/views/home/section-take-tour.tpl'); 
      $data['sections'][2] = $this->dwoo->get('app/views/home/section-benefits.tpl'); 
      $data['sections'][3] = $this->dwoo->get('app/views/home/section-portifolio.tpl',$dados); 
      $data['sections'][4] = $this->dwoo->get('app/views/home/section-services.tpl'); 
  
      echo $this->dwoo->get('app/views/index.tpl',$data);
    }
    
    
    function Contato(){
        
          $data = array();
          $data['sections'][0] = $this->dwoo->get('app/views/home/section-contato.tpl'); 
          $data['body_class'] = ' page template-contact';
          echo $this->dwoo->get('app/views/index.tpl',$data);
     
        
    }
    
    function EnviaContato(){
        $model = new homeModel();
        $dados = $_POST;
        $dados['data'] = date('Y-m-d');
        $ret = $model->saveContato($dados);
        
        if(isset($ret['id'])){
            $ret['status'] = true;
        }else{
            unset($ret);
            $ret['status'] = false;
        }
        echo json_encode($ret);
    }
    
    
    function ajaxSESS(){
        echo '<pre>';
        print_r($_SESSION);
    }
    
    
       
    
}
?>
