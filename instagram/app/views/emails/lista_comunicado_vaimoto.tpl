<h1>Lista Clientes</h1>
<p>Lista de clientes que não receberam respostas dos motoboy's e foram notificados com email!</p>
<table border="0" cellpadding="0" cellspacing="0" width='100%' style="text-align:center;">
<tr style="background-color:#F57B1A;color:#fff;font-size:15px;font-weight:bold;">
    <td>
        NOME
    </td>
    <td>
        EMAIL
    </td>
    <td>
        ID_PEDIDO
    </td>
    <td>
        DATA_REQUISICAO
    </td>
</tr>
{foreach $clientes cliente}
    <tr >
        <td style="border:1px solid #ccc;padding:5px;">
            {$cliente.nome}
        </td>
        <td style="border:1px solid #ccc;padding:5px;">
            {$cliente.email}
        </td>
        <td style="border:1px solid #ccc;padding:5px;">
            {$cliente.id_pedido}
        </td>
        <td style="border:1px solid #ccc;padding:5px;">
            {$cliente.data_requisicao}
        </td>
    </tr>
{/foreach}


</table>