{include('header.tpl')}
{if $sections}
    {foreach $sections section}
        {$section}
    {/foreach}
{/if}
{include('footer.tpl')}


