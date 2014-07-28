    <div class="row-fluid">
          <div class="overview_boxes">
            <div class="box_row clearfix">
            
              <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#E28271" class="icon-eye-open"></i>
                      <p style="color:#E28271">100%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="100">   
                    </div>
                    <p><strong>{$stats.total}</strong>Pedidos</p>
                  </a>
                </div>
              </div>
              <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#98AEEA" class="icon-credit-card"></i>
                      <p style="color:#98AEEA">{$stats.total_envio_valor_percent}%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="{$stats.total_envio_valor_percent}">   
                    </div>
                    <p><strong>{$stats.total_enviou_valor}/{$stats.total}</strong>Enviou valor</p>
                  </a>
                </div>
              </div>
              
              
              
              <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#98AEEA" class="icon-thumbs-up"></i>
                      <p style="color:#98AEEA">{$stats.total_aceitou_percent}%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="{$stats.total_aceitou_percent}">   
                    </div>
                   <p><strong>{$stats.total_aceitou}/{$stats.total}</strong>Aceitou</p>
                  </a>
                </div>
              </div>

            </div> 
            <div class="box_row clearfix">
            
            
                   <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#AEEA98" class="icon-credit-card"></i>
                      <p style="color:#AEEA98">{$stats.total_concluidas_percent}%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="{$stats.total_concluidas_percent}">   
                    </div>
                    <p><strong>{$stats.total_concluida}/{$stats.total_aceitou}</strong>Concluídas</p>
                    
                  </a>
                </div>
              </div>
            
            <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#E28271" class="icon-bullhorn"></i>
                      <p style="color:#E28271">{$stats.total_recusados_percent}%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="{$stats.total_recusados_percent}">   
                    </div>
                    <p><strong>{$stats.total_recusados}/{$stats.total}</strong>Recusou</p>
                    
                  </a>
                </div>
              </div>
           
           
             
            <div class="widget-tasks-statistics">
                <div class="userstats clearfix" style="margin-top: 25px;">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#example_modal2">
                    <div class="white">
                      <i style="color:#E28271" class="icon-user"></i>
                      <p style="color:#E28271">{$stats.total_nao_respondeu_percent}%</p>
                    </div>
                    <div class="widget">
                      <input class="knob" data-width="120" data-height="120" data-displayInput=false data-readOnly=true data-thickness=".15" value="{$stats.total_nao_respondeu_percent}">   
                    </div>
                    <p><strong>{$stats.total_nao_respondeu}/{$stats.total}</strong>Não respondeu</p>
                    
                  </a>
                </div>
              </div>
           
         
              
            </div> 
          </div>
        </div>  