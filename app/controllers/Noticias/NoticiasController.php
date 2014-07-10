<?php              
include MODELS.'Noticias/NoticiasModel.php';
class Noticias extends Controller{
    function index(){

      $data = array();    
      if(isset($_GET['p'])){
          $pg = $_GET['p'];
          $pagina = ($pg * 10) + $pg;
      }else{
          $pagina = 0;
      }
      $model = new NoticiasModel();
      $data['noticias'] = $model->getNoticias($pagina);
      foreach($data['noticias'] as $k =>$v){
          $data['noticias'][$k]['chamada'] = nl2br($v['chamada']);
      }
      
      
      
        $data['sub_title'] = 'Notícias';
        $data['meta']['description'] = 'Notícias e Artigos';
        $data['meta']['og_title'] = 'Notícias e Artigos';
        $data['meta']['og_url'] = BASE_URL.'Noticias';
        $data['meta']['og_description'] = 'Notícias e Artigos';
      
        $dView['id'] = 0;
        $dView['type'] = 3;
        $this->addView($dView);
      
      $data['main_id'] = 'section-artigos';
      $data['sections'][0] = $this->dwoo->get('app/views/noticias/list.tpl',$data); 
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
            $canal->addChild('title', 'Probiótica RSS');
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
         
         
         
         
        $dView['id'] = $retorno[0]['id_artigo'];
        $dView['type'] = 3;
        $this->addView($dView);
         
         // META GOOGLE
         
         $data['sub_title'] = $dados['noticia']['titulo'];
         $data['meta']['description'] = $data['noticia']['chamada'];
         $data['meta']['og_title'] =  $data['noticia']['titulo'];
         $data['meta']['og_url'] = BASE_URL.'Noticias/View/'. $data['noticia']['alias'];
         $data['meta']['og_image'] =  BASE_URL.'uploads/'. $data['noticia']['foto_chamada'];
         $data['meta']['og_description'] = $data['noticia']['chamada'];
         // MAIN ID // TEMPLATE VAR
         $data['main_id'] = 'section-artigos';
         $data['sections'][0] = $this->dwoo->get('app/views/noticias/view.tpl',$data); 
         
         echo $this->dwoo->get('app/views/index.tpl',$data);
        
    
    }    
       
       
    
}
?>