<div class="col-md-6 single-colored-widget">
          <div class="content-wrapper green">
            <h3 class="text-white"><span class="semi-bold">Seguidores</span></h3>
            <p class="text-white">Aumente seu número de seguidores<br></p>
            <div class="pull-left">
                <h3>Total de Seguidores <span class="semi-bold">{$api.data.counts.followed_by}</span></h3>
            </div>
            <div class="pull-right"> <i class="fa fa-instagram fa fa-6x custom-icon-space" id="icon-resize"></i> </div>
            <div class="clearfix"></div>
          </div>
          <div class="heading">
            <div class="pull-left">
                <a href="{$dwoo.session.sys.base_url}Atividades/Configurar/Seguidores/{$api.data.id}" type="button" class="btn btn-primary btn-cons"><i class="fa fa-instagram"></i>&nbsp;&nbsp;<span class="bold">Criar</span></a>
            </div>
            
            <div class="clearfix"> </div>
          </div>
        </div>
        
        <div class="col-md-6 single-colored-widget">
          <div class="content-wrapper blue">
            <h3 class="text-white"><span class="semi-bold">Likes & Comentários </span></h3>
            <p  class="text-white">Viralize suas postagens e crie trending topics com suas hashtags</p>
            <div class="pull-left">
                <h3>Total de Mídias <span class="semi-bold">{$api.data.counts.media}</span></h3>
            </div>
            
            <div class="pull-right"> 
                    <i class="icon-repeat fa-6x custom-icon-space fa fa-thumbs-up" id="icon-rotate"></i>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="heading">
            <div class="pull-left">
              <a href="{$dwoo.session.sys.base_url}Atividades/Selecionar/" type="button" class="btn btn-success btn-cons"><i class="fa fa-thumbs-up"></i>&nbsp;&nbsp;<span class="bold">Criar</span></a>
              
            </div>
            <div class="clearfix"> </div>
          </div>
        </div>
        