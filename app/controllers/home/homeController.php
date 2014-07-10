<?php
include MODELS.'home/homeModel.php';
include MODELS.'Noticias/NoticiasModel.php';
class home extends Controller{
    function index(){
      $data = array();
      $model = new homeModel(); 
     
      #$data['categoria']['nome'] = 'PROBIÓTICA';
      #$data['categoria']['descricao'] = 'FOCO, FORÇA, TREINO.';
    #  $data['produtos'] = $model->homeProducts();
    #  $data['no_pagination'] = true;
       
      
      $data['sections'][0] = $this->dwoo->get('app/views/home/section-slider.tpl'); 
      $data['sections'][1] = $this->dwoo->get('app/views/home/section-take-tour.tpl'); 
      $data['sections'][2] = $this->dwoo->get('app/views/home/section-benefits.tpl'); 
      $data['sections'][3] = $this->dwoo->get('app/views/home/section-portifolio.tpl'); 
     # $data['sections'][0] = $this->dwoo->get('app/views/home/section-slider.tpl',$data); 
     # $data['sections'][1] = $this->dwoo->get('app/views/home/section-products-menu.tpl',$data); 
      
      
      
   #   $data['sections'][2] = $this->dwoo->get('app/views/home/section-news.tpl',$data); 
   #   $data['sections'][3] = $this->dwoo->get('app/views/home/section-events.tpl',$data); 
      echo $this->dwoo->get('app/views/index.tpl',$data);
    }
    
    
    
    
    
    function Sess(){
        echo '<pre>';
        print_r($_SESSION);
    }
    function verifica_rota(){
        $model = new homeModel();     
        $route = $this->getController();
        $subroute= $this->getAction();
        $params = $this->getParams();
        
        
        
        // CASO SEJA UMA CATEGORIA
        $categoria = $model->RouteisCategoria($route);
        $data = array();
        if(isset($categoria[0]['id_categoria'])){
            $data = $this->is_category($categoria);
            echo $this->dwoo->get('app/views/index.tpl',$data); 
            die();
        }
        
        // CASO SEJA UM MENU
        $menu = $model->RouteisMenu($route);
        $data = array();
        if(isset($menu[0]['id_menu'])){
            $data = $this->is_menu($menu);
            echo $this->dwoo->get('app/views/index.tpl',$data); 
            die();
        }
        
        
       #print_r($categoria);
       #print_r($subCategoria);
       #print_r($produto);
      
    }
    
    
    function is_category($categoria){
        $params = $this->getParams();
        $model = new homeModel();   
        $route = $this->getController();
        $subroute= $this->getAction();
        
       if(isset($_GET['p'])){
                $pag = $_GET['p'];
                $pagina = $pag * NUM_PER_PAGE;
                $data['next_pag'] = $pag + 1;
                
                $data['prev_pag'] = $pag - 1;
                if($data['prev_pag'] < 0){
                    $data['prev_pag'] = 0;
                }
            }else{
                $pag = 0;
                $pagina = 0;
                $data['next_pag'] = 1;
                $data['prev_pag'] = 0;
       }
       $total_pgs = $model->getTotalPaginasCategorias($categoria[0]['id_categoria']);
       
       $total =  $total_pgs[0]['total'];
       $num_pags = ceil($total / NUM_PER_PAGE) - 1;
       for ($i = 0; $i <= $num_pags; $i++) {
            $pags[$i]['pagina'] = $i;
            if($pag == $i){
                $pags[$i]['selected'] = 'selected';    
            }
       }
       if(is_array($pags)){
        $data['paginas'] = $pags;        
       }
        
        if(isset($categoria[0]['id_categoria'])){
            
            
            
            $subroute= $this->getAction();
            $subret = array();
            if($subroute != ''){
                $subCategoria = $model->RouteisCategoria($subroute,$categoria[0]['id_categoria']);        
            }
        }
        
        
        
        
        
        if(isset($params['0'])){
               
            // CASO SEJA UM PRODUTO
            $produto = $model->RouteisProduct($params['0'],$subCategoria[0]['id_categoria']);
            if(is_array($produto)){
                
                $data['sub_title'] = $categoria[0]['nome']." - ".$produto[0]['nome'];
                $data['meta']['description'] = $produto[0]['nome']." - ".$produto[0]['tipo'];
                $data['meta']['og_title'] = $categoria[0]['nome']." - ".$produto[0]['nome'];
                $data['meta']['og_url'] = BASE_URL.$categoria[0]['alias'].'/'.$subCategoria[0]['alias'].'/'.$produto[0]['alias'];
                if($produto[0]['foto_produto'] != ''){
                    $og_image = BASE_URL.'assets/images/sections/produtos/'.$produto[0]['foto_produto'];                    
                }else{
                    $og_image = BASE_URL.'assets/images/sections/produtos/product.jpg';
                }
                $data['meta']['og_image'] = $og_image;
                $data['meta']['og_description'] = $produto[0]['descricao'];
                
                
                $data['categoria'] = $categoria[0];
                $data['sub_categoria'] = $subCategoria[0];
                $data['produto'] = $produto[0];
                
                $data['sabores'] = $model->getSaboresProduto($produto[0]['id_produto']);
                $data['atividades'] = $model->getAtividadesProduto($produto[0]['id_produto']);
                $data['infos'] = $model->getInfosProduto($produto[0]['id_produto']);
                
                $data['main_id'] = 'section-produtos';
                
                $data['sections'][0] = $this->dwoo->get('app/views/home/view-product.tpl',$data); 
               
                $dView['id'] = $produto[0]['id_produto'];
                $dView['type'] = 1;
                $this->addView($dView);
             
             
               
               
               
                
            }else{
               
            }
        }else{
            if(isset($subCategoria[0]['id_categoria'])){
                $produto = $model->getProdutosSubCategoria($subCategoria[0]['id_categoria'],$pagina);
            }else{
                $produto = $model->getProdutosCategoria($categoria[0]['id_categoria'],$pagina);                
                
            }
            
            
        
            $data['categoria'] = $categoria[0];
            $data['sub_categoria'] = $subCategoria[0];
            $data['produtos'] = $produto;
            $data['sections'][0] = $this->dwoo->get('app/views/home/section-products.tpl',$data); 
            
            $dView['id'] = $categoria[0]['id_categoria'];
            $dView['type'] = 2;
            $this->addView($dView);
            
              
            
            
             
        }
        return $data;
        
    }
    
