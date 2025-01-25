<?php
ini_set(option: 'display_errors', value: 1);
error_reporting(error_level: E_ALL);
?>

<?php
require_once("dbutils.php");

$miCon = conectarDB();

var_export(value: $miCon);

$saPolvorones = realizarQuery($miCon, "SELECT * FROM POLVORONES",argumentos: null,isFetch: true);

var_export($saPolvorones)

?>