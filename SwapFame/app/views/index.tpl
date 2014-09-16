{include('header.tpl')}
    <!-- BEGIN NAV MENU -->
        {include('nav.tpl')}
    <!-- END NAV MENU -->    
    <!-- BEGIN CONTAINER -->
        <div class="page-container row-fluid">
            
                <!-- BEGIN SIDEBAR -->
                    {include ('sidebar.tpl')}
                <!-- END SIDEBAR -->
            
  <!-- BEGIN PAGE CONTAINER-->
  <div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>
    <div class="content">
      <div class="page-title">
      </div>
       <!-- BEGIN DASHBOARD TILES -->
    
          
                {if $content}
                         {foreach $content.rows row}
                              <div class="row">
                                    {foreach $row.widgets widget}     
                                        {$widget}
                                    {/foreach}
                              </div>
                         {/foreach}
                  {/if}
           
        
      


       </div>
          </div>
           
      
    <!-- END CONTAINER -->
{include('footer.tpl')}    