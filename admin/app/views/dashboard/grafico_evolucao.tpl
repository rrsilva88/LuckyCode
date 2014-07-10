

<div id='grafico' name='grafico' class='grafico'></div>
{literal}
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
            
            {/literal}
            {$c = 0}
            {foreach $series serie}
            {if $c>0},{/if}
                {
                    name: '{$serie.name}',
                    data: [
                    {$x = 0}
                    {foreach $serie.dados dado}
                    {if $x>0},{/if}
                        [Date.UTC({$dado.data}), {$dado.total} ]
                        {$x = $x+1}
                    {/foreach}
                    
                    ]
                }
                 {$c = $c+1}
            {/foreach}
            
            {literal}
            
            ]
        });
    });
    
</script>
{/literal}