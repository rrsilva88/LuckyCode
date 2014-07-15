{include('header.tpl')}

<div id="content" class="wrapper">
{if $sections}
    {foreach $sections section}
        {$section}
    {/foreach}
{/if}
</div>
{include('footer.tpl')}


