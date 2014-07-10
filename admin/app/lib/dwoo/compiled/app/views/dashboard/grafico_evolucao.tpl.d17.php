<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>

<div id='grafico' name='grafico' class='grafico'></div>

<script>   



  $(function () {
        $('#grafico').highcharts({
            chart: {
                type: 'spline'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: { // don't display the dummy year
                    month: '%e. %b',
                    year: '%b'
                }
            },
            yAxis: {
                title: {
                    text: 'Total'
                },
                min: 0
            },
            tooltip: {
                formatter: function() {
                        console.log(this.series);
                        return '<b>'+this.y+'-'+this.series.name +'</b><br/>';
                }
            },
            
            series: [
            
            
            <?php $this->scope["c"]=0?>

            <?php 
$_fh1_data = (isset($this->scope["series"]) ? $this->scope["series"] : null);
if ($this->isArray($_fh1_data) === true)
{
	foreach ($_fh1_data as $this->scope['serie'])
	{
/* -- foreach start output */
?>
            <?php if ((isset($this->scope["c"]) ? $this->scope["c"] : null) > 0) {
?>,<?php 
}?>

                {
                    name: '<?php echo $this->scope["serie"]["name"];?>',
                    data: [
                    <?php $this->scope["x"]=0?>

                    <?php 
$_fh0_data = (isset($this->scope["serie"]["dados"]) ? $this->scope["serie"]["dados"]:null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['dado'])
	{
/* -- foreach start output */
?>
                    <?php if ((isset($this->scope["x"]) ? $this->scope["x"] : null) > 0) {
?>,<?php 
}?>

                        [Date.UTC(<?php echo $this->scope["dado"]["data"];?>), <?php echo $this->scope["dado"]["total"];?> ]
                        <?php $this->scope["x"]=((isset($this->scope["x"]) ? $this->scope["x"] : null) + 1)?>

                    <?php 
/* -- foreach end output */
	}
}?>

                    
                    ]
                }
                 <?php $this->scope["c"]=((isset($this->scope["c"]) ? $this->scope["c"] : null) + 1)?>

            <?php 
/* -- foreach end output */
	}
}?>

            
            
            
            ]
        });
    });
    
</script>
<?php  /* end template body */
return $this->buffer . ob_get_clean();
?>