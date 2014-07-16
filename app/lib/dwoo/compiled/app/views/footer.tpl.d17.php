<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><footer id="footer" data-appear-animation="fadeIn">
    
        <!--
        
            FOOTER WIDGETS
            
        -->
        <div class="wrapper grid">
        
            <!--
                ABOUT US WIDGET
            -->
            <div class="unit one-quarter widget widget-about">
                <a href="javascript:;" class="footer-logo ib"><img src="images/logo_white.png" width="300" height="51" alt="" /></a>
                
                <p>Sorte é o que acontece quando a preparação encontra a oportunidade <br /><br /><small>Elmer Letterman</small></p>
                
            </div>
            
            <!--
                CONTACT US WIDGET
            -->
            <div class="unit one-quarter widget widget-contact-us">
                
                <h4 class="widget-title">Contato</h4>
                
                <form action="javascript:;" method="post">
                    <fieldset>
                        <p>
                            <input type="text" name="" value="" placeholder="Nome" />
                        </p>
                        <p>
                            <input type="email" name="" value="" placeholder="Email" />
                        </p>
                        <p>
                            <textarea name="" placeholder="Mensagem"></textarea>
                        </p>
                        <p>
                            <span class="captcha">
                                2+2 = <input type="text" value="" />
                            </span>
                            <input type="submit" value="Enviar" />
                        </p>
                    </fieldset>
                </form>
                
            </div>
            
            <!--
                LATEST POSTS WIDGET
            -->
            <div class="unit one-quarter widget widget-latest-posts">
                
              <a class="twitter-timeline" href="https://twitter.com/lucky_code" data-widget-id="489532145358995457">Tweets by @lucky_code</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


                
            </div>
            
            <!--
                RECENT PHOTOS WIDGET
            -->
            <div class="unit one-quarter widget widget-recent-photos">
                 <div class="fb-like-box" data-href="https://www.facebook.com/pages/Lucky-Code/552597521430145?ref=hl" data-width="250" data-height="350" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
             
            </div>
        
        </div>
    
    </footer>
    
    <div id="primary-footer">
        <div class="wrapper grid">
            <div class="unit half">
                &copy; 2014 Luckycode. Todos os direitos reservados.
            </div>
            <div class="unit half">
                <span class="social-icons">
                    <a href="javascript:;"><i data-tip-gravity="s" title="Facebook" class="fa fa-facebook-square show-tooltip"></i></a> 
                    <a href="javascript:;"><i data-tip-gravity="s" title="Twitter" class="fa fa-twitter-square show-tooltip"></i></a>
                </span>   
            </div>
        </div>
    </div>

    <!--
    
        STYLE SWITCHER
        
    -->

    

</div>

    <script src="js/libs/nprogress.js"></script>
    <script>
        NProgress.start();
    </script>
    <script src="js/libs/jquery.tipsy.js"></script>
    <script src="js/libs/jquery.ui.totop.min.js"></script>
    <script src="js/libs/jquery.fs.scroller.min.js"></script>
    <script src="js/libs/jquery.fs.selecter.min.js"></script>
    <script src="js/libs/jquery.magnific-popup.min.js"></script>
    <script src="js/libs/jquery.easing.1.3.js"></script>
    <script src="js/libs/jquery.liquid-slider.js"></script>
    <script src="js/libs/jquery.touchSwipe.min.js"></script>
    <script src="js/libs/jquery.waitforimages.js"></script>
    <script src="js/libs/jquery.icheck.min.js"></script>
    <script src="js/libs/jquery.bxslider.min.js"></script>
    <script src="js/libs/owl.carousel.min.js"></script>
    <script src="js/libs/jquery.appear.js"></script>
    <script src="js/libs/jquery-ui-1.10.3.custom.min.js"></script>
    <script src="js/libs/masonry.pkgd.min.js"></script>
    <script src="js/libs/idangerous.swiper-2.4.min.js"></script>
    <script src="js/front.js"></script>
    <!-- STYLE SWITCHER JS, YOU CAN REMOVE IT ALL AT REAL PROJECT -->
    <script src="js/libs/jquery.cookie.js"></script>
    <script src="js/libs/jquery.mCustomScrollbar.min.js"></script>
    <script src="js/libs/less-1.5.1.min.js"></script>
    <script src="js/styleSwitcher.js"></script>

    
    
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-42345592-1', 'auto');
    ga('send', 'pageview');
</script>


<script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '542219092476553',
          xfbml      : true,
          version    : 'v2.0'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>
    

       


    
</body>
</html><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>