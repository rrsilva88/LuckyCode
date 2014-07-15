<?php
/* template head */
if (function_exists('Dwoo_Plugin_include')===false)
	$this->getLoader()->loadPlugin('include');
/* end template head */ ob_start(); /* template body */ ?><!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en-US"> <!--<![endif]-->
<head>
    <meta charset="UTF-8" />
    <title>LuckyCode <?php if ((isset($this->scope["sub_title"]) ? $this->scope["sub_title"] : null)) {
?>- <?php echo $this->scope["sub_title"];

}?></title>
    <base href="<?php echo $_SESSION['sys']['base_url'];?>">
    <meta name="robots" content="index,follow" />
    <?php if ((isset($this->scope["meta"]) ? $this->scope["meta"] : null)) {
?>
        <meta name="description" content="<?php echo $this->scope["meta"]["description"];?>" />
        <meta property="og:title" content="<?php echo $this->scope["meta"]["og_title"];?>" />
        <meta property="og:url" content="<?php echo $this->scope["meta"]["og_url"];?>" />
        <meta property="og:image" content="<?php echo $this->scope["meta"]["og_image"];?>" />
        <meta property="og:description" content="<?php echo $this->scope["meta"]["og_description"];?>" />
    <?php 
}?>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" /> 
    <!-- ie favicon -->
    <link rel="shortcut icon" href="images/favicon/favicon.ico" type="image/x-icon" />
    <!-- common browsers favicon -->
    <link rel="icon" href="images/favicon/favicon.png" type="image/x-icon" />
    <!-- Standard iPhone --> 
    <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/57x57.png" />
    <!-- Retina iPhone --> 
    <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/114x114.png" />
    <!-- Standard iPad --> 
    <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/72x72.png" />
    <!-- Retina iPad --> 
    <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/144x144.png" />
    <!--[if lt IE 9]>
    <script src="js/libs/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" title="blue" href="css/skin-blue.css" type="text/css" media="all" />
   
    
    <link rel="stylesheet" id="font-awesome-css" href="css/libs/font-awesome/css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" id="magnific-popup-css" href="css/libs/magnific-popup.css" type="text/css" media="all" />
    <link rel="stylesheet" id="animate-css" href="css/libs/animate.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/libs/liquid-slider.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/libs/owl.carousel.css" type="text/css" media="all" />
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="css/ie.css">
        <script src="js/libs/html5.js"></script>
    <![endif]-->
    <link href="http://fonts.googleapis.com/css?family=Bitter|Roboto:400,300,700|Roboto+Slab:300,400,700|Pacifico" rel="stylesheet" type="text/css" />
    <script src="js/libs/jquery-1.10.2.min.js"></script>
    <script src="js/libs/retina-1.1.0.min.js"></script>
    
   
</head>
<body class="widgetized-footer <?php if ((isset($this->scope["body_class"]) ? $this->scope["body_class"] : null)) {

echo $this->scope["body_class"];

}
else {
?>template-home<?php 
}?>">
<div class="primary-wrapper">
    <!-- 
    
        SMALL PAGE HEADER
        
    -->

    <header class="small">
        
        
        <!--form method="get" action="javascript:;" id="top-search-form" class="pull-right">
            <fieldset>
                <input type="text" name="s" value="" placeholder="Buscar..." />
                <a href="javascript:;"><i class="fa fa-search"></i></a>
            </fieldset>
        </form-->
        <span class="social-icons">
            <a href="javascript:;"><i title="Facebook" class="fa fa-facebook-square show-tooltip"></i></a> 
            <a href="javascript:;"><i title="Twitter" class="fa fa-twitter-square show-tooltip"></i></a>
        </span>      
        
        <span class="call-to-us">Contato: <a href="javascript:;">contato@luckycode.com.br</a></span>
        
    </header>

    <!--
    
        BIG HEADER, LOGO AND MENU
        
    -->
    
    <div class="big-header-wrapper">
    
        <a href="page-contact.html" class="header-contact-link"><i class="fa fa-envelope-o"></i></a>
    
        <div class="wrapper">
        
            <div class="header-info-block">
                <p><strong>Contato:</strong> +55 11 9-8696-8444</p>
                <p><strong>Email:</strong> <a href="javascript:;">contato@luckycode.com.br</a></p>
            </div>
        
            <div class="grid">

                <header class="big box unit whole">
                    <div class="grid">
                        <div class="unit one-quarter">
                        
                            <a href="javascript:;" id="phone-toggle-menu" class="show-on-phone"><i class="fa fa-angle-down"></i></a>
                            <a id="logo" href="<?php echo $_SESSION['sys']['base_url'];?>"><img src="images/logo.png" width="300" height="51" alt="" /></a>
                            
                        </div>
            
                     <?php echo Dwoo_Plugin_include($this, 'menu.tpl', null, null, null, '_root', null);?>

                    </div>
                </header>

            </div>
        </div>
    </div>
    <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>