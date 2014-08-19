<?php
/* template head */
/* end template head */ ob_start(); /* template body */ ?><table>
    <tr>
        <td>
            Usuario    
        </td>
        <td>
            senha
        </td>
    </tr>
    <tr>
        <td><input type='text' value='<?php echo $this->scope["usuario"];?>' name="usuario"></td>
        <td><input type='text' value='<?php echo $this->scope["senha"];?>' name="senha"></td>
    </tr>
    
    <tr>
    
        
    </tr>
</table>
<?php echo $this->scope["link"];
 /* end template body */
return $this->buffer . ob_get_clean();
?>