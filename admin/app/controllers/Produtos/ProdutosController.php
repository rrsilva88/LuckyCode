<?php
include MODELS.'Produtos/ProdutosModel.php';
include MODELS.'Categorias/CategoriasModel.php';
class Produtos extends Controller{
    function index(){
       $data = array();
       
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Produtos';
       $data['content'][1]['footer'][2]['class'] = 'btn btn-info';
       $data['content'][1]['footer'][2]['title'] = 'Cadastrar';
       $data['content'][1]['footer'][2]['onclick'] = "Cadastrar('Produtos');";
       
       
       $dados['fields'] = array('Nome','Alias','Data Cadastro','Status','Ações');
       $dados['url_dados'] = BASE_URL."Produtos/ajaxListProdutos";
       $dados['order_table']['field'] = 3;
       $dados['order_table']['tipo'] = 'desc';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    function ajaxListProdutos(){
          // FIX BUG CHROME
        //  header('Access-Control-Allow-Origin: *');
          
           $aColumns = array('nome','alias','data_cadastro','status','id_produto');
           $cColumns = array('nome','alias','data_cadastro','status','id_produto');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_produto";
             
            /* DB table to use */
            $sTable = 'produtos';
            
            
            function fatal_error ( $sErrorMessage = '' )
            {
                header( $_SERVER['SERVER_PROTOCOL'] .' 500 Internal Server Error' );
                die( $sErrorMessage );
            }
         
            
          
            /*
             * Paging
             */
            $sLimit = "";
            if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
            {
                $sLimit = "LIMIT ".intval( $_GET['iDisplayStart'] ).", ".
                    intval( $_GET['iDisplayLength'] );
            }
             
             
            /*
             * Ordering
             */
            $sOrder = "";
            if ( isset( $_GET['iSortCol_0'] ) )
            {
                $sOrder = "ORDER BY  ";
                for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
                {
                    if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
                    {
                        $sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
                            ".($_GET['sSortDir_'.$i]==='asc' ? 'asc' : 'desc') .", ";
                    }
                }
                 
                $sOrder = substr_replace( $sOrder, "", -2 );
                if ( $sOrder == "ORDER BY" )
                {
                    $sOrder = "";
                }
            }
             
             
            /*
             * Filtering
             * NOTE this does not match the built-in DataTables filtering which does it
             * word by word on any field. It's possible to do here, but concerned about efficiency
             * on very large tables, and MySQL's regex functionality is very limited
             */
            $sWhere = "";
            if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
            {
                $sWhere = "WHERE (";
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" )
                    {
                        if($aColumns[$i] != 'status' && $aColumns[$i] != 'cotacoes'){
                            
                            if($aColumns[$i] == 'data_requisicao'){
                                $sWhere .= "DATE_FORMAT(data_requisicao,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                            }elseif($aColumns[$i] == 'usuario'){
                                $sWhere .= "nu.nome LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";    
                            }else{
                                $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                            }
                            
                            
                        }
                    }
                }
                $sWhere = substr_replace( $sWhere, "", -3 );
                $sWhere .= ')';
            }
             
            /* Individual column filtering */
            for ( $i=0 ; $i<count($aColumns) ; $i++ )
            {
                if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
                {
                    if ( $sWhere == "" )
                    {
                        $sWhere = "WHERE ";
                    }
                    else
                    {
                        $sWhere .= " AND ";
                    }
                    
                    if($aColumns[$i] == 'data_cadastro'){
                        $sWhere .= "DATE_FORMAT(data_cadastro,'%d/%m/%Y') LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";    
                    }elseif($aColumns[$i] == 'usuario'){
                        $sWhere .= "nu.nome LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";    
                    }else{
                        $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
                    }
                }
            }
             
             
            /*
             * SQL queries
             * Get data to display
             */
           $sQuery = "
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", np.", $cColumns))."
                FROM   $sTable as np
                $sWhere
                $sOrder
                $sLimit
            ";
            // FIX COTACOES
 
            $model = new ProdutosModel(); 
            #echo "<pre>";
            #echo $sQuery;
            $rResult = $model->Query($sQuery);
            
             
            /* Data set length after filtering */
            $sQuery = "
                SELECT FOUND_ROWS()
            ";
            
            $rResultFilterTotal =  $model->Query($sQuery);
            #print_r($rResultFilterTotal);
            $iFilteredTotal = $rResultFilterTotal[0][0];
             
            /* Total data set length */
            $sQuery = "
                SELECT COUNT(".$sIndexColumn.") as total
                FROM   $sTable
            ";
            $rResultTotal =  $model->Query($sQuery);
           # print_r($rResultTotal);
            $iTotal = $rResultTotal[0]['total'];
             
             
            /*
             * Output
             */
            $output = array(
                "sEcho" => intval($_GET['sEcho']),
                "iTotalRecords" => $iTotal,
                "iTotalDisplayRecords" => $iFilteredTotal,
                "aaData" => array()
            );
            if(!is_array($rResult)){
              $rResult = array();  
            }
            foreach ( $rResult as $k => $aRow)
            {
                $id_produto = false;
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    if ( $aColumns[$i] == "status" )
                    {
                        switch($aRow[$aColumns[$i]]){
                            case '0':
                            case 0:
                             $row[] = '<span class="label" id="status_'.$aRow['id_produto'].'">Inativo</span>';
                            break;
                            
                            case '1':
                            case 1:
                             $row[] = '<span class="label btn-primary" id="status_'.$aRow['id_produto'].'">Ativo</span>';
                            break;
                          
                        }
                        
                    }else if ( $aColumns[$i] == 'data_cadastro' ){
                         #$date = new DateTime($aRow[$aColumns[$i]]);
                         #$timestamp = $date->getTimestamp();
                         
                         if($aRow[$aColumns[$i]] != ''){
                            $row[] = date("d/m/Y", strtotime($aRow[$aColumns[$i]]));;
                         }else{
                            $row[] = '--/--/----';
                         }
                         
                         
                    }else if ( $aColumns[$i] == 'id_produto' ){
                        
                       
                            $html ='
                            <div class="btn-group">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a onclick="Visualizar(\'Produtos\','.$aRow[$aColumns[$i]].')"><i class="icon-zoom-in"></i>Visualizar</a></li>
                               <li><a  onclick="Delete(\'Produtos\','.$aRow[$aColumns[$i]].')"><i class="icon-trash"></i>Deletar</a></li>
                              
                              
                              ';
                              
                            $html.='</ul>';
                          $html.='</div>';
                           $id_pedido = false;
                             $row[] = $html;
                        
                       
                    }else if ( $aColumns[$i] != ' ' )
                    {
                        /* General output */
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
                $output['aaData'][] = $row;
            }
          
            echo json_encode( $output );
        
    }
    
    
    function ajaxDelete(){
       $dados = $_REQUEST;
       $model = new ProdutosModel(); 
       $ret = $model->Delete($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    
    
    function Create(){
       
       $model = new CategoriasModel();
       $dados['categorias'] = $model->getAllCategorias();
       
       $dados['title'] = 'Criar Produto';
       
       
      
       $dados['title_btns'][0]['name'] = "Back";
       $dados['title_btns'][0]['class'] = "icon-reply";
       $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Novo Produto';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "SaveProduto();";
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Produtos/new.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    }
    
    
    function View(){
        
        $dados = $_REQUEST;
        $params = $this->getParams();
        $dados['id_produto'] = $params[0]; 
        $model = new ProdutosModel();
        
        
        $mCategoria = new CategoriasModel();
        $dados['categorias'] = $mCategoria->getAllCategorias();
        
        
        $uData = $model->Data($dados['id_produto']);
        $dados['title'] = '#'.$uData['0']['id_produto'].' / '.$uData['0']['nome'];

        $dados['title_btns'][0]['name'] = "Back";
        $dados['title_btns'][0]['class'] = "icon-reply";
        $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";


        $dados['content'][1]['size'] = 12;
        $dados['content'][1]['name'] = 'Produto';
        $dados['content'][1]['icon'] = 'icon-th-large';


        $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
        $dados['content'][1]['footer'][1]['title'] = 'Salvar';
        $dados['content'][1]['footer'][1]['onclick'] = "UpdateProduto();";
        
        
      
       
       
       
       $dados['produto'] = $uData[0];
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Produtos/view.tpl', $dados);
       
       
        $dados['sabores'] = $model->getSabores();
        
        $dados['saboresProduto'] = $model->getSaboresProduto($dados);
        
        
        $dados['content'][2]['size'] = 4;
        $dados['content'][2]['name'] = 'Sabores';
        $dados['content'][2]['icon'] = 'icon-lemon';
        $dados['content'][2]['html'] = $this->dwoo->get('app/views/Produtos/sabores.tpl', $dados);
        
        
        
        
        $dados['atividades'] = $model->getAtividades();
        
        $dados['atividadesProduto'] = $model->getAtividadesProduto($dados);
        
        $dados['content'][3]['size'] = 4;
        $dados['content'][3]['name'] = 'Atividades';
        $dados['content'][3]['icon'] = 'icon-bullhorn';
        $dados['content'][3]['html'] = $this->dwoo->get('app/views/Produtos/atividades.tpl', $dados);
       
       
       
       
        $dados['infosProduto'] = $model->getInfoProduto($dados); 
        $dados['content'][4]['size'] = 4;
        $dados['content'][4]['name'] = 'Informações Nutricionais';
        $dados['content'][4]['icon'] = 'icon-pushpin';
        $dados['content'][4]['html'] = $this->dwoo->get('app/views/Produtos/infos.tpl', $dados);;
       
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    
    }
    
    
    
    
    
    function ajaxSave(){
       $dados = $_POST;
       $dados['alias'] = $this->urlize($dados['nome']);
       $model = new ProdutosModel(); 
       $dados['data_cadastro'] = date('Y-d-m H:i:s');
       
        if(isset($_FILES['foto']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_produto'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }else{
            unset($dados['foto']);
        }
        
        
        
         if(isset($_FILES['ficha_tecnica']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['ficha_tecnica']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['ficha_tecnica']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['ficha_tecnica'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }else{
            unset($dados['ficha_tecnica']);
        }
        
        
      
        if(isset($dados['ficha_tecnica'])){
            if($dados['ficha_tecnica'] == ''){
                unset($dados['ficha_tecnica']);
            }
        }  
        
        
        if(isset($dados['foto_produto'])){
            if($dados['foto_produto'] == ''){
                unset($dados['foto_produto']);
            }
        }
       
       $ret = $model->Save($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $ret['id'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        echo json_encode($retorno);
        
        
    }
    
     
    
    function ajaxUpdate(){
       $dados = $_POST;
       $dados['alias'] = $this->urlize($dados['nome']);
       $model = new ProdutosModel(); 
       
       
       
       if(isset($_FILES['foto']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_produto'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }else{
            unset($dados['foto']);
        }
        
        
        
         if(isset($_FILES['ficha_tecnica']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['ficha_tecnica']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['ficha_tecnica']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['ficha_tecnica'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }else{
            unset($dados['ficha_tecnica']);
        }
        
        
        
        if(isset($dados['ficha_tecnica'])){
            if($dados['ficha_tecnica'] == ''){
                unset($dados['ficha_tecnica']);
            }
        }
        if(isset($dados['foto_produto'])){
            if($dados['foto_produto'] == ''){
                unset($dados['foto_produto']);
            }
        }
       
       
       $ret = $model->Update($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $dados['id_produto'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        echo json_encode($retorno);
        
        
    }
    
    function ajaxSaveProdutoSabor(){
        $dados = $_POST;
        $model = new produtosModel();
        $ret = $model->SaveProdutoSabor($dados);
        if(isset($ret['id'])){
          $sabor =  $model->getSaborProdutoByID($ret['id']);
          $html ="
          
          
           <tr id='sabor-".$sabor[0]['id_produto_sabores']."'>
            <td><div style='background-color: ".$sabor[0]['cor']."; border-radius: 10px; border: 10px solid rgb(204, 204, 204); width: 20px; height: 20px;'>&nbsp;</div></td>
            <td style=' text-transform: capitalize;text-align: left !important;'>".$sabor[0]['nome']."</td>
            <td><button type='button' class='btn btn-mini btn-danger' onclick='excluiSaborProduto(".$sabor[0]['id_produto_sabores'].")'>Excluir</button></td>
          </tr>
          
          ";
            $retorno['status'] = true;
            $retorno['html'] = $html;
        }else{
            $retorno['status'] = false;        
        }
      echo json_encode($retorno);  
        
        
    }
    
    function ajaxDeleteProdutoSabor(){
       $dados = $_REQUEST;
       $model = new ProdutosModel(); 
       $ret = $model->ajaxDeleteProdutoSabor($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    
    
    
    
    function ajaxSaveProdutoAtividade(){
        $dados = $_POST;
        $model = new produtosModel();
        $ret = $model->SaveAtividadeSabor($dados);
        if(isset($ret['id'])){
          $atividade =  $model->getAtividadeProdutoByID($ret['id']);
          $html ="
          
          
           <tr id='atividade-".$atividade[0]['id_produto_atividade']."'>
            <td style=' text-transform: capitalize;text-align: left !important;'>".$atividade[0]['nome']."</td>
            <td><button type='button' class='btn btn-mini btn-danger' onclick='excluiAtividadeProduto(".$atividade[0]['id_produto_atividade'].")'>Excluir</button></td>
          </tr>
          
          ";
            $retorno['status'] = true;
            $retorno['html'] = $html;
        }else{
            $retorno['status'] = false;        
        }
      echo json_encode($retorno);  
        
        
    }
    
    
    
    function ajaxDeleteProdutoAtividade(){
       $dados = $_REQUEST;
       $model = new ProdutosModel(); 
       $ret = $model->ajaxDeleteProdutoAtividade($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    
    
    function ajaxSaveProdutoInfo(){
        $dados = $_POST;
        
        $model = new produtosModel();
        $ret = $model->SaveInfoSabor($dados);
        if(isset($ret['id'])){
          $info =  $model->getInfoProdutoByID($ret['id']);
          $html ="
          
          
           <tr id='info-".$info[0]['id_produto_info']."'>
            <td style=' text-transform: capitalize;text-align: left !important;'>".$info[0]['nome']."</td>
            <td style=' text-transform: capitalize;text-align: left !important;'>".$info[0]['valor_quantidade']."</td>
            <td style=' text-transform: capitalize;text-align: left !important;'>".$info[0]['valor_vd']."</td>
            <td><button type='button' class='btn btn-mini btn-danger' onclick='excluiInfosProduto(".$info[0]['id_produto_info'].")'>Excluir</button></td>
          </tr>
          
          ";
            $retorno['status'] = true;
            $retorno['html'] = $html;
        }else{
            $retorno['status'] = false;        
        }
      echo json_encode($retorno);  
       
    }
    
    
    
    function ajaxDeleteProdutoInfo(){
       $dados = $_REQUEST;
       $model = new ProdutosModel(); 
       $ret = $model->ajaxDeleteProdutoInfo($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    
    
    
    
    
    
    function AjaxSaveSabor($sabor){
        $model = new ProdutosModel(); 
        $retSabor = $model->getSabor($sabor['nome']);
        if(is_array($retSabor)){
            $retorno['id'] = $retSabor['0']['id_sabor'];
        }else{
            $ret = $model->SaveSabor($sabor);
            $retorno['id'] = $ret['id'];   
        }
        return $retorno['id'];
        
    }
    
    function ajaxImport(){
        // IMPORTA PRODUTOS CSV
        /*
         $csv = PATCH_IMAGES.'produtos.csv';
          $handle = @fopen($csv, "r");
          $model = new ProdutosModel(); 
          echo "<pre>";        
          $c = 0;          
          if ($handle) {
              while (($line = fgetcsv($handle, 4096)) !== false) {

                if(!isset($title)){
                    $title = $line;
                }else{
                    foreach($line as $k=>$v){
                        $name = $title[$k];
                        $array[$c][$name] = $v;
                    }
                    
                    $dImport = array();
                    if($array[$c]['nome'] != '' && $array[$c]['descricao'] != ''&& $array[$c]['apresentacao'] != ''){
                         $dImport['nome'] = utf8_encode(ltrim($array[$c]['nome']));
                         $dImport['descricao'] = utf8_encode(ltrim($array[$c]['descricao']));
                         $dImport['apresentacao'] = utf8_encode(ltrim($array[$c]['apresentacao']));
                         $dImport['alias'] = $this->urlize($array[$c]['nome']);
                         $dImport['tipo'] = utf8_encode(ltrim($array[$c]['tipo']));
                         $dImport['data_cadastro'] = date('Y-m-d H:i:s');
                         $ret = $model->Save($dImport);
                         $id_produto = $ret['id'];
                         print_r($dImport);
                    }
                    
                    if($array[$c]['sabores'] !=''){
                        $sabor = explode(',',$array[$c]['sabores']);
                        foreach($sabor as $k=>$v){
                            if($v != ''){
                                $nome = $dSabor['nome'];
                                $dSabor['nome'] = utf8_encode(ltrim(strtolower($v)));
                                $dSabor['cor'] = '#cccccc';
                                $id_sabor =  $this->AjaxSaveSabor($dSabor);
                                
                                if($id_sabor){
                                    $dProdutoSabor['id_produto'] = $id_produto;
                                    $dProdutoSabor['id_sabor'] = $id_sabor;
                                    $model->SaveProdutoSabor($dProdutoSabor);
                                    echo "ID_PRODUTO = ".$id_produto;
                                    echo "||";
                                    echo "ID_SABOR = ".$id_sabor;
                                    echo '<BR>';
                                }
                                
                                
                                
                            }
                        }
                    }
                    
                   $c++;
                }
            }
            
            if (!feof($handle)) {
                echo "Error: Não acessou o documento ".$csv;
            }
            fclose($handle);
      }
       */ 
    }
    
     
    
    
    
}
?>