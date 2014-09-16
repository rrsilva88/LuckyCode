<div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4><span class="semi-bold">{$table_name}</span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a></div>
            </div>
            <div class="grid-body ">
              <table class="table table-hover table-condensed" id="table_{$table_id}">
                <thead>
                    <tr>
                    {foreach $fields field}
                        <th>{$field}</th>
                    {/foreach}    
                    </tr>
                </thead>
                  <tbody>
                        <tr>
                            <td colspan="5" class="dataTables_empty">Carregando...</td>
                        </tr>
                    </tbody>
              </table>
              
              {if $buttons}
                  {foreach $buttons btn}
                    <button class="btn {$btn.color} btn-cons" type="button" onclick="{$btn.action}"><i class="fa {$btn.icon}"></i>&nbsp;{$btn.text}</button>
                  {/foreach}
              {/if}
              
              
            </div>
          </div>
        </div>
      </div>
      
      
<script type="text/javascript">
$(document).ready(function(){
   
                                      
    $('#table_{$table_id}').dataTable( {
        "bProcessing": true,
        "bServerSide": true,
        {if $order_table}
            "aaSorting": [[ {$order_table.field}, "{$order_table.tipo}" ]],
        {/if}
        "sAjaxSource": "{$url_dados}",
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
    
    
    $('#table_{$table_id}_wrapper .dataTables_filter input').addClass("input-medium "); // modify table search input
    $('#table_{$table_id}_wrapper .dataTables_length select').addClass("select2-wrapper span12"); // modify table per page dropdown
    {literal}$(".select2-wrapper").select2({minimumResultsForSearch: -1});{/literal}

});
</script>