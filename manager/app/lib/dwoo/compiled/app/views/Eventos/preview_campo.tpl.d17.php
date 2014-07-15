<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?> <div class="control-group" id='campo-<?php echo $this->scope["id_evento_form"];?>'>
        <label class="control-label"><?php echo $this->scope["nome"];?></label>
        <div class="controls">
        
        <?php if ((isset($this->scope["type"]) ? $this->scope["type"] : null) == 'input') {
?>
          <input class="span8" name='<?php echo $this->scope["nome"];?>' type="text" placeholder="<?php echo $this->scope["nome"];?>">
          <span class="help-inline"><button type="button" class="btn  btn-danger" style="margin-top: -12px;" onclick="excluiCampoEvento(<?php echo $this->scope["id_evento_form"];?>)" >Excluir</button></span>
        <?php 
}?>

        
         
        <?php if ((isset($this->scope["type"]) ? $this->scope["type"] : null) == 'select') {
?>
            <select name='type' class="span8">
                <?php 
$_fh0_data = (isset($this->scope["params"]) ? $this->scope["params"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                    <option value="<?php echo $this->scope["p"];?>" ><?php echo $this->scope["p"];?></option>
                <?php 
/* -- foreach end output */
	}
}?>

            </select>
            <span class="help-inline"><button type="button" class="btn  btn-danger" style="margin-top: -12px;" onclick="excluiCampoEvento(<?php echo $this->scope["id_evento_form"];?>)" >Excluir</button></span>
        <?php 
}?>

        
        <?php if ((isset($this->scope["type"]) ? $this->scope["type"] : null) == 'radio') {
?>
                <?php 
$_fh1_data = (isset($this->scope["params"]) ? $this->scope["params"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                    <label class="radio ">
                        <input type='radio' name='<?php echo $this->scope["nome"];?>' value="<?php echo $this->scope["p"];?>" ><?php echo $this->scope["p"];?></option>
                    </label>
                <?php 
/* -- foreach end output */
	}
}?>

                <span class="help-inline"><button type="button" class="btn  btn-danger" style="" onclick="excluiCampoEvento(<?php echo $this->scope["id_evento_form"];?>)" >Excluir</button></span>
        <?php 
}?>

        
        <?php if ((isset($this->scope["type"]) ? $this->scope["type"] : null) == 'checkbox') {
?>
                <?php 
$_fh2_data = (isset($this->scope["params"]) ? $this->scope["params"] : null);
if ($this->isArray($_fh2_data) === true)
{
	foreach ($_fh2_data as $this->scope['p'])
	{
/* -- foreach start output */
?>
                <label class="checkbox">
                    <input type='checkbox' name='<?php echo $this->scope["nome"];?>[]' value="<?php echo $this->scope["p"];?>" ><?php echo $this->scope["p"];?></option>
                </label>
                <?php 
/* -- foreach end output */
	}
}?>

                <span class="help-inline"><button type="button" class="btn  btn-danger" style="" onclick="excluiCampoEvento(<?php echo $this->scope["id_evento_form"];?>)" >Excluir</button></span>
        <?php 
}?>

        
        
        
        </div>
    </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>