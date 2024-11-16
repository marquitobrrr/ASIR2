<?php

    var_export(value: $_POST);

    $valor_oculto = "trece";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>JOLA</h1>
    <form action="iaw08.php" method="post">
        <input type="hidden" name="input_oculto" value="<?php echo $valor_oculto?>"/>     
        <input type="test" name="input1" value="sos"/>     
        <input type="submit" value="go!"/>     
    </form>
</body>
</html>