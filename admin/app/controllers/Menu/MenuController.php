<?php
include MODELS.'Menu/MenuModel.php';
include MODELS.'Produtos/ProdutosModel.php';
class Menu extends Controller{
    function index(){
       $data = array();
       
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Menu';
       $data['content'][1]['footer'][2]['class'] = 'btn btn-info';
       $data['content'][1]['footer'][2]['title'] = 'Cadastrar';
       $data['content'][1]['footer'][2]['onclick'] = "Cadastrar('Menu');";
       
       
       $dados['fields'] = array('Caminho','Nome','Alias','Status','Ações');
       $dados['url_dados'] = BASE_URL."Menu/ajaxListMenu";
       $dados['order_table']['field'] = 0;
       $dados['order_table']['tipo'] = 'asc';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    function ajaxListMenu(){
          // FIX BUG CHROME
        //  header('Access-Control-Allow-Origin: *');
          
           $aColumns = array('parent','nome','alias','status','id_menu');
           $cColumns = array('nome','alias','status','id_menu');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_menu";
             
            /* DB table to use */
            $sTable = 'menu';
            
            
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
                        if($aColumns[$i] != 'parent'){
                            
                            if($aColumns[$i] == 'parent'){
                                //$sWhere .= "DATE_FORMAT(data_requisicao,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                                //$sWhere = "(SELECT nome FROM Menu where nome LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%')";
                                //$sWhere .= "DATE_FORMAT(data_requisicao,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
                    
                    
                }
            }
             
             
            /*
             * SQL queries
             * Get data to display
             */
           $sQuery = "
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", np.", $cColumns)).",(SELECT nome FROM menu where id_menu = np.id_parent ) as parent
                FROM   $sTable as np
                $sWhere
                $sOrder
                $sLimit
            ";
            // FIX COTACOES
 
            $model = new MenuModel(); 
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
                $id_menu = false;
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    if ( $aColumns[$i] == "status" )
                    {
                        switch($aRow[$aColumns[$i]]){
                            case '0':
                            case 0:
                             $row[] = '<span class="label" id="status_'.$aRow['id_menu'].'">Inativa</span>';
                            break;
                            
                            case '1':
                            case 1:
                             $row[] = '<span class="label btn-primary" id="status_'.$aRow['id_menu'].'">Ativa</span>';
                            break;
                          
                        }
                        
                    }else if ( $aColumns[$i] == 'parent' ){
                        
                       if($aRow[$aColumns[$i]] != ''){
                           $row[] = $aRow[$aColumns[$i]];
                       }else{
                           $row[] = 'HOME';                           
                       }
                             
                        
                       
                    }else if ( $aColumns[$i] == 'id_menu' ){
                        
                       
                            $html ='
                            <div class="btn-group">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a onclick="Visualizar(\'Menu\','.$aRow[$aColumns[$i]].')"><i class="icon-zoom-in"></i>Visualizar</a></li>
                               <li><a  onclick="Delete(\'Menu\','.$aRow[$aColumns[$i]].')"><i class="icon-trash"></i>Deletar</a></li>
                              
                              
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
       $model = new MenuModel(); 
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
       
       
       $model = new MenuModel();
       $dados['menus'] = $model->getMenuRoot();
       
        
       $dados['title'] = 'Criar Menu';
      
       $dados['title_btns'][0]['name'] = "Back";
       $dados['title_btns'][0]['class'] = "icon-reply";
       $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Novo Menu';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "SaveMenu();";
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Menu/new.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    }
    
    
    function View(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_menu'] = $params[0]; 
         $model = new MenuModel();
         $uData = $model->Data($dados['id_menu']);
         
         
         $dados['listaMenu'] = $model->getMenuRoot($dados['id_menu']);
      
         $dados['title'] = '#'.$uData['0']['id_menu'].' / '.$uData['0']['nome'];
          
          $dados['title_btns'][0]['name'] = "Back";
          $dados['title_btns'][0]['class'] = "icon-reply";
          $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
          
          
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Menu';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "UpdateMenu();";
       
       

       
       
       
       
       $dados['menu'] = $uData[0];
       
       #echo '<pre>';
       #print_r($dados);
       #die();
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Menu/view.tpl', $dados);
       
       
       
       if($uData['0']['id_parent'] > 0){
           $mProdutos = new produtosModel();
           $dados['produtos'] = $mProdutos->GetAll();
           $dados['ListaProdutos'] = $model->getProdutosMenu($dados['id_menu']);
           $dados['content'][2]['size'] = 12;
           $dados['content'][2]['name'] = 'Produtos Relacionados';
           $dados['content'][2]['icon'] = 'icon-th-large';
           $dados['content'][2]['html'] = $this->dwoo->get('app/views/Menu/produtos.tpl', $dados);
       }
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    
    }
    
    function ajaxSaveProdutoMenu(){
           $dados = $_POST;
           $model = new MenuModel(); 
           $ret = $model->SaveProdutoMenu($dados);
            
           if(is_numeric($ret['id'])){
              $info =  $model->getProdutoMenuByID($ret['id']);
            
              if($info[0]['categoria_root'] == ''){
                  $info[0]['categoria_root'] = 'HOME';
              }
              $html ="
              
              
               <tr id='menu-produto-".$info[0]['id_menu_produto']."'>
                    <td style=' text-transform: capitalize;text-align: left !important;'>".$info[0]['produto_nome']."</td>
                    <td style=' text-transform: capitalize;text-align: left !important;'>".$info[0]['categoria_root']." > ".$info[0]['categoria']."</td>
                    <td>
                        <button type='button' class='btn btn-mini btn-danger' onclick='excluiProdutoMenu(".$info[0]['id_menu_produto'].")'>Excluir</button>
                    </td>
              </tr>
              
              ";
                $retorno['status'] = true;
                $retorno['html'] = $html;
            }else{
                $retorno['status'] = false;        
            }
      echo json_encode($retorno);  
           
           
        
    }
    
    
    
    
    function ajaxDeleteProdutoMenu(){
       $dados = $_REQUEST;
       $model = new MenuModel(); 
       $ret = $model->ajaxDeleteProdutoMenu($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        } 
        echo json_encode($retorno);
    }
    
    
    
    
    
    
    
    function ajaxSave(){
       $dados = $_POST;
       $dados['alias'] = $this->urlize($dados['nome']);
       $dados['status'] = 1;
       $model = new MenuModel(); 
       
       
       
           
       if(isset($_FILES['foto']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_banner'] = $nome_atual;
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
        if(isset($dados['foto_banner'])){
            if($dados['foto_banner'] == ''){
                unset($dados['foto_banner']);
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
       $model = new MenuModel(); 
       
       
           
       if(isset($_FILES['foto']['name'])){
            $pasta = PATCH_IMAGES_PRODUTO;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_banner'] = $nome_atual;
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
        if(isset($dados['foto_banner'])){
            if($dados['foto_banner'] == ''){
                unset($dados['foto_banner']);
            }
        }
       
       
       $ret = $model->Update($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $dados['id_menu'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        echo json_encode($retorno);
        
        
    }
    
     
    
    
    
}
?>