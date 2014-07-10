{include('header_old.tpl')}


<div class='content'>
    <div class='content-left'>
    {if $content_left}
        {foreach $content_left widget}
            {$widget}
        {/foreach}
    {/if}    
    </div>
    <div class='content-right'>
        {if $content_right}
            {foreach $content_right widget}
                {$widget}
            {/foreach}
        {/if} 
        <div id="map-canvas"></div>
    </div>
</div>
{include('footer.tpl')}