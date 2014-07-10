 <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Corridas Concluídas</th>
                    <th>Total Cotações</th>
                  </tr>
                </thead>
                <tbody>
                
                {foreach $motoboys motoboy}
                  <tr>
                    <td><a  onclick="visualizaMotoboy({$motoboy.id_motoboy});return false;">{$motoboy.id_motoboy}</a></td>
                    <td><a  onclick="visualizaMotoboy({$motoboy.id_motoboy});return false;">{$motoboy.nome}</a></td>
                    <td><a  onclick="visualizaMotoboy({$motoboy.id_motoboy});return false;">{$motoboy.total_concluidas}</a></td>
                    <td><a  onclick="visualizaMotoboy({$motoboy.id_motoboy});return false;">{$motoboy.total}</a></td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>