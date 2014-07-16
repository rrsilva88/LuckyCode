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
    
    
    
    
    
    function ajaxSESS(){
        echo '<pre>';
        print_r($_SESSION);
    }
    
    
       
    
}
?>
