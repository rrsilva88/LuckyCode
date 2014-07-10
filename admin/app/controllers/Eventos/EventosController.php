<?php
include MODELS.'Eventos/EventosModel.php';

class Eventos extends Controller{
    function index(){
        $model = new EventosModel();
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Lista de Eventos';
       
       $data['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $data['content'][1]['footer'][1]['title'] = 'Criar Evento';
       $data['content'][1]['footer'][1]['href'] = "Eventos/Create";
       
       $dados['fields'] = array('Título','Alias','Início','Termino','Ações');
       $dados['url_dados'] = BASE_URL."Eventos/ajaxListEventos";
       $dados['order_table']['field'] = 4;
       $dados['order_table']['tipo'] = 'DESC';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    
    function ajaxListEventos(){
          // FIX BUG CHROME
          #header('Access-Control-Allow-Origin: *');
          $aColumns = array('titulo','alias','data_ini', 'data_fim', 'id_evento');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_evento";
             
            /* DB table to use */
            $sTable = "eventos";
            
            
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
                            
                            if($aColumns[$i] == 'data_ini'){
                                $sWhere .= "DATE_FORMAT(data_ini,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
                            }elseif($aColumns[$i] == 'data_fim'){
                                $sWhere .= "DATE_FORMAT(data_fim,'%d/%m/%Y') LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
                    
                    if($aColumns[$i] == 'data_ini'){
                        $sWhere .= "DATE_FORMAT(data_ini,'%d/%m/%Y') LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";    
                    }elseif($aColumns[$i] == 'data_fim'){
                        $sWhere .= "DATE_FORMAT(data_fim,'%d/%m/%Y') LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";    
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
            
            $model = new EventosModel(); 
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
                     if ( $aColumns[$i] == 'id_evento' ){
                        $html ='
                            <div class="btn-group" id="Eventos_'.$aRow[$aColumns[$i]].'">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a href="Eventos/View/'.$aRow[$aColumns[$i]].'"><i class="icon-zoom-in"></i>Visualizar</a></li>
                              
                              <li><a  onclick="Delete(\'Eventos\','.$aRow[$aColumns[$i]].')"><i class="icon-trash"></i>Deletar</a></li>
                              
                              
                              ';
                            $html.='</ul>';
                          $html.='</div>';
                        
                         $row[] = $html;
                    }else if ( $aColumns[$i] == 'data_fim' ||  $aColumns[$i] == 'data_ini'){
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
         $dados['id_eventos'] = $params[0]; 
         $model = new EventosModel();
         $uData = $model->Data($dados['id_eventos']);
      
         $dados['title'] = '#'.$uData['0']['id_evento'].' / '.$uData['0']['titulo'];
          
          $dados['title_btns'][0]['name'] = "Back";
          $dados['title_btns'][0]['class'] = "icon-reply";
          $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
          
          
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Informações do Evento';
       $dados['content'][1]['icon'] = 'icon-group';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "UpdateEventos();";
       
       
       
       
       $dados['evento'] = $uData[0];
       
       
       
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Eventos/view.tpl', $dados);
          
          
          
          
       $campos = $model->getCamposEvento($dados['id_eventos']);    
      # echo '<pre>';
      # print_r($campos);
       if(is_array($campos)){
           foreach($campos as $k=>$v){
               
               $v['params'] = explode(',',$v['params']);               
               $dados['preview'].= $this->dwoo->get('app/views/Eventos/preview_campo.tpl', $v);
           }
           
       }
       
       
       
             
       $dados['content'][2]['size'] = 12;
       $dados['content'][2]['name'] = 'FORM MAKER';
       $dados['content'][2]['icon'] = 'icon-group';
       $dados['content'][2]['html'] = $this->dwoo->get('app/views/Eventos/form_maker.tpl', $dados);
       $dados['content'][2]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][2]['footer'][1]['title'] = 'Adicionar Campo';
       $dados['content'][2]['footer'][1]['onclick'] = "AdicionarCampo();";            
            
            
            
       $inscritos = $this->getInscritos($dados['id_eventos']);     
       
            
            if(is_array($inscritos['inscritos'])){
                    $dados['content'][3]['size'] = 12;
                    $dados['content'][3]['name'] = 'INSCRITOS';
                    $dados['content'][3]['icon'] = 'icon-group';
                    $dados['content'][3]['html'] = $this->dwoo->get('app/views/Eventos/inscritos.tpl', $inscritos);       
                
            }
             
       
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    
    }
    
    function ajaxAdicionarCampo(){
        $dados = $_POST;
        $model = new EventosModel();  
        $ret = $model->SaveCampo($dados);
        if(is_numeric($ret['id'])){
            $dados['id_evento_form'] = $ret['id'];
            $dados['params'] = explode(',',$dados['params']);
            
           # print_r($dados);
            $retorno['html'] = $this->dwoo->get('app/views/Eventos/preview_campo.tpl', $dados);
            $retorno['status'] = true;
        }else{
            $retorno['status'] = false;
        }
        
        echo json_encode($retorno);
        
    }
    
    function ajaxDeleteCampoEvento(){
       $dados = $_POST;
       $model = new EventosModel(); 
       $ret = $model->DeleteCampoEvento($dados);
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
        
       $dados['title'] = 'Criar Eventos';
      
       $dados['title_btns'][0]['name'] = "Back";
       $dados['title_btns'][0]['class'] = "icon-reply";
       $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Novo Evento';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "SaveEventos();";
        $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Eventos/new.tpl', $dados);
        $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    }
    
    function ajaxUpdate(){
       $dados = $_POST;
       $dados['alias'] = $this->urlize($dados['titulo']);
       //$dados['data'] = date("Y/m/d");
       
       $dataINI = explode('/',$dados['data_ini']);
       $dataIniEUA = $dataINI['2'].'-'.$dataINI['1'].'-'.$dataINI['0'];
       $dados['data_ini'] = $dataIniEUA;
       
       $dataFIM = explode('/',$dados['data_fim']);
       $dataFimEUA = $dataFIM['2'].'-'.$dataFIM['1'].'-'.$dataFIM['0'];
       $dados['data_fim'] = $dataFimEUA;
       
       
       
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
       $model = new EventosModel();  
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
       
       $dataINI = explode('/',$dados['data_ini']);
       $dataIniEUA = $dataINI['2'].'-'.$dataINI['1'].'-'.$dataINI['0'];
       $dados['data_ini'] = $dataIniEUA;
       
       $dataFIM = explode('/',$dados['data_fim']);
       $dataFimEUA = $dataFIM['2'].'-'.$dataFIM['1'].'-'.$dataFIM['0'];
       $dados['data_fim'] = $dataFimEUA;
       
       
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
       
       
      
       $model = new EventosModel(); 
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
    
    function getInscritos($id_evento){
        $dados = $_REQUEST;
        $model = new EventosModel();  
        $inscritos = $model->getInscritosEvento($id_evento);
      
        $titulos = array();
        $tabela = array();
        foreach($inscritos as $k=>$v){
            
            $id = $v['id_inscricao'];
            $id_campo =  $v['id_evento_form'];
            
            if(!isset($titulos[$id_campo])){
                $titulos[$id_campo]['nome'] = $v['nome'];
                $titulos[$id_campo]['id'] = $id_campo;
            }
            
            
            $tabela[$id]['id_inscricao'] = $id;
            $tabela[$id]['campos'][$id_campo] = $v;
        }
        
        
        $retorno['titulos'] = $titulos;
        $retorno['inscritos'] =$tabela; 
        
        return $retorno;
        
        
    }
    
    function ajaxDelete(){
       $dados = $_REQUEST;
       $model = new EventosModel(); 
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

