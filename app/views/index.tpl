{include('header.tpl')}

<div id="content" {if $body_class}class="wrapper"{/if}>
{if $sections}
    {foreach $sections section}
        {$section}
    {/foreach}
{/if}
</div>
{include('footer.tpl')}


