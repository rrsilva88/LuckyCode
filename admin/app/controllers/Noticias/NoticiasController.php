<?php
include MODELS.'Noticias/NoticiasModel.php';

class Noticias extends Controller{
    function index(){
        $model = new NoticiasModel();
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Lista de Notícias';
       
       $data['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $data['content'][1]['footer'][1]['title'] = 'Criar Notícia';
       $data['content'][1]['footer'][1]['href'] = "Noticias/Create";
       
       $dados['fields'] = array('Título','Alias','Data','Ações');
       $dados['url_dados'] = BASE_URL."Noticias/ajaxListNoticias";
       $dados['order_table']['field'] = 2;
       $dados['order_table']['tipo'] = 'asc';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    
    function ajaxListNoticias(){
          // FIX BUG CHROME
          #header('Access-Control-Allow-Origin: *');
          $aColumns = array('titulo','alias','data', 'id_artigo');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_artigo";
             
            /* DB table to use */
            $sTable = "artigos";
            
            
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
                        if($aColumns[$i] != 'status'){
                            
                            if($aColumns[$i] == 'data'){
                                $sWhere .= "DATE_FORMAT(data,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
                    
                    if($aColumns[$i] == 'data'){
                        $sWhere .= "DATE_FORMAT(data,'%d/%m/%Y') LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";    
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
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumns))."
                
                FROM   $sTable
                $sWhere
                $sOrder
                $sLimit
            ";
            
            $model = new NoticiasModel(); 
          #  echo "<pre>";
          # echo $sQuery;
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
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                     if ( $aColumns[$i] == 'id_artigo' ){
                        $html ='
                            <div class="btn-group" id="Noticias_'.$aRow[$aColumns[$i]].'">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a href="Noticias/View/'.$aRow[$aColumns[$i]].'"><i class="icon-zoom-in"></i>Visualizar</a></li>
                              
                              <li><a  onclick="Delete(\'Noticias\','.$aRow[$aColumns[$i]].')"><i class="icon-trash"></i>Deletar</a></li>
                              
                              
                              ';
                            $html.='</ul>';
                          $html.='</div>';
                        
                         $row[] = $html;
                    }else if ( $aColumns[$i] == 'data' ){
                         #$date = new DateTime($aRow[$aColumns[$i]]);
                         #$timestamp = $date->getTimestamp();
                         
                         if($aRow[$aColumns[$i]] != ''){
                            $row[] = date("d/m/Y", strtotime($aRow[$aColumns[$i]]));;
                         }else{
                            $row[] = '--/--/----';
                         }
                         
                         
                    }else if ( $aColumns[$i] != ' ' )
                    {
                        /* General output */
                        $row[] = $aRow[$aColumns[$i]];
                    }
                }
                $output['aaData'][] = $row;
            }
            
          #  echo '<pre>';
          #      print_r($output);
          #  echo '</pre>';
            echo json_encode( $output );
        
    }
    
    
    function View(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_artigos'] = $params[0]; 
         $model = new NoticiasModel();
         $uData = $model->Data($dados['id_artigos']);
      
         $dados['title'] = '#'.$uData['0']['id_artigo'].' / '.$uData['0']['titulo'];
          
          $dados['title_btns'][0]['name'] = "Back";
          $dados['title_btns'][0]['class'] = "icon-reply";
          $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
          
          
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Noticia';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "UpdateNoticias();";
       
       
       
       
       $dados['noticia'] = $uData[0];
       
       
       
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Noticias/view.tpl', $dados);
          
          
       
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    
    }
    
    function Create(){
        
       $dados['title'] = 'Criar Notícias';
      
       $dados['title_btns'][0]['name'] = "Back";
       $dados['title_btns'][0]['class'] = "icon-reply";
       $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Nova Notícia';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "SaveNoticias();";
        $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Noticias/new.tpl', $dados);
        $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    }
    
    function ajaxUpdate(){
       $dados = $_POST;
       $dados['alias'] = $this->urlize($dados['titulo']);
       //$dados['data'] = date("Y/m/d");
       
       $data = explode('/',$dados['data']);
       $dataEUA = $data['2'].'-'.$data['1'].'-'.$data['0'];
       $dados['data'] = $dataEUA;
       if($_FILES['foto']['name']){
            $pasta = PATCH_IMAGES;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_chamada'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }
           if($dados['foto_chamada'] == ''){
            unset($dados['foto_chamada']);
        }
        
       unset($dados['foto']);
       str_replace('www.','http://www.',$dados['content_html']);
       $model = new NoticiasModel();  
       $ret = $model->Update($dados);
        
     
       
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
       $dados['alias'] = $this->urlize($dados['titulo']);
       $data = explode('/',$dados['data']);
       $dataEUA = $data['2'].'-'.$data['1'].'-'.$data['0'];
       $dados['data'] = $dataEUA;
       
       
          if($_FILES['foto']['name']){
            $pasta = PATCH_IMAGES;
            $nome_imagem  = $_FILES['foto']['name'];
            $ext = strtolower(strrchr($nome_imagem,"."));
            $nome_atual = md5(date('Y/m/d-H:i:s').rand(1,100)).$ext;
            $tmp = $_FILES['foto']['tmp_name'];
            if(move_uploaded_file($tmp,$pasta.$nome_atual)){
               $dados['foto_chamada'] = $nome_atual;
            }else{
              $retorno['status'] = false;
              $retorno['error'] = 'Não subiu a foto da chamada';
              $retorno['data'] = $dados;  
              echo json_encode($retorno);
              die();
            }
        }
           if($dados['foto_chamada'] == ''){
            unset($dados['foto_chamada']);
        }
        
        
       
     unset($dados['foto']);   
        
        
         str_replace('www.','http://www.',$dados['content_html']);
       
       
      
       $model = new NoticiasModel(); 
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
    
    function ajaxDelete(){
       $dados = $_REQUEST;
       $model = new NoticiasModel(); 
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
    
   function teste(){
       echo "AQUI!";
   }
         
    
}
?>

