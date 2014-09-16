<ul class="breadcrumb">
        <li>
          <p>Atividades</p>
        </li>
        <li><a href="#" class="active">Selecionando Mídia</a> </li>
      </ul>
      <div class="page-title"> <i class="fa fa-check-square-o"></i>
        <h3>Selecione uma <span class="semi-bold">Mídia</span></h3>
      </div>
<div id='list_feed_instagram'>
{foreach $api.data pic}
            <div class="col-md-6 col-vlg-4 col-sm-12" id='midia_instagram_{$pic.id}'>
                <!-- BEGIN BLOG POST BIG IMAGE WIDGET -->
                <div class="tiles overflow-hidden full-height tiles-overlay-hover m-b-20 widget-item">
                  <div class="controller overlay right"></div>
                
                  <div class="overlayer bottom-left fullwidth">
                    <div class="overlayer-wrapper">
                      <div class="tiles gradient-grey p-l-20 p-r-20 p-b-20 p-t-20">
                      {if $pic.likes.count > 0}
                        <a href="#" class="hashtags transparent">{$pic.likes.count} Likes </a>
                      {/if}
                      {if $pic.comments.count > 0}
                        <a href="#" class="hashtags transparent">{$pic.comments.count} Comentários  </a>
                      {/if}
                       
                        <p class="p-t-5 p-b-5 ">
                        {if $pic.caption.text}
                            {$pic.caption.text}
                          {else}
                                ...    
                          {/if}
                        </p>
                        <button type="button" class="btn btn-primary" id='btn_instagram_{$pic.id}'  onclick="ConfigAtividade('Midia','{$pic.id}')">Criar Atividade</button>
                      </div>
                    </div>
                  </div>
                  <img id='pic_instagram_{$pic.id}' src="{$pic.images.standard_resolution.url}" data-src="{$pic.images.standard_resolution.url}" data-src-retina="{$pic.images.standard_resolution.url}" alt="" class="image-responsive-width hover-effect-img"> 
                </div>
                </div>
{/foreach}    

</div>
       
      
   