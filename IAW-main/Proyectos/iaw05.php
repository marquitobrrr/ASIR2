<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

var_export(value: $_POST);

if (isset($_POST['sumar']))
{
$valore = $_POST['n1'] + $_POST ['n2'];
}
else if (isset($_POST['concatenar']))
{
$valore = $_POST ['n1'] . $_POST['n2'];    
}
?>

        <div>
            <input name="resultado" type="text" value="<?php echo $valore?>"/>
        </div>
</body>
</html>