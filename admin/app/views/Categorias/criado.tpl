<h1>Motoboy Cadastrado</h1>
<table class='motoboy-cadastrado'>
    <tr>
        <td>
        {if $foto}
            <img src='fotos/motoboy/{$foto}'>
        {else}
            <img src='fotos/motoboy/default.jpg'>
        {/if}
        </td>
        <td>
            <table>
                <tr>
                    <td>Código:</td>
                    <td>{$codigo}</td>
                </tr>
                <tr>
                    <td>Nome:</td>
                    <td>{$nome}</td>
                </tr>
                <tr>
                    <td>RG:</td>
                    <td>{$rg}</td>
                </tr>
                <tr>
                    <td>CPF:</td>
                    <td>{$cpf}</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<a href='Motoboy/'>Voltar para o cadastro</a>