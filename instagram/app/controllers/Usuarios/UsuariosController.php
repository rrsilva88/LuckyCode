<?php
include MODELS.'Usuarios/UsuariosModel.php';

class Usuarios extends Controller{
    function index(){
        $model = new UsuariosModel();
       
       #$data['content'][1]['size'] = 12;
       #$data['content'][1]['name'] = 'Lista de Notícias';
       
       #$data['content'][1]['footer'][1]['class'] = 'btn btn-success';
       #$data['content'][1]['footer'][1]['title'] = 'Criar Notícia';
       #$data['content'][1]['footer'][1]['href'] = "Usuarios/Create";
       $dados['table_id'] = 'usuarios';
       $dados['table_name'] = 'Usuários';
       $dados['size_md'] = '12';
       $dados['size_vlg'] = '12';
       $dados['size_sm'] = '12';
       $dados['fields'] = array('Nome','Email','Tipo','Ações');
       $dados['url_dados'] = BASE_URL."Usuarios/ajaxListUsuarios";
       $dados['order_table']['field'] = 0;
       $dados['order_table']['tipo'] = 'asc';
       
       $dados['buttons'][1]['color'] = 'btn-primary';
       $dados['buttons'][1]['icon'] = 'fa-plus';
       $dados['buttons'][1]['text'] = 'Novo Usuário';
       $dados['buttons'][1]['action'] = "Create('Usuarios')";
       $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/widget/tables.tpl', $dados);
        
       
       $data['sidebar'] = true;
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html; 
    }
    
    
    
    function ajaxListUsuarios(){
          // FIX BUG CHROME
          #header('Access-Control-Allow-Origin: *');
          $aColumns = array('nome','email','type', 'id_user');
           /* Indexed column (used for fast and accurate table cardinality) */
            $sIndexColumn = "id_user";
             
            /* DB table to use */
            $sTable = "sys_users";
            
            
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
            
            $model = new UsuariosModel(); 
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
                     if ( $aColumns[$i] == 'id_user' ){
                        $html ='
                            <a  onclick="View(\'Usuarios\','.$aRow[$aColumns[$i]].')" class="btn btn-small btn-success btn-cons" title="Visualizar" alt="Visualizar"><i class="fa fa-eye"></i>&nbsp;&nbsp;Visualizar</span></a>
                        ';
                        $row[] = $html;
                    }else if ( $aColumns[$i] == 'type' ){
                       
                        switch($aRow[$aColumns[$i]]){
                            case 1:
                                $row[] = '<button type="button" class="btn btn-small btn-info btn-cons">Simples</button>';    
                            break;
                            case 2:
                                $row[] = '<button type="button" class="btn btn-small btn-primary btn-cons">Cliente</button>';    
                            break;
                            case 3:
                                $row[] = '<button type="button" class="btn btn-small btn-danger btn-cons">Admin</button>';    
                            break;
                        }
                        
                         
                         
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
    
    
    function Visualizar(){
        
        
         $dados = $_REQUEST;
         $params = $this->getParams();
         $dados['id_user'] = $params[0]; 
         $model = new UsuariosModel();
         $uData = $model->Data($dados['id_user']);
      
         $dados['title'] = '#'.$uData['0']['id_user'].' '.$uData['0']['nome'];
         $dados['usuario'] = $uData[0];
         $data['sidebar'] = true;   
         $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Usuarios/view.tpl', $dados);
       
       
       $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;  
      
    
    }
    
    function Criar(){
        
        $data['sidebar'] = true;   
        $data['content']['rows'][1]['widgets'][1] =  $this->dwoo->get('app/views/Usuarios/new.tpl');
        
        $html = $this->dwoo->get('app/views/index.tpl', $data);
       echo $html;  
      
    }
    
    function ajaxUpdate(){
       $dados = $_POST;
       $model = new UsuariosModel();  
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
       $model = new UsuariosModel(); 
       $dados['senha'] = md5($dados['senha']);
       $ret = $model->Save($dados);
       if($ret){
            $retorno['status'] = true;   
            $retorno['id'] = $ret['id'];
            $retorno['data'] = $dados;
        }else{
            $retorno['status'] = false;
            $retorno['data'] = $dados;
        }
        
        
     #   print_r($retorno);
        echo json_encode($retorno);
        
        
    }
    
    function ajaxDelete(){
       $dados = $_REQUEST;
       $model = new UsuariosModel(); 
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

