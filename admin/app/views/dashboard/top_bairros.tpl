 <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Bairro Retirada</th>
                    <th>Total Corridas</th>
                  </tr>
                </thead>
                <tbody>
                
                {foreach $bairros bairro}
                  <tr>
                    <td>{$bairro.remetente_bairro}</td>
                    <td>{$bairro.total}</td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>