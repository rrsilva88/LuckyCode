 <table id="users" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Data Fatura</th>
                    <th>Meio Pagamento</th>
                    <th>Data Pagamento</th>
                    <th>Status</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                
                {foreach $faturas fatura}
                  <tr>
                    <td>#{$fatura.id_fatura}</td>
                    <td>R$ {$fatura.valor}</td>
                    <td>{$fatura.data_fatura}</td>
                    <td>{$fatura.meio_pagamento}</td>
                    <td>
                    {if $fatura.data_pagamento}
                        {$fatura.data_pagamento}
                    {else}
                        ---
                    {/if}    
                    </td>
                    
                   
                    
                    <td>
                        {if $fatura.status == 1}
                            <span class="label">Aguardando pagamento</span>
                        {elseif $fatura.status == 2} 
                            <span class="label">Em análise</span>
                        {elseif $fatura.status == 3} 
                            <span class="label label-success">Paga</span>
                            
                        {elseif $fatura.status == 4} 
                            <span class="label">Disponível</span>    
                        {elseif $fatura.status == 5}                              
                            <span class="label">Em disputa</span>    
                        {elseif $fatura.status == 6} 
                            <span class="label label-important">Devolvida</span>   
                        {elseif $fatura.status == 7} 
                            <span class="label label-important">Cancelada</span>
                        {/if}
                    </td>
                    <td>
                      {if $fatura.status == 0}
                            <a  class="btn btn-mini btn-primary" href="{$fatura.url_pagamento}"  >Pagar</a>
                      {/if}
                    </td>
                  </tr>
                {/foreach}  
                  
                 
                </tbody>
              </table>