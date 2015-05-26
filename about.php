<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');




?>
</head>
<body>

<div id="site">
<?php
require('site/bhead.php');
if($_REQUEST['id']==null){
if($_SESSION['logged']){
$user_id = $_SESSION['ID_GRACZ'];
			}
} else {
$user_id = $_REQUEST['id'];
}

baza();
?>

<header name="top">
<?php require('site/head_top.php'); ?>


</header>
<searchpan>
<?php
require('site/search.php');
?>
</searchpan>
<main>
<topper>
<div id="about">
<h3>The Games Among Us - zespół studencki założony na potrzeby "projektu zespołowego".</h3><h4>Kontakt: thegamesamongus@gmail.com</h4>
<table align="center" >
<?php


//Wczytanie odpowiednich awatarów w zależności od nr id członka zespołu

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 84";
list($avek1)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 45";
list($avek2)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 82";
list($avek3)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 86";
list($avek4)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 0";
list($avek5)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = 0";
list($avek6)=mysql_fetch_array (mysql_query($zapytanie));

//Wyświetlenie awatarów

//wyświetlenie danych członków zespołu
echo '<tr>
<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek1.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek2.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek3.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

</tr>

<tr>
<td width="200px" align="center"><b>Kevin Ćwiek</b><br>Pomysłodawca proektu i kierownik zespołu</td>

<td width="200px" align="center"><b>Maciej Wroński</b><br>Główny programista</td>

<td width="200px" align="center"><b>Mateusz Misiak</b><br>Główny grafik</td>

</tr>

<tr>
<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek4.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek5.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

<td width="200px" align="center"><div style="background-image: url(img/avatar/'.$avek6.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div></td>

</tr>
<tr>
<td width="200px" align="center"><b>Sylwia Leik</b><br>Programista pomocniczy</td>

<td width="200px" align="center"><b>Ewa Dondera</b><br>Programista, tester</td>

<td width="200px" align="center"><b>Arkadiusz Mazurek</b><br>Programista tester</td>

</tr>';
?>
</table>


</div>




</topper>

<?php //require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
