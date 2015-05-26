<?php
// rozpoczęcie buforowania (jest to potrzebne by nie mieć błędów typu headers already sent)
ob_start();

// start sesji
session_start();

require('config.php');
$_SESSION['PREV'] = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
?>
