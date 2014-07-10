 <div class="control-group" id='campo-{$id_evento_form}'>
        <label class="control-label">{$nome}</label>
        <div class="controls">
        
        {if $type == 'input'}
          <input class="span8" name='{$nome}' type="text" placeholder="{$nome}">
          <span class="help-inline"><button type="button" class="btn  btn-danger" style="margin-top: -12px;" onclick="excluiCampoEvento({$id_evento_form})" >Excluir</button></span>
        {/if}
        
         
        {if $type == 'select'}
            <select name='type' class="span8">
                {foreach $params p}
                    <option value="{$p}" >{$p}</option>
                {/foreach}
            </select>
            <span class="help-inline"><button type="button" class="btn  btn-danger" style="margin-top: -12px;" onclick="excluiCampoEvento({$id_evento_form})" >Excluir</button></span>
        {/if}
        
        {if $type == 'radio'}
                {foreach $params p}
                    <label class="radio ">
                        <input type='radio' name='{$nome}' value="{$p}" >{$p}</option>
                    </label>
                {/foreach}
                <span class="help-inline"><button type="button" class="btn  btn-danger" style="" onclick="excluiCampoEvento({$id_evento_form})" >Excluir</button></span>
        {/if}
        
        {if $type == 'checkbox'}
                {foreach $params p}
                <label class="checkbox">
                    <input type='checkbox' name='{$nome}[]' value="{$p}" >{$p}</option>
                </label>
                {/foreach}
                <span class="help-inline"><button type="button" class="btn  btn-danger" style="" onclick="excluiCampoEvento({$id_evento_form})" >Excluir</button></span>
        {/if}
        
        
        
        </div>
    </div>