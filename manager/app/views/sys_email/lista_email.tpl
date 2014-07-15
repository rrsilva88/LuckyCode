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
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Status Envio</th>
                    
                  </tr>
                </thead>
                <tbody>
                
                {foreach $emails email}
                  <tr>
                    <td>{$email.nome}</td>
                     <td>{$email.email}</td>
                    <td>{$email.status}</td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>