 <div class="sidebar-nav nav-collapse collapse">
                 <div class="user_side clearfix">
                   <h5 style="margin-top: 0px;">{$dwoo.session.loginADM.nome}</h5>
                 </div>
                 
                 
                 {$perfil   = $dwoo.session.sys.app.perfil_selecionado}
                 {$menu   = $dwoo.session.loginADM.acesso.$perfil.acesso}
                 {foreach $menu  item}
                    {if $item.visible == 1}
                      <div class="accordion-group">
                        <div class="accordion-heading">
                          <a class="accordion-toggle b_9FDDF6" href="{$item.classe}/{$item.metodo}" alt='{$item.menu}' title='{$item.menu}'><i {if $item.icon != ''}class="{$item.icon}" {else} class="icon-circle-blank" {/if}></i> <span>{$item.menu}</span></a>
                        </div>
                      </div>
                    {/if}
                  {/foreach}   
                  
                  <div class="accordion-group">
                    <div class="accordion-heading">
                      <a class="accordion-toggle b_9FDDF6" onclick='logout()'><i class="icon-off"></i> <span>Sair</span></a>
                    </div>
                  </div>
                  
                  
                </div>
              </div>