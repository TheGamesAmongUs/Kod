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
$prev_site = $_SERVER['HTTP_REFERER'];
$article_id = $_REQUEST['id'];
$site_adr=$_SERVER['SCRIPT_NAME']."?id=".$article_id;
?>

<header name="top">
<?php require('site/head_top.php'); 
baza();
?>


</header>
<searchpan>
<?php
require('site/search.php');
?>
</searchpan>
<main>
<topper>
<div>
<h4 align="left">Dodaj Grę<hr id="hrf2" align="left"></h4>
<div align="center" id="edg">
<?php


$zapytanie = "Select AUTOR_ART_ID FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($autor_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select TYTUL_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tytul)=mysql_fetch_array (mysql_query($zapytanie));


$zapytanie = "Select TRESC_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tresc)=mysql_fetch_array (mysql_query($zapytanie));


$zapytanie = "Select ID_GRY FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($game_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select ROK_GRY FROM GRY WHERE ID_GRY = '$game_id'";
list($rok)=mysql_fetch_array (mysql_query($zapytanie));


if($_SESSION['logged']) {

if($_SESSION['ID_GRACZ']==$autor_id or $_SESSION['MOD']==1 or $_SESSION['ADMIN']==1)
{
echo '
<table><td align="center" valign="top">Okładka<br><img width="150px" height="211" src="img/article/cov_'.$article_id.'.jpg"></img></td>
<td><form  action="editg.php"  method="POST" id="dodaj" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> </br>
<input name="plik" type="file" /> </br>
<input type="text" placeholder="Tytuł gry..." name="add_tyt" class="add" value="'.$tytul.'" id="add_tyt" ></input></br>
<input type="text" placeholder="Podaj rok wydania gry..." name="add_rok" class="add" value="'.$rok.'" id="add_tyt" ></input><br><br>
<textarea name="add_cont" form="dodaj" id="add_cont" placeholder="Opisz dodawaną grę...">'.$tresc.'</textarea></br>
<input type="hidden" name="id_autora" value="'.$_SESSION['ID_GRACZ'].'"></input>
<input type="hidden" name="article_id" value="'.$article_id.'"></input>
<input type="hidden" name="game_id" value="'.$game_id.'"></input>

<div align="right" id="edbtn">
<input type="submit" value="Wyślij" name="ok" class="btnlog"></input>
</form></td>
</tr>
</table>';
} else {
echo 'Nie masz uprawnień, aby móc dodawać gry';
}


}  else {
echo 'zaloguj się, aby móc edytować gry';
}


?>
</div>

</div>




</topper>

<?php// require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
