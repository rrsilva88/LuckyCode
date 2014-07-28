<div class="col-md-12">
              <div class="grid simple">
                <div class="grid-title no-border">
                  <h4>Criando novo usuário</h4>
                  <div class="tools"><a href="{$dwoo.session.sys.base_url}Usuarios/Visualizar/{$usuario.id_user}" class="reload"></a></div>
                </div>
                  <form id='frm_user'>
                <div class="grid-body no-border"> <br>
                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">
                    
                      <div class="form-group">
                        <label class="form-label">Nome</label>
                        <div class="controls">
                          <input type="text" name='nome'  class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Email</label>
                        <div class="controls">
                          <input type="text" name='email'  class="form-control">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Senha</label>
                        <div class="controls">
                          <input type="password" name='senha'  class="form-control" >
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="form-label">Tipo</label>
                        <div class="  right">                                       
                          <i class=""></i>
                           <select name="type" id="type"  class="select2 form-control"  >
                                      <option value="1" >Simples</option>
                                      <option value="2" >Cliente</option>
                                      <option value="3" >Admin</option>
                           </select>
                        </div>
                      </div> 
                      
                      
                      
                      <div class="form-group">
                        <div class="controls">
                          <button type="button" onclick="Save();" class="btn btn-success btn-cons">Salvar</button>
                        </div>
                      </div>   
                      
                 
                      
                      
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
            
            {literal}
            <script type="text/javascript">
            $(document).ready(function() {                
                    $(".select2").select2();
            
            });
            function Save(){
                 $("#frm_user").ajaxForm({
                    url: "Usuarios/ajaxSave",
                    type:'post',
                    dataType:  'json', 
                    success: function(data) {
                        if(data.status == true){
                            Messenger().post({message: 'Usuário cadastrado com sucesso!',type: 'success',showCloseButton: true});
                            window.location.href = base_url+'Usuarios/Visualizar/'+data.id;
                        }else{
                            Messenger().post({message: 'Erro ao processar esse requisição!',type: 'error',showCloseButton: true});
                        }
                    }
                }).submit(); 
                
            }
            </script>
            {/literal}