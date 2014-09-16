<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4><span class="semi-bold"><?php echo $this->scope["table_name"];?></span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
            </div>
            <div class="grid-body ">
              <table class="table table-hover table-condensed" id="table_<?php echo $this->scope["table_id"];?>">
                <thead>
                    <tr>
                    <?php 
$_fh0_data = (isset($this->scope["fields"]) ? $this->scope["fields"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['field'])
	{
/* -- foreach start output */
?>
                        <th><?php echo $this->scope["field"];?></th>
                    <?php 
/* -- foreach end output */
	}
}?>    
                    </tr>
                </thead>
                  <tbody>
                        <tr>
                            <td colspan="5" class="dataTables_empty">Carregando...</td>
                        </tr>
                    </tbody>
              </table>
              
              <?php if ((isset($this->scope["buttons"]) ? $this->scope["buttons"] : null)) {
?>
                  <?php 
$_fh1_data = (isset($this->scope["buttons"]) ? $this->scope["buttons"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['btn'])
	{
/* -- foreach start output */
?>
                    <button class="btn <?php echo $this->scope["btn"]["color"];?> btn-cons" type="button" onclick="<?php echo $this->scope["btn"]["action"];?>"><i class="fa <?php echo $this->scope["btn"]["icon"];?>"></i>&nbsp;<?php echo $this->scope["btn"]["text"];?></button>
                  <?php 
/* -- foreach end output */
	}
}?>

              <?php 
}?>

              
              
            </div>
          </div>
        </div>
      </div>
      
      
<script type="text/javascript">
$(document).ready(function(){
   
                                      
    $('#table_<?php echo $this->scope["table_id"];?>').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        <?php if ((isset($this->scope["order_table"]) ? $this->scope["order_table"] : null)) {
?>
            "aaSorting": [[ <?php echo $this->scope["order_table"]["field"];?>, "<?php echo $this->scope["order_table"]["tipo"];?>" ]],
        <?php 
}?>

        "sAjaxSource": "<?php echo $this->scope["url_dados"];?>",
        "sLengthMenu": "_MENU_",
        "sPaginationType": "bootstrap",
        "oLanguage": {
            "sProcessing":   "&nbsp;&nbsp;&nbsp;Processando...",
            "sLengthMenu": "_MENU_",
            "sZeroRecords":  "Não foram encontrados resultados",
            "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
            "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
            "sInfoPostFix":  "",
            "sSearch":       "Buscar:",
            "sUrl":          "",
            "oPaginate": {
                "sFirst":    "Primeiro",
                "sPrevious": "Anterior",
                "sNext":     "Seguinte",
                "sLast":     "Último"
           
           }
       }, bAutoWidth     : false
    });
    
    
    $('#table_<?php echo $this->scope["table_id"];?>_wrapper .dataTables_filter input').addClass("input-medium "); // modify table search input
    $('#table_<?php echo $this->scope["table_id"];?>_wrapper .dataTables_length select').addClass("select2-wrapper span12"); // modify table per page dropdown
    $(".select2-wrapper").select2({minimumResultsForSearch: -1});

});
</script><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>