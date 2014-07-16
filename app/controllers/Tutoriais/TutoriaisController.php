<?php              
include MODELS.'Tutoriais/TutoriaisModel.php';
class Tutoriais extends Controller{
    function index(){
        
        $model = new TutoriaisModel();
        $Tutoriais = $model->GetAll(0);   
       // $total = $model->TotalPaginas();   
             
       
        $data['paginacao'] = $this->getPaginacao();
        $data['tutoriais'] = $Tutoriais;

        $data['body_class'] = ' blog template-one-column-grid';
        $data['sections'][0] = $this->dwoo->get('app/views/Tutoriais/section-news.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);

 // $html = $this->dwoo->get('app/views/v2/midia.tpl',$data);
      #echo $html;  
    } 
    
    function getPaginacao($atual = 0){
        $model = new TutoriaisModel();
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
         $model = new TutoriaisModel();
          $params = $this->getParams();
          
        $Tutoriais = $model->GetAll($params[0]);   
       // $total = $model->TotalPaginas();   
        
        
        
       
       
        $data['paginacao'] = $this->getPaginacao($params[0]);
        $data['Tutoriais'] = $Tutoriais;

        $data['body_class'] = ' blog template-one-column-grid';
        $data['sections'][0] = $this->dwoo->get('app/views/Tutoriais/section-news.tpl',$data); 
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
            
            $model = new TutoriaisModel();
            $Tutoriais = $model->GetAll();
            
           # print_r($Tutoriais);
            
            foreach($Tutoriais as $k=>$v){
            
                $item = $canal->addChild('item');
                // Adiciona sub-elementos ao elemento <item>
                $item->addChild('title',$v['titulo']);
                $item->addChild('link', BASE_URL."Tutoriais/view/".$v['alias']);
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
         $model = new TutoriaisModel();
         $retorno = $model->DataAlias($dados);
         $retorno[0]['chamada'] = nl2br($retorno[0]['chamada']);
         $data['tutorial'] = $retorno[0];
         
         
         
         $date = explode('-',$data['tutorial']['data']);
         $data['tutorial']['ano'] = $this->getNomeMes($date[0]);      
         $data['tutorial']['dia'] = $date[2];      
         $data['tutorial']['mes'] = $this->getNomeMes($date[1]);      
       
    
         
         // META GOOGLE
         
         $data['sub_title'] = $data['tutorial']['titulo'];
         $data['meta']['description'] = $data['tutorial']['chamada'];
         $data['meta']['og_title'] =  $data['tutorial']['titulo'];
         $data['meta']['og_url'] = BASE_URL.'Tutoriais/View/'. $data['tutorial']['alias'];
         $data['meta']['og_image'] =  BASE_URL.'uploads/'. $data['tutorial']['foto_chamada'];
         $data['meta']['og_description'] = $data['tutorial']['chamada'];
         // MAIN ID // TEMPLATE VAR
         
         
        $data['body_class'] = ' single';
        $data['sections'][0] = $this->dwoo->get('app/views/Tutoriais/section-view.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);
        
    
    }    
       
       
    
}
?>