    function getPageProductsCategory(){
        $model = new homeModel();
        $dados = $_POST;
        
        
        if(isset($dados['pag'])){
                $pag =$dados['pag'];
                $pagina = $pag * NUM_PER_PAGE;
            }else{
                $pag = 0;
                $pagina = 0;
        }
    
        
        
        $categoria = $model->RouteisCategoria($dados['categoria_alias']);
        
        $produto = $model->getProdutosCategoria($categoria[0]['id_categoria'],$pagina);
        
        
        if(is_array($produto)){
            $data['produtos'] = $produto;
            $data['categoria'] = $categoria[0];
            $retorno['status'] = true;
            $retorno['html'] = $this->dwoo->get('app/views/home/list-products.tpl',$data); 
        }else{
            $retorno['status'] = false;
            
        }
        
        echo json_encode($retorno);
        
        
        
        
        
    }
    
    
    function getPageProductsMenu(){
        $model = new homeModel();
        $dados = $_POST;
        
        
        if(isset($dados['pag'])){
                $pag =$dados['pag'];
                $pagina = $pag * NUM_PER_PAGE;
            }else{
                $pag = 0;
                $pagina = 0;
        }
    
        
        
        $categoria = $model->RouteisMenu($dados['menu_alias']);
        
        $produto = $model->getProdutosSubMenu($dados['id_menu'],$pagina);
        
        
        if(is_array($produto)){
            $data['produtos'] = $produto;
            $data['categoria'] = $categoria[0];
            $retorno['status'] = true;
            $retorno['html'] = $this->dwoo->get('app/views/home/list-products-menu.tpl',$data); 
        }else{
            $retorno['status'] = false;
            
        }
        
        echo json_encode($retorno);
        
        
        
        
        
    }
    
    
    
    
    function is_menu($menu){
        $model = new homeModel();   
        $route = $this->getController();
        $subroute= $this->getAction();
     
       if(isset($_GET['p'])){
                $pag = $_GET['p'];
                $pagina = $pag * NUM_PER_PAGE;
                $data['next_pag'] = $pag + 1;
                
                $data['prev_pag'] = $pag - 1;
                if($data['prev_pag'] < 0){
                    $data['prev_pag'] = 0;
                }
            }else{
                $pag = 0;
                $pagina = 0;
                $data['next_pag'] = 1;
                $data['prev_pag'] = 0;
        }
     
     
        if(isset($menu[0]['id_menu'])){
            
            
            
            $subroute= $this->getAction();
            $subret = array();
            if($subroute != ''){
                $subMenu = $model->RouteisMenu($subroute,$menu[0]['id_menu']);        
            }
        }
        
        
        
        
        
        
        if(isset($subMenu[0]['id_menu'])){
            $produto = $model->getProdutosSubMenu($subMenu[0]['id_menu'],$pagina);
            
            
            $total_pgs = $model->getTotalPaginasMenu($subMenu[0]['id_menu']);

            $total =  $total_pgs[0]['total'];
            $num_pags = ceil($total / NUM_PER_PAGE) - 1;
            for ($i = 0; $i <= $num_pags; $i++) {
            $pags[$i]['pagina'] = $i;
            if($pag == $i){
            $pags[$i]['selected'] = 'selected';    
            }
            }
            if(is_array($pags)){
            $data['paginas'] = $pags;        
            }
           
               
               
           
            
            
        }else{
            
           
            
            
            $produto = $model->getProdutosMenu($menu[0]['id_menu'],$pagina);   
            
            
            $total_pgs = $model->getTotalPaginasMenu($menu[0]['id_menu']);

            $total =  $total_pgs[0]['total'];
            $num_pags = ceil($total / NUM_PER_PAGE) - 1;
            for ($i = 0; $i <= $num_pags; $i++) {
            $pags[$i]['pagina'] = $i;
            if($pag == $i){
            $pags[$i]['selected'] = 'selected';    
            }
            }
            if(is_array($pags)){
            $data['paginas'] = $pags;        
            }
                         
            
        }
            
              
               
        
            $data['categoria'] = $menu[0];
            $data['sub_categoria'] = $subMenu[0];
            $data['produtos'] = $produto;
            
            if($subMenu[0]['foto_banner'] !=''){
                $data['main_style'] = "style='background: url(\"assets/images/produtos/".$subMenu[0]['foto_banner']."\") no-repeat scroll center top rgb(37, 37, 37) ! important;'";
            }
            #die();
            
            
            
            
            $dView['id'] = $menu[0]['id_menu'];
            $dView['type'] = 4;
            $this->addView($dView);
            
            
            
            $data['sections'][0] = $this->dwoo->get('app/views/home/section-products-menu.tpl',$data); 
             
        
        return $data;
        
    }
    
