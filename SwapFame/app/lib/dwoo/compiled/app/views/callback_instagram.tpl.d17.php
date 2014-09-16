<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><div class="col-md-12">
          <div class="grid simple horizontal green">
            <div class="grid-title ">
              <h4>Authorization was successful!</h4>
              
            </div>
            <div class="grid-body">
              <div>
                <h3>All<span class="semi-bold"> Right!</span></h3>
               <div class="user-comment-wrapper">
                  <div class="profile-wrapper"> 
                  <img src="<?php echo $this->scope["picture"];?>" alt="" data-src="<?php echo $this->scope["picture"];?>" data-src-retina="<?php echo $this->scope["picture"];?>" width="35" height="35">
                  </div>
                  <div class="comment">
                    <div class="user-name text-black bold"><?php echo $this->scope["nome"];?></div>
                    <div class="preview-wrapper">@ <?php echo $this->scope["username"];?> </div>
                  </div>
                  <div class="clearfix"></div>
                </div>
                <p>Now you can use all the features of our SwapFame!</p>
                <a class="btn  btn-info" type="button" href='<?php echo $_SESSION['sys']['base_url'];?>'> <span class="pull-left"><i class="fa fa-instagram"></i></span> <span class="bold">&nbsp;&nbsp;Dashboard</span></a>
                
              </div>
            </div>
          </div>
        </div><?php  /* end template body */
return $this->buffer . ob_get_clean();
?>