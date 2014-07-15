<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?> <table id="top_bairro" class="table table-striped table-bordered dataTable">
                <thead>
                  <tr>
                    <th>Bairro Retirada</th>
                    <th>Total Corridas</th>
                  </tr>
                </thead>
                <tbody>
                
                <?php 
$_fh4_data = (isset($this->scope["bairros"]) ? $this->scope["bairros"] : null);
if ($this->isArray($_fh4_data) === true)
{
	foreach ($_fh4_data as $this->scope['bairro'])
	{
/* -- foreach start output */
?>
                  <tr>
                    <td><?php echo $this->scope["bairro"]["remetente_bairro"];?></td>
                    <td><?php echo $this->scope["bairro"]["total"];?></td>
                  </tr>
                <?php 
/* -- foreach end output */
	}
}?>  
                  
                 
                </tbody>
              </table><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>