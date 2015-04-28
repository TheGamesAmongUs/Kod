<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');
$article_id = $_REQUEST['id'];
$site_adr=$_SERVER['SCRIPT_NAME']."?id=".$article_id;



?>
</head>
<div id="site">
<body>
<?php
require('site/bhead.php');
baza();
?>
<header name="top">
<?php

require('site/menu.php');


?>
<logpan>
<?php
require('site/logpan.php');
?>
</logpan>
</header>
<searchpan>
<?php
require('site/search.php');
?>
</searchpan>
<main>
<topper>
<artykul>
<gra style="background-image: url(/img/<?php echo 'bg'.$article_id; ?>.jpg);background-repeat: no-repeat;
background-position: center; 
background-color: black;">

<div id="aa">
<div id="a1">
<img width="150px" height="211" src="img/c<?php echo $article_id;?>.jpg"></img>

</div>

<div id="a2">

<?php


$zapytanie = "Select TYTUL_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tytul)=mysql_fetch_array (mysql_query($zapytanie));


//$zapytanie = "select ROK_GRY from GRY where ID_ARTYKUL = '$article_id'( select ROK_GRY from GRY where ID_GRY = '$article_id')";

$zapytanie = "Select ID_GRY FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($game_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select ROK_GRY FROM GRY WHERE ID_GRY = '$game_id'";
list($rok_gry)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select AUTOR_ART_ID FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($autor_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select LOGIN FROM GRACZ WHERE ID_GRACZ = '$autor_id'";
list($autor)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select TRESC_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tresc)=mysql_fetch_array (mysql_query($zapytanie));




//$updt = @mysql_query("UPDATE OCENA_ART SET OCENA_ART= '$wo' WHERE ID_GRACZ = '$autor_id'");

//mysql_query($query);


echo $tytul." (".$rok_gry.")";
echo "</br></br>";
echo "Autor: ",$autor;
echo "</br></br><hr>";
?>
<table>
<tr><td><?php echo $tresc; ?></td></tr>
</table>


</div>

<div id="a3">

<?php
//$zapytanie = "Select OCENA_GRY FROM GRY WHERE ID_GRY = '$game_id'";


$zapytanie = "Select OCENA_ART FROM OCENA_ART WHERE ID_GRACZ = '$autor_id'";
list($ocena_gracz)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = ("SELECT avg(OCENA_ART) FROM `OCENA_ART` WHERE ID_ART = '$game_id'");
list($ocena)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "SELECT COUNT(*) FROM OCENA_ART WHERE OCENA_ART > 0 and OCENA_ART <= 10 and ID_ART = '$game_id'";
list($ile_ocen)=mysql_fetch_array (mysql_query($zapytanie));

/*
echo '<table><tr><td rowspan="2">';
echo '<ocena>'.$ocena.'</ocena>';
echo '</td>';
echo '<tr><td>'.$ile_ocen.' Głosów</td></tr>';
echo '<tr><td>Ulubionych</td>
</tr></tr>
</table>';
*/
echo'
<table>
  <tr>
    <td rowspan="2" width="50%"><ocena>'.$ocena.'</ocena></td>
    <td width="50%">Głosów: '.$ile_ocen.' </td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
';



echo "</br>";
echo "</br>";
if($_SESSION['logged']) {
echo 'Grałem/grałam, moja ocena to </br>';
echo '<form action="'.$site_adr.'" method="POST">';
for ($i = 1; $i <= (10); $i++){
if($i<=$ocena_gracz){
echo '<input id="s_dot_red" type="submit" name="wystaw_ocene" value="'.$i.'"></input>';
} else {
echo '<input id="s_dot_gray" type="submit" name="wystaw_ocene" value="'.$i.'"></input>';
}
}
}

echo '</form>';




?>
</div>
</div>
</gra>
</artykul>
</topper>

<?php require('site/gamelist.php'); ?>
<?php require('site/trailers.php'); ?>


</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>

</html>
