<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?> <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Total Pedidos</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php 
$_fh3_data = (isset($this->scope["usuarios"]) ? $this->scope["usuarios"] : null);
if ($this->isArray($_fh3_data) === true)
{
	foreach ($_fh3_data as $this->scope['usuario'])
	{
/* -- foreach start output */
?>
                  <tr>
                    <td><a  onclick="visualizaUser(<?php echo $this->scope["usuario"]["id_user"];?>);return false;"><?php echo $this->scope["usuario"]["id_user"];?></a></td>
                    <td><a  onclick="visualizaUser(<?php echo $this->scope["usuario"]["id_user"];?>);return false;"><?php echo $this->scope["usuario"]["nome"];?></a></td>
                    <td><a  onclick="visualizaUser(<?php echo $this->scope["usuario"]["id_user"];?>);return false;"><?php echo $this->scope["usuario"]["total"];?></a></td>
                  </tr>
                <?php 
/* -- foreach end output */
	}
}?>  
                  
                 
                </tbody>
              </table><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>