 <style>

.dataTables_length {
    float: left;
    
}

.dataTables_filter {
    float: right;
    text-align: right;
}
.dropdown-menu li{
    text-align:left;
}

</style>

 
 <table id="motoboys" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Status Envio</th>
                    
                  </tr>
                </thead>
                <tbody>
                
                {foreach $motoboys motoboy}
                  <tr>
                    <td>{$motoboy.id_motoboy}</td>
                     <td>{$motoboy.nome}</td>
                    <td>{$motoboy.envio_gsm}</td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>