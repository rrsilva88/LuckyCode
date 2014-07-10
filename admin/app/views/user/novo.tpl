
<div class='forms'>
    <h1>Criar Usuário</h1>
    <form id='cadUser'>
        <input type='hidden' name='return' value='json'>
        <table>
            <tr>
                <td>
                    <input type="text" name='nome' placeholder='Nome'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name='email' placeholder='Email'>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name='senha' placeholder='Senha'>
                </td>
            </tr>
        </table>
    </form>
    <button onclick='NovoUsuario()'>Cadastrar</button>
</div>