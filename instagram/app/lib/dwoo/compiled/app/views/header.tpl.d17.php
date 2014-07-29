<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta charset="utf-8" />
<title><?php echo $_SESSION['sys']['title'];?></title>
<base href='<?php echo $_SESSION['sys']['base_url'];?>'>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<meta content="" name="description" />
<meta content="" name="author" />
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-polymaps/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" />



<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/shape-hover/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/shape-hover/css/component.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/owl-carousel/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/owl-carousel/owl.theme.css" />
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-datatable/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>

<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-slider/css/jquery.sidr.light.css" rel="stylesheet" type="text/css" media="screen"/>

<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/css/messenger.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/css/messenger-theme-flat.css" rel="stylesheet" type="text/css" media="screen"/>
<!-- BELOW CSS FILE IS NOT REQUIRED -->
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-notifications/css/location-sel.css" rel="stylesheet" type="text/css" media="screen"/>

<link rel="stylesheet" href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-ricksaw-chart/css/rickshaw.css" type="text/css" media="screen" >
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-isotope/isotope.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-superbox/css/style.css" rel="stylesheet" type="text/css" media="screen"/>



<!-- BEGIN CORE CSS FRAMEWORK -->                                                           
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/boostrapv3/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/boostrapv3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/css/animate.min.css" rel="stylesheet" type="text/css"/>




<!-- END CORE CSS FRAMEWORK -->

<!-- BEGIN CSS TEMPLATE -->
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/css/style.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/css/responsive.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/css/custom-icon-set.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_SESSION['sys']['base_url'];?>assets/css/magic_space.css" rel="stylesheet" type="text/css"/>






                                                                   



<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $_SESSION['sys']['base_url'];?>assets/js/jquery.form.min.js" type="text/javascript"></script>
<!-- END CSS TEMPLATE -->
  <!-- BEGIN GLOBAL VAR JS -->
<script type="text/javascript">
    var base_url = '<?php echo $_SESSION['sys']['base_url'];?>';
</script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class=""><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>