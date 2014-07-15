<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ;
echo Dwoo_Plugin_include($this, 'header.tpl', null, null, null, '_root', null);?>


<div id="content" <?php if ((isset($this->scope["body_class"]) ? $this->scope["body_class"] : null)) {
?>class="wrapper"<?php 
}?>>
<?php if ((isset($this->scope["sections"]) ? $this->scope["sections"] : null)) {
?>
    <?php 
$_fh0_data = (isset($this->scope["sections"]) ? $this->scope["sections"] : null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['section'])
	{
/* -- foreach start output */
?>
        <?php echo $this->scope["section"];?>

    <?php 
/* -- foreach end output */
	}
}?>

<?php 
}?>

</div>
<?php echo Dwoo_Plugin_include($this, 'footer.tpl', null, null, null, '_root', null);?>



<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>