<div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Editando: <span class="semi-bold">{$title}</span></h4>
                  <div class="tools"><a href="{$dwoo.session.sys.base_url}Usuarios/Visualizar/{$usuario.id_user}" class="reload"></a></div>
                </div>
                <form id='frm_user'>
                <input type='hidden' name='id_user' value='{$usuario.id_user}'>
                <div class="grid-body no-border"> <br>
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                    
                      <div class="form-group">
                        <label class="form-label">Nome</label>
                        <div class="controls">
                          <input type="text" name='nome' value='{$usuario.nome}' class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="controls">
                          <input type="text" name='email' value='{$usuario.email}' class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Senha</label>
                        <div class="controls">
                          <input type="password"  value='{$usuario.senha}' class="form-control" >
                        </div>
                      </div>
                      
                      
                      
                      <div class="form-group">
                        <label class="form-label">Tipo</label>
                        <div class="  right">                                       
                          <i class=""></i>
                           <select name="type" id="cardType"  class="select2 form-control"  >
                                      <option value="1" {if $usuario.type== 1}SELECTED='SELECTED'{/if}>Simples</option>
                                      <option value="2" {if $usuario.type== 2}SELECTED='SELECTED'{/if}>Cliente</option>
                                      <option value="3" {if $usuario.type== 3}SELECTED='SELECTED'{/if}>Admin</option>
                           </select>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="controls">
                          <button type="button" onclick="Update();" class="btn btn-success btn-cons">Salvar</button>
                        </div>
                      </div>  
                      
                  </form>
                      
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            {literal}
            <script type="text/javascript">
            $(document).ready(function() {                
                    $(".select2").select2();
            
            });
            function Update(){
                 $("#frm_user").ajaxForm({
                    url: "Usuarios/ajaxUpdate",
                    type:'post',
                    dataType:  'json', 
                    success: function(data) {
                        if(data.status == true){
                            Messenger().post({message: 'Cadastrado atualizado com sucesso!',type: 'success',showCloseButton: true});
                        }else{
                            Messenger().post({message: 'Erro ao processar!',type: 'error',showCloseButton: true});
                        }
                    }
                }).submit(); 
                
            }
            </script>
            {/literal}