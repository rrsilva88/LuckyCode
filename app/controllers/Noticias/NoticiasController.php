<?php              
include MODELS.'Noticias/NoticiasModel.php';
class Noticias extends Controller{
    function index(){
        
        $model = new NoticiasModel();
        $noticias = $model->GetAll(0);   
        $total = $model->TotalPaginas();   
        
        
        
       
       
        $data['paginacao'] = $this->getPaginacao(2);
        $data['noticias'] = $noticias;

        $data['body_class'] = ' blog template-one-column-grid';
        $data['sections'][0] = $this->dwoo->get('app/views/noticias/section-news.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);

 // $html = $this->dwoo->get('app/views/v2/midia.tpl',$data);
      #echo $html;  
    } 
    
    function getPaginacao($atual = 1){
        $model = new NoticiasModel();
        $total = $model->TotalPaginas();   
        
       # $atual = 2;
       if($total > 1){
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
         $model = new NoticiasModel();
         $noticias = $model->GetAll();
         
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
            
            $model = new NoticiasModel();
            $noticias = $model->GetAll();
            
           # print_r($noticias);
            
            foreach($noticias as $k=>$v){
            
                $item = $canal->addChild('item');
                // Adiciona sub-elementos ao elemento <item>
                $item->addChild('title',$v['titulo']);
                $item->addChild('link', BASE_URL."Noticias/view/".$v['alias']);
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
         $model = new NoticiasModel();
         $retorno = $model->DataAlias($dados);
         $retorno[0]['chamada'] = nl2br($retorno[0]['chamada']);
         $data['noticia'] = $retorno[0];
         
         
         
         $date = explode('-',$data['noticia']['data']);
         $data['noticia']['ano'] = $this->getNomeMes($date[0]);      
         $data['noticia']['dia'] = $date[2];      
         $data['noticia']['mes'] = $this->getNomeMes($date[1]);      
       
    
         
         // META GOOGLE
         
         $data['sub_title'] = $data['noticia']['titulo'];
         $data['meta']['description'] = $data['noticia']['chamada'];
         $data['meta']['og_title'] =  $data['noticia']['titulo'];
         $data['meta']['og_url'] = BASE_URL.'Noticias/View/'. $data['noticia']['alias'];
         $data['meta']['og_image'] =  BASE_URL.'uploads/'. $data['noticia']['foto_chamada'];
         $data['meta']['og_description'] = $data['noticia']['chamada'];
         // MAIN ID // TEMPLATE VAR
         
         
        $data['body_class'] = ' single';
        $data['sections'][0] = $this->dwoo->get('app/views/noticias/section-view.tpl',$data); 
        echo $this->dwoo->get('app/views/index.tpl',$data);
        
    
    }    
       
       
    
}
?>