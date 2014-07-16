<?php              
include MODELS.'Portfolio/PortfolioModel.php';
class Portfolio extends Controller{
    function index(){
        
        $model = new PortfolioModel();
        $Portfolio = $model->GetAll();   
       // $total = $model->TotalPaginas();   
             
       
     
        
        $data['portifolios'] = $Portfolio;

        $data['body_class'] = ' template-hexagon';
        $data['sections'][0] = $this->dwoo->get('app/views/Portfolio/section-list.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);

 // $html = $this->dwoo->get('app/views/v2/midia.tpl',$data);
      #echo $html;  
    } 
    
    function getPaginacao($atual = 0){
        $model = new PortfolioModel();
        $total = $model->TotalPaginas();   
        
       # $atual = 2;
       if($total > 1){
           $total = $total - 1;
            for ($i = $atual; $i <= $total; $i++) {
                $pag[$i]['num'] = $i;
                if($i == $atual){
                    $pag[$i]['current'] = 'current';
                }
            }   
            $paginacao['paginas'] = $pag;
            $paginacao['atual'] = $atual;
            $paginacao['total'] = $total;
            return $paginacao;
       } 
    
        
    }
    function pagina(){
         $model = new PortfolioModel();
          $params = $this->getParams();
          
        $Portfolio = $model->GetAll($params[0]);   
       // $total = $model->TotalPaginas();   
        
        
        
       
       
        $data['paginacao'] = $this->getPaginacao($params[0]);
        $data['Portfolio'] = $Portfolio;

        $data['body_class'] = ' blog template-one-column-grid';
        $data['sections'][0] = $this->dwoo->get('app/views/Portfolio/section-news.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);

 // $html = $this->dwoo->get('app/views/v2/midia.tpl',$data);
      #echo $html;  
         
    }
    
    function rss(){
            header("Content-type: application/xml");
            // Intanciamos/chamamos a classe
            $rss = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><rss></rss>');
            $rss->addAttribute('version', '2.0');
            // Cria o elemento <channel> dentro de <rss>
            
            $canal = $rss->addChild('channel');
            $canal->addChild('title', 'LuckyCode RSS');
            $canal->addChild('link', BASE_URL);
            $canal->addChild('description',NAME_EMAIL);
            
            $model = new PortfolioModel();
            $Portfolio = $model->GetAll();
            
           # print_r($Portfolio);
            
            foreach($Portfolio as $k=>$v){
            
                $item = $canal->addChild('item');
                // Adiciona sub-elementos ao elemento <item>
                $item->addChild('title',$v['titulo']);
                $item->addChild('link', BASE_URL."Portfolio/view/".$v['alias']);
                $item->addChild('description', $v['chamada']);
                $item->addChild('pubDate', date('r',strtotime($v['data'])));
                // Cria outro elemento <item> dentro de <channel>
                
            
                
            }
            // Entrega o conteúdo do RSS completo:
            echo $rss->asXML();
            exit;
    }    
    function View(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['alias'] = $params[0]; 
         $model = new PortfolioModel();
         $retorno = $model->DataAlias($dados);
         $data['Portfolio'] = $retorno[0];
         
         
         
         $date = explode('-',$data['Portfolio']['data']);
         $data['Portfolio']['ano'] = $this->getNomeMes($date[0]);      
         $data['Portfolio']['dia'] = $date[2];      
         $data['Portfolio']['mes'] = $this->getNomeMes($date[1]);      
       
    
         
         // META GOOGLE
         
         $data['sub_title'] = $data['Portfolio']['nome'];
         $data['meta']['description'] = $data['Portfolio']['nome'];
         $data['meta']['og_title'] =  $data['Portfolio']['nome'];
         $data['meta']['og_url'] = BASE_URL.'Portfolio/View/'. $data['Portfolio']['alias'];
         $data['meta']['og_image'] =  BASE_URL.'uploads/'. $data['Portfolio']['foto_chamada'];
         $data['meta']['og_description'] = $data['Portfolio']['nome'];
         // MAIN ID // TEMPLATE VAR
         
         
        $data['body_class'] = ' single';
        $data['sections'][0] = $this->dwoo->get('app/views/Portfolio/section-view.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);
        
    
    }    
       
       
    
}
?>