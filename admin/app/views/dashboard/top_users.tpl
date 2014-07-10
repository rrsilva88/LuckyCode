 <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Total Pedidos</th>
                  </tr>
                </thead>
                <tbody>
                
                {foreach $usuarios usuario}
                  <tr>
                    <td><a  onclick="visualizaUser({$usuario.id_user});return false;">{$usuario.id_user}</a></td>
                    <td><a  onclick="visualizaUser({$usuario.id_user});return false;">{$usuario.nome}</a></td>
                    <td><a  onclick="visualizaUser({$usuario.id_user});return false;">{$usuario.total}</a></td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>