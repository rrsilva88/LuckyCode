{foreach $motoboys motoboy}
<li id='item-motoboy-{$motoboy.id_motoboy}'>
    <div class='item-motoboy'>
        <div class='foto'>
            {if $motoboy.foto != ''}
                <img src='fotos/motoboy/{$motoboy.foto}' />
            {else}
                <img src='fotos/motoboy/default.jpg' />
            {/if}
        </div>
        <div class='dados'>
            <p>Nome:{$motoboy.nome}</p>
            <p>Celular:{$motoboy.tel_celular}</p>
        </div>
    </div>
</li>
{/foreach}