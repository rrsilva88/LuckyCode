{include('header.tpl')}

<div id="content">
{if $sections}
    {foreach $sections section}
        {$section}
    {/foreach}
{/if}
</div>
{include('footer.tpl')}


