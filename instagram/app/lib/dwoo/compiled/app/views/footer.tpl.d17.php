<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?>
<!--[if lt IE 9]>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/respond.js"></script>
<![endif]-->
                     

<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/boostrapv3/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/breakpoints.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-block-ui/jqueryblockui.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-lazyload/jquery.lazyload.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery.cookie.js" type="text/javascript"></script>

<!-- END CORE JS FRAMEWORK -->
<!-- BEGIN PAGE LEVEL JS -->
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-slider/jquery.sidr.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-numberAnimate/jquery.animateNumbers.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-ricksaw-chart/js/raphael-min.js"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-ricksaw-chart/js/d3.v2.js"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-ricksaw-chart/js/rickshaw.min.js"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-sparkline/jquery-sparkline.js"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/skycons/skycons.js"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-polymaps/polymaps.min.js" type="text/javascript"></script>


<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-flot/jquery.flot.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript" ></script>

                                  
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript" ></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-datatable/js/jquery.dataTables.min.js" type="text/javascript" ></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/datatables-responsive/js/lodash.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/datatables.js" type="text/javascript"></script>

    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.3/underscore-min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/backbone.js/0.9.10/backbone-min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN CORE TEMPLATE JS -->



<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/js/messenger.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/js/messenger-theme-future.js" type="text/javascript"></script>

<!-- JS ONY FOR DEMO-->     
<script type="text/javascript" src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/js/demo/location-sel.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/js/demo/theme-sel.js"></script>
<script type="text/javascript" src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/js/demo/demo.js"></script>


<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/core.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/chat.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/demo.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/dashboard_v2.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/scripts.js" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $(".live-tile,.flip-list").liveTile();
    });
    $('table .checkbox input').click( function() {            
        if($(this).is(':checked')){            
            $(this).parent().parent().parent().toggleClass('row_selected');                    
        }
        else{    
        $(this).parent().parent().parent().toggleClass('row_selected');        
        }
    });
        
        
function logout(){
 $.get("home/Logout",
      function(data){
 
      if(data.status == true){
            window.location.href = base_url;
      }
 }, "json");
}
        
</script>

<!-- END CORE TEMPLATE JS -->
</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>