<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><style type="text/css">
     .fa.fa-star{
       font-size:60px;  
     }
     .fa.fa-star.conta_selecionada{
       color:yellow;  
     }
</style>

<div class="page-title"> <i class="fa fa-instagram"></i>
        <h3>Contas - <span class="semi-bold">Instagram</span></h3>
</div>
<div class="clearfix"><br/></div>
<?php 
$_fh0_data = (isset($_SESSION['accounts'])?$_SESSION['accounts']:null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['conta'])
	{
/* -- foreach start output */
?>
<div class="col-md-4 m-b-10">                    
                   <div class="widget-item narrow-margin">
                  <div class="tiles white ">
                    <div class="tiles-body">
                      <div class="row">
                      
                      <div class="user-profile-pic text-left"> 
                        <img width="69" height="69" data-src-retina="<?php echo $this->scope["conta"]["picture"];?>" data-src="<?php echo $this->scope["conta"]["picture"];?>" src="<?php echo $this->scope["conta"]["picture"];?>" alt=""> 
                        <!--div class="pull-right m-r-20 m-t-35"> <i class="fa fa-star conta_selecionada" alt='Conta selecionada' title='Conta selecionada'></i> </div-->
                      </div>
                      
                      
                        <div class="col-md-5 no-padding">                          
                          <div class="user-comment-wrapper">
                            <div class="comment">
                              <div class="user-name text-black bold"> <?php echo $this->scope["conta"]["nome"];?> </div>
                              <div class="preview-wrapper">@ <?php echo $this->scope["conta"]["username"];?> </div>
                            </div>                              
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-md-12">
                       
                          <div class="clearfix"></div>
                          <div class="pull-right m-r-10 m-t-10 m-b-10  m-l-10">
                            <button type="button" class="btn btn-primary btn-cons" onclick="SelecionarConta('<?php echo $this->scope["conta"]["id_select"];?>')">Selecionar</button>
                            <button type="button" class="btn btn-danger btn-cons"  onclick="DeletarConta('<?php echo $this->scope["conta"]["id_conta_user"];?>')">Excluir</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>

 
<?php 
/* -- foreach end output */
	}
}?>




<div class="col-md-4 m-b-10">                    
                   <div class="widget-item narrow-margin">
                  <div class="tiles white ">
                    <div class="tiles-body">
                      <div class="row">
                        <div class="col-md-12 ">                          
                          <div class="user-comment-wrapper">
                            <div class="comment col-md-12">
                               <center>
                            <i class="fa fa-instagram" style="font-size:50px;"></i>
                                <div class=" text-black bold">Adicionar Conta</div>
                                 <div class="preview-wrapper">Você pode adicionar quantas contas quiser</div>
                                 </center>
                            </div>                              
                            <div class="clearfix"></div>
                          </div>
                        </div>
                        <div class="col-md-12">
                       
                          <div class="clearfix"></div>
                          <div class="">
                            <center><a type="button" href='<?php echo $_SESSION['sys']['auth_link'];?>' class="btn btn-success btn-cons">Adicionar</a></center>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
                
                
                
                
                
            <script type="text/javascript">
            
          
            function DeletarConta(id){
                   $.post(base_url+'Contas/ajaxDelete',
                    
                    { id: id}, function( data ) {
                    if(data.status == true){
                         Messenger().post({message: 'Conta deletada com sucesso!',type: 'success',showCloseButton: true});
                    }else{
                        Messenger().post({message: 'Erro ao deletar essa conta!',type: 'error',showCloseButton: true});
                    }
                    
                    }, "json");   
                    
            }
            </script>
            
                <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>