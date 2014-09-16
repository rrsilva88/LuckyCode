<ul class="breadcrumb">
       
        <!--li><a href="#" class="active">Selecionando Mídia</a> </li-->
      </ul>
      <div class="page-title"> <i class="fa fa-dashboard"></i>
        <h3><span class="semi-bold">Dashboard</span></h3>
      </div>
<div id='list_feed_instagram'>
{foreach $api.data pic}





<div class="col-md-6 col-vlg-4 col-sm-12 " id='midia_instagram_{$pic.id}'>            
  <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
   <div class="controller overlay right">
   
   <div class="user-comment-wrapper">
                        <div class="profile-wrapper"> <img src="{$pic.user.profile_picture}" alt="" data-src="{$pic.user.profile_picture}" data-src-retina="{$pic.user.profile_picture}" width="35" height="35"> </div>
                        <div class="comment">
                          <div class="user-name text-white "><span class="bold">@{$pic.user.username}</span></div>
                          <p class="text-white-opacity">{$pic.user.full_name}</p>
                        </div>
                        <div class="clearfix"></div>
                      </div>
   </div>
    
    <div class="overlayer bottom-left fullwidth">
      <div class="overlayer-wrapper">
        <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20"> 
            {if $pic.likes.count > 0}
                <a href="#" class="hashtags transparent">{$pic.likes.count} Likes </a>
            {else}
                <a href="#" class="hashtags transparent">Like this </a>
            {/if}
            {if $pic.comments.count > 0}
                <a href="#" class="hashtags transparent">{$pic.comments.count} Comments  </a>
            {/if}
            {if $pic.comments.count > 0}
                <a href="#" class="hashtags transparent">{$pic.comments.count} Followers  </a>
            {/if}
          <p class="p-t-10 p-b-10 "><span class="bold">  
            {if $pic.caption.text}
                {$pic.caption.text}
            {else}
                ...    
            {/if}
          </p>
          
          <div class="profile-img-wrapper inline m-r-5">
            <img src="{$dwoo.session.account_selected.picture}" alt="" data-src="{$dwoo.session.account_selected.picture}" data-src-retina="{$dwoo.session.account_selected.picture}" width="35" height="35"> 
          </div>

          <input type="text" class="dark m-r-5" id="txtinput1" placeholder="Write a comment" style="width:75%">
          <button type="button" class="btn btn-primary">Send</button>
        </div>
      </div>
    </div>
    <img id='pic_instagram_{$pic.id}' src="{$pic.images.standard_resolution.url}" data-src="{$pic.images.standard_resolution.url}" data-src-retina="{$pic.images.standard_resolution.url}" class="image-responsive-width hover-effect-img"> 
    </div>
</div>



     
{/foreach}    

</div>
       