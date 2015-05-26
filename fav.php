<?php
require('config.php');
baza();
session_start();
$article_id = $_REQUEST['id'];
$user_id = $_SESSION['ID_GRACZ'];

echo $user_id;

if($_SESSION['logged']) {


$zapytanie = "Select ID_GRY FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($game_id)=mysql_fetch_array (mysql_query($zapytanie));






$result = mysql_query("SELECT * FROM ULUBIONE WHERE ID_GRY='$game_id'AND ID_GRACZ='$user_id'") ;
 


        // jeśli już istnieje
        if(mysql_num_rows($result)!=0) {
echo '<h2>Już istnieje konto z takim loginem!</h2>';
$ins = @mysql_query("DELETE FROM ULUBIONE WHERE ID_GRY='$game_id'AND ID_GRACZ='$user_id'"); 
header('Location: '.$_SERVER['HTTP_REFERER']);
}
        // jeśli nie...
        else
        {   
echo 'Gra została dodana do ulubionych';

$ins = @mysql_query("INSERT INTO ULUBIONE SET ID_GRY='$game_id', ID_GRACZ='$user_id' "); 
header('Location: '.$_SERVER['HTTP_REFERER']);
	}


			}else {
header('Location: '.$_SERVER['HTTP_REFERER']);
}



?>
