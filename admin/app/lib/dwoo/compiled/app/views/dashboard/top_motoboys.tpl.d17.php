<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?> <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Corridas Concluídas</th>
                    <th>Total Cotações</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php 
$_fh2_data = (isset($this->scope["motoboys"]) ? $this->scope["motoboys"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['motoboy'])
	{
/* -- foreach start output */
?>
                  <tr>
                    <td><a  onclick="visualizaMotoboy(<?php echo $this->scope["motoboy"]["id_motoboy"];?>);return false;"><?php echo $this->scope["motoboy"]["id_motoboy"];?></a></td>
                    <td><a  onclick="visualizaMotoboy(<?php echo $this->scope["motoboy"]["id_motoboy"];?>);return false;"><?php echo $this->scope["motoboy"]["nome"];?></a></td>
                    <td><a  onclick="visualizaMotoboy(<?php echo $this->scope["motoboy"]["id_motoboy"];?>);return false;"><?php echo $this->scope["motoboy"]["total_concluidas"];?></a></td>
                    <td><a  onclick="visualizaMotoboy(<?php echo $this->scope["motoboy"]["id_motoboy"];?>);return false;"><?php echo $this->scope["motoboy"]["total"];?></a></td>
                  </tr>
                <?php 
/* -- foreach end output */
	}
}?>  
                  
                 
                </tbody>
              </table><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>