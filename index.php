<?php
$str = "<?php

echo 'hello!' ;
echo 1 + 1 ;
";
$code = htmlspecialchars($str);
?>
<form method="POST" action="process.php">
    <table>
        <tbody>
        <tr>
            <td>Php Code</td>
        </tr>
        <tr>
            <td>
                <textarea name="code" style="width: 500px; height: 300px;"><?php echo $code;?></textarea> </td>
        </tr>
        </tbody>
    </table>
    <input type="submit">
</form>