{include('header.tpl')}
    <div id="wrap">
        <!-- Nav menu -->
        {include('nav.tpl')}
        <!-- /Nav menu -->
        <div class="container-fluid">
             
              <!-- Side menu -->
                {include('sidebar.tpl')}
              <!-- /Side menu -->
         
              <!-- Main window -->
              <div class="main_container" id="dashboard_page">
                {if $title}
              <div class="row-fluid"> 
                  <h2 class="heading">
                    {$title}
                  {if $title_btns}
                      <div class="btn-group pull-right">
                       {foreach $title_btns btn}
                            <button class="btn" {$btn.action} {if $btn.attrs} {foreach $btn.attrs attr}{$attr}{/foreach}{/if}><i class="{$btn.class}" ></i> {$btn.name}</button>
                       {/foreach}
                      </div>
                  {/if}
                  </h2>
              </div>
              {/if}
                 {if $stats == true}
                    {include('stats.tpl')}
                 {/if}
              
             
              
                 {if $content}
                    {$size = 0}
                    {$var_fluid = 0}
                    {$count_widgets = count($content)}
                    {$contador = 1}
                    {foreach $content widget}
                            {if $contador == 1}
                                 <div class="row-fluid {$widget.size}" >  
                            {else}
                                {if $size == 0}
                                    <div class="row-fluid {$widget.size}" >  
                                {/if}
                                    
                            {/if}
                         <div class="widget widget-padding span{$widget.size}">
                                    <div class="widget-header">
                                        {if $widget.icon}<i class="{$widget.icon}"></i>{else}<i class="icon-circle"></i>{/if}
                                        <h5>{$widget.name}</h5>
                                        <div class="widget-buttons">
                                            <a href="javascript:void(0)" class="collapse" data-collapsed="false"><i data-title="Collapse" class="icon-chevron-up"></i></a>
                                        </div>
                                    </div> <!-- /widget-header -->
                                    <div class="widget-body" style="min-height: 170px;">
                                        {$widget.html}
                                    </div><!-- /widget-body -->
                                    {if $widget.footer}  
                                    <div class="widget-footer">
                                        {foreach $widget.footer btns_footer}
                                            <a class="{$btns_footer.class}"  {if $btns_footer.href} href="{$btns_footer.href}"{/if}  {if $btns_footer.onclick} onclick="{$btns_footer.onclick}"{/if}    {if $btns_footer.attrs} {foreach $btns_footer.attrs attr}{$attr}{/foreach}{/if}>{$btns_footer.title}</a>
                                        {/foreach}  
                                    </div>
                                    {/if} 
                              </div><!-- /widget -->
                              
                              
                          {if $contador == $count_widgets}    
                                </div><!-- /fluid -->
                          {else}
                               {if ($size + $widget.size) >= 12}
                                  </div>
                                  {$size = 0}
                               {else}
                                  {$size = $size + $widget.size}
                               {/if}
                          {/if}
                          {$contador = $contador + 1}    
                    {/foreach}
                {/if}    
        </div><!--/.fluid-container-->
    </div>
    <!-- wrap ends-->
{include('footer.tpl')}    