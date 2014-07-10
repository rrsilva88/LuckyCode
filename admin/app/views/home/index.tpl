{include('../header.tpl')}
<body>
<div class="container">
    <header id="header" class="clearfix">
        <!-- Logo -->
        <div class="logo pull-left">
            <a href="home/"><img src="images/logo.png" alt="Enews" /></a>
        </div>
        <!-- Ads -->
        <div class="ads pull-right">
            <img src="images/ads/480x80.png" alt="Ads" />
        </div>
    </header>
    {include('../menu.tpl')}
    <div class="row-fluid">
    
    
        <div id="main" class="{if $dashboard}span8{else}span12{/if}  search-page image-preloader">
            <div class="row-fluid">
            
            {if $alerts}
                <div class="alert alert-{$alerts.type}">
                    <button data-dismiss="alert" class="close" type="button">×</button>
                    <h4>{$alerts.title}</h4>
                    {$alerts.message}
                </div>
            {/if}
    
            
                {if $content}        
                    {foreach $content item}
                        {$item}
                    {/foreach}
                {/if}
            </div>
        </div>
        {if $dashboard}
            <div id="sidebar" class="span4">
                 {if $dashboard}        
                    {foreach $dashboard item}
                        {$item}
                    {/foreach}
                {/if}
            </div>
        {/if}
    
    </div>
</div><!-- End Container -->
    
{include('../footer.tpl')}