    function sobre(){
        
        
        
        
        
         
            $dView['id'] = 2;
            $dView['type'] = 0;
            $this->addView($dView);
        
        
        $data['sub_title'] = 'Sobre';
        $data['meta']['description'] = 'A PRÓBIOTICA - TUDO SOBRE A LÍDER DA AMÉRICA LATINA NO SEGMENTO DE SUPLEMENTOS ALIMENTARES';
        $data['meta']['og_title'] = 'Sobre a probiótica';
        $data['meta']['og_url'] = BASE_URL.'sobre';
        $data['meta']['og_description'] = 'Fundada em 1986, a Probiótica Laboratórios Ltda. É líder na América Latina no segmento de suplementos alimentares focados na área de nutrição esportiva';


        $data['main_id'] = 'section-a-probiotica';
         $data['sections'][0] = $this->dwoo->get('app/views/home/section-a-probiotica.tpl',$data); 
         echo $this->dwoo->get('app/views/index.tpl',$data); 
    }
    
    function contato(){
                     
        
        $dView['id'] = 3;
        $dView['type'] = 0;
        $this->addView($dView);
        
        $data['sub_title'] = 'Contato';
        $data['meta']['description'] = 'Contato - dúvidas,comercial,financeiro,sugestão,trabalhe na probiótica,outros';
        $data['meta']['og_title'] = 'Contato - dúvidas,comercial,financeiro,sugestão,trabalhe na probiótica,outros';
        $data['meta']['og_url'] = BASE_URL.'contato';
        $data['meta']['og_description'] = 'Contato - dúvidas,comercial,financeiro,sugestão,trabalhe na probiótica,outros';


        $data['main_id'] = 'section-contato';
         $data['sections'][0] = $this->dwoo->get('app/views/home/section-contato.tpl',$data); 
         echo $this->dwoo->get('app/views/index.tpl',$data); 
    }
    
    function sendContato(){
        $dados = $_POST;
        #echo '<pre>';
        #print_r($dados);
        $to = $dados['email'];
        #$to_name = 'Rafael';
        $subject = utf8_decode('Contato - '.$dados['assunto']);
        $dados['mensagem'] = utf8_decode($dados['mensagem']);
        $dados['nome'] = utf8_decode($dados['nome']);
        $dados['assunto'] = utf8_decode($dados['assunto']);
        #$content = 'MENSAGEM';
        $dados['mensagem'] = nl2br($dados['mensagem']);
        
        $content = $this->dwoo->get('app/views/emails/contato.tpl',$dados);
        $ret = $this->sendEmail($to,$to_name = '',$subject,$content);
        
        if($ret == true){
            $retorno['status'] = true;
        }else{
            $retorno['status'] = false;
            $retorno['msg'] = $ret;
        }
        
        echo json_encode($retorno);
        
    }
    
    function CadastroNewsLetter(){
        $dados = $_POST;
        #echo '<pre>';
        #print_r($dados);
        $to = $dados['email'];
        #$to_name = 'Rafael';
        $subject = utf8_decode('NewsLetter - Novo Cadastro');
        #$content = 'MENSAGEM';
        $content = 'Adicionar esse e-mail a newsletter: <b>'.$dados['email'].'</b>';
        
        $ret = $this->sendEmail($to,$to_name = '',$subject,$content);
        
        if($ret == true){
            $retorno['status'] = true;
        }else{
            $retorno['status'] = false;
            $retorno['msg'] = $ret;
        }
        
        echo json_encode($retorno); 
    }
    function showProduto($produto){
        print_r($produto);
    }
    
    function showCategoria($categoria){
            $model = new homeModel();
           
            
        
        
    }
    
       
    
}
?>
