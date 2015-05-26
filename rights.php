<?php
require('config.php');
baza();




$id =  $_REQUEST['id'];

$zapytanie = "Select ADMIN FROM GRACZ WHERE ID_GRACZ = '$id'


$wynik = mysql_query("SELECT MOD FROM GRACZ WHERE ID_GRACZ='$id'");

$i=0;
while($wiersz = mysql_fetch_array($wynik))
  {
	
echo $wiersz['MOD'];

$i++;

  }


echo $id;
echo $avek1;




?>
