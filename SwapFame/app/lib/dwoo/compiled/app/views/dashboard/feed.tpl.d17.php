<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><ul class="breadcrumb">
       
        <!--li><a href="#" class="active">Selecionando Mídia</a> </li-->
      </ul>
      <div class="page-title"> <i class="fa fa-dashboard"></i>
        <h3><span class="semi-bold">Dashboard</span></h3>
      </div>
<div id='list_feed_instagram'>
<?php 
$_fh0_data = (isset($this->scope["api"]["data"]) ? $this->scope["api"]["data"]:null);
if ($this->isArray($_fh0_data) === true)
{
	foreach ($_fh0_data as $this->scope['pic'])
	{
/* -- foreach start output */
?>





<div class="col-md-6 col-vlg-4 col-sm-12 " id='midia_instagram_<?php echo $this->scope["pic"]["id"];?>'>            
  <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
   <div class="controller overlay right">
   
   <div class="user-comment-wrapper">
                        <div class="profile-wrapper"> <img src="<?php echo $this->scope["pic"]["user"]["profile_picture"];?>" alt="" data-src="<?php echo $this->scope["pic"]["user"]["profile_picture"];?>" data-src-retina="<?php echo $this->scope["pic"]["user"]["profile_picture"];?>" width="35" height="35"> </div>
                        <div class="comment">
                          <div class="user-name text-white "><span class="bold">@<?php echo $this->scope["pic"]["user"]["username"];?></span></div>
                          <p class="text-white-opacity"><?php echo $this->scope["pic"]["user"]["full_name"];?></p>
                        </div>
                        <div class="clearfix"></div>
                      </div>
   </div>
    
    <div class="overlayer bottom-left fullwidth">
      <div class="overlayer-wrapper">
        <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20"> 
            <?php if ((isset($this->scope["pic"]["likes"]["count"]) ? $this->scope["pic"]["likes"]["count"]:null) > 0) {
?>
                <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["likes"]["count"];?> Likes </a>
            <?php 
}
else {
?>
                <a href="#" class="hashtags transparent">Like this </a>
            <?php 
}?>

            <?php if ((isset($this->scope["pic"]["comments"]["count"]) ? $this->scope["pic"]["comments"]["count"]:null) > 0) {
?>
                <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["comments"]["count"];?> Comments  </a>
            <?php 
}?>

            <?php if ((isset($this->scope["pic"]["comments"]["count"]) ? $this->scope["pic"]["comments"]["count"]:null) > 0) {
?>
                <a href="#" class="hashtags transparent"><?php echo $this->scope["pic"]["comments"]["count"];?> Followers  </a>
            <?php 
}?>

          <p class="p-t-10 p-b-10 "><span class="bold">  
            <?php if ((isset($this->scope["pic"]["caption"]["text"]) ? $this->scope["pic"]["caption"]["text"]:null)) {
?>
                <?php echo $this->scope["pic"]["caption"]["text"];?>

            <?php 
}
else {
?>
                ...    
            <?php 
}?>

          </p>
          
          <div class="profile-img-wrapper inline m-r-5">
            <img src="<?php echo $_SESSION['account_selected']['picture'];?>" alt="" data-src="<?php echo $_SESSION['account_selected']['picture'];?>" data-src-retina="<?php echo $_SESSION['account_selected']['picture'];?>" width="35" height="35"> 
          </div>

          <input type="text" class="dark m-r-5" id="txtinput1" placeholder="Write a comment" style="width:75%">
          <button type="button" class="btn btn-primary">Send</button>
        </div>
      </div>
    </div>
    <img id='pic_instagram_<?php echo $this->scope["pic"]["id"];?>' src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" data-src-retina="<?php echo $this->scope["pic"]["images"]["standard_resolution"]["url"];?>" class="image-responsive-width hover-effect-img"> 
    </div>
</div>



     
<?php 
/* -- foreach end output */
	}
}?>    

</div>
       <?php  /* end template body */
return $this->buffer . ob_get_clean();
?>