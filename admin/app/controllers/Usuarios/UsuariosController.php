<?php
include MODELS.'Usuarios/UsuariosModel.php';
class Usuarios extends Controller{
    function index(){
      $data = array();
       $model = new UsuariosModel();
       
       $data['content'][1]['size'] = 12;
       $data['content'][1]['name'] = 'Usuários';
       $dados['fields'] = array('Nome','Email','Data Cadastro','Ações');
       $dados['url_dados'] = BASE_URL."Usuarios/ajaxListMotoboy";
       $dados['order_table']['field'] = 2;
       $dados['order_table']['tipo'] = 'desc';
       $data['content'][1]['html'] =  $this->dwoo->get('app/views/widget/dyna_table.tpl', $dados);
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    function View(){
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_user'] = $params[0]; 
         $model = new UsuariosModel();
         // GET DADOS MOTOBOY
         $ret = $model->Get($dados);
       
         
         $dados['user'] = $ret['0'];
         
       #  print_r($dados['user']);
       
         
         
          $dados['title'] = '#'.$dados['user']['id_user'].'/'.$dados['user']['nome'];
          
          $dados['title_btns'][0]['name'] = "Voltar";
          $dados['title_btns'][0]['class'] = "icon-reply";
          $dados['title_btns'][0]['action'] = "onclick='javascript:history.back(-1);'";
          
          
        
          
          
          
       $dados['content'][1]['size'] = 6;
       $dados['content'][1]['name'] = 'Dados';
       $dados['content'][1]['icon'] = 'icon-user';
       
       $dados['content'][1]['footer'][1]['class'] = 'btn btn-success';
       $dados['content'][1]['footer'][1]['title'] = 'Salvar';
       $dados['content'][1]['footer'][1]['onclick'] = "UpdateUser();";
       
       $dados['content'][1]['html'] =  $this->dwoo->get('app/views/usuarios/view.tpl', $dados);
       
       
       
       
       // GET STATS
       $stats = $model->getStats($dados);
       
       $dados['stats_pedido'][0]['title'] = 'Ativo';
       $dados['stats_pedido'][0]['value'] = $stats['0']['total_ativo'];
       
       $dados['stats_pedido'][1]['title'] = 'Entregando';
       $dados['stats_pedido'][1]['value'] =  $stats['0']['total_entregando'];
       
       $dados['stats_pedido'][2]['title'] = 'Entregue';
       $dados['stats_pedido'][2]['value'] = $stats['0']['total_entregue'];
       
       $dados['stats_pedido'][3]['title'] = 'Cancelados';
       $dados['stats_pedido'][3]['value'] = $stats['0']['total_cancelado'];
       
       $dados['stats_pedido'][4]['title'] = 'Total';
       $dados['stats_pedido'][4]['value'] = $stats['0']['total'];
       
       
       
       
       $dados['content'][2]['size'] = 6;
       $dados['content'][2]['name'] = 'Estatísticas';
       $dados['content'][2]['icon'] = 'icon-bar-chart';
       
      
       
       $dados['content'][2]['html'] =  $this->dwoo->get('app/views/usuarios/table_stats.tpl', $dados);
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $dados);
       echo $html;  
       
    }
    
    
    

    
      function ajaxListMotoboy(){
          // FIX BUG CHROME
          header('Access-Control-Allow-Origin: *');
          $aColumns = array('nome', 'email','data_cadastro','id_user');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_user";
             
            /* DB table to use */
            $sTable = "users";
            
            
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
                            $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string( $_GET['sSearch'] )."%' OR ";
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
                    $sWhere .= $aColumns[$i]." LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
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
            
            // INDEX's
           
            $model = new UsuariosModel(); 
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
                $row = array();
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    if ( $aColumns[$i] == 'id_user' ){
                        $html ='
                            <div class="btn-group">
                            <a class="btn btn-small dropdown-toggle" data-toggle="dropdown" href="#">
                            Ações
                              <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu pull-right">
                              <li><a onclick="visualizaUser('.$aRow[$aColumns[$i]].')"><i class="icon-zoom-in"></i>Visualizar</a></li>';
                              #$html.='<li id="btn_bloqueio_'.$aRow['id_motoboy'].'"><a onclick="bloqueiaMotoboy('.$aRow[$aColumns[$i]].')" ><i class=" icon-lock"></i> Bloquear</a></li>';
                              #$html.='<li id="btn_desbloqueio_'.$aRow['id_motoboy'].'"><a onclick="desbloqueiaMotoboy('.$aRow[$aColumns[$i]].')" ><i class="icon-unlock"></i> Desbloquear</a></li>';
                            $html.='</ul>';
                          $html.='</div>';
                        
                         $row[] = $html;
                    }else if ( $aColumns[$i] == 'data_cadastro' ){
                         #$date = new DateTime($aRow[$aColumns[$i]]);
                         #$timestamp = $date->getTimestamp();
                         
                         if($aRow[$aColumns[$i]] != ''){
                            $row[] = date("d/m/Y", strtotime($aRow[$aColumns[$i]]));;
                         }else{
                            $row[] = '--/--/----';
                         }
                         
                         
                    } else if ( $aColumns[$i] == '(SELECT count(*) FROM nm_pedido WHERE id_user = nm_user.id_user) as total_pedidos' )
                    {
                      $row[] = $aRow[$aColumns[$i]];   
                    }
                    else if ( $aColumns[$i] != ' ' )
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
    
    
   
    
    function ajaxUpdate(){
         $dados = $_REQUEST;
         $model = new UsuariosModel();
         $ret = $model->Update($dados);
         if($dados['id_user']){
             
             if($ret){
                 $retorno['status']=true;
                 $retorno['retorno']=$dados;
             }else{
                $retorno['status']=false;    
                $retorno['retorno']='Não atualizou';    
             }
         }else{
                $retorno['status']=false;    
                $retorno['retorno']='Informe o id_user';    
         }
         echo json_encode($retorno);
    }
    
    
    

    function Logout(){
        unset($_SESSION['Motoboy']);
    }
    function Session(){
        print_r($_SESSION);
    }
    
}
?>
