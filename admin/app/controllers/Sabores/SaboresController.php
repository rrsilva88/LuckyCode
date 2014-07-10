<?php
include MODELS.'Sabores/SaboresModel.php';
class Sabores extends Controller{
    function index(){
       $data = array();
       
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Sabores';
       $data['content'][1]['footer'][2]['class'] = 'btn btn-info';
       $data['content'][1]['footer'][2]['title'] = 'Cadastrar';
       $data['content'][1]['footer'][2]['onclick'] = "Cadastrar('Sabores');";
       
       
       $dados['fields'] = array('Sabor','Cor','Ações');
       $dados['url_dados'] = BASE_URL."Sabores/ajaxListSabores";
       $dados['order_table']['field'] = 0;
       $dados['order_table']['tipo'] = 'asc';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    function ajaxListSabores(){
          // FIX BUG CHROME
        //  header('Access-Control-Allow-Origin: *');
          
           $aColumns = array('nome','cor','id_sabor');
           $cColumns = array('nome','cor','id_sabor');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_sabor";
             
            /* DB table to use */
            $sTable = 'sabores';
            
            
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
                                //$sWhere = "(SELECT nome FROM Sabores where nome LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%')";
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
                SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", np.", $cColumns))."
                FROM   $sTable as np
                $sWhere
                $sOrder
                $sLimit
            ";
            // FIX COTACOES
 
            $model = new SaboresModel(); 
           # echo "<pre>";
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
                $id_categoria = false;
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    if ( $aColumns[$i] == "status" )
                    {
                        switch($aRow[$aColumns[$i]]){
                            case '0':
                            case 0:
                             $row[] = '<span class="label" id="status_'.$aRow['id_sabor'].'">Inativa</span>';
                            break;
                            
                            case '1':
                            case 1:
                             $row[] = '<span class="label btn-primary" id="status_'.$aRow['id_sabor'].'">Ativa</span>';
                            break;
                          
                        }
                        
                    }else if ( $aColumns[$i] == 'cor' ){
                        
                       if($aRow[$aColumns[$i]] != ''){
                           
                           $row[] = "<center><div style='background-color:".$aRow[$aColumns[$i]].";width:100px;height:30px;'></div></center>";
                       }else{
                           $row[] = 'HOME';                           
                       }
                             
                        
                       
                    }else if ( $aColumns[$i] == 'id_sabor' ){
                        
                       
                            $html ='
                            <div class="btn-group">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a onclick="Visualizar(\'Sabores\','.$aRow[$aColumns[$i]].')"><i class="icon-zoom-in"></i>Visualizar</a></li>
                               <li><a  onclick="Delete(\'Sabores\','.$aRow[$aColumns[$i]].')"><i class="icon-trash"></i>Deletar</a></li>
                              
                              
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
       $model = new SaboresModel(); 
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
       
       
       $model = new SaboresModel();
       $dados['title'] = 'Criar Sabor';
       $dados['title_btns'][0]['name'] = "Back";
       $dados['title_btns'][0]['class'] = "icon-reply";
       $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Novo Sabor';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "SaveSabor();";
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Sabores/new.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    }
    
    
    function View(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_sabor'] = $params[0]; 
         $model = new SaboresModel();
         $uData = $model->Data($dados['id_sabor']);
         
         
         $dados['title'] = '#'.$uData['0']['id_sabor'].' / '.$uData['0']['nome'];
          
          $dados['title_btns'][0]['name'] = "Back";
          $dados['title_btns'][0]['class'] = "icon-reply";
          $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
          
          
       $dados['content'][1]['size'] = 12;
       $dados['content'][1]['name'] = 'Sabor';
       $dados['content'][1]['icon'] = 'icon-th-large';
       
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "UpdateSabor();";
       
       
       
       
       $dados['sabor'] = $uData[0];
       
       #echo '<pre>';
       #print_r($dados);
       #die();
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/Sabores/view.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
      
    
    }
    
    
    
    
    
    function ajaxSave(){
       $dados = $_POST;
       $model = new SaboresModel(); 
       
       
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
       $model = new SaboresModel(); 
       $ret = $model->Update($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $dados['id_sabor'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        echo json_encode($retorno);
        
        
    }
    
     
    
    
    
}
?>