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
baza();
$prev_site = $_SERVER['HTTP_REFERER'];

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
<div>

<div align="center" id="addg">
<?php
if($_SESSION['MOD']==1 or $_SESSION['ADMIN']==1){
echo'jesteś adminem';
} else {
if($_SESSION['logged']) {

echo 'Po dodaniu przez Ciebie gra zostanie poddana moderacji i po zaakceptowaniu przez moderatorów umieszczona w bazie gier';
}
}


if($_SESSION['logged']) {
//formularz dodawania gry widoczny tylko dla zalogowanego użytkownika

echo '
<form  action="addg.php"  method="POST" id="dodaj" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> </br>
Dodaj okładke gry: <input name="plik" type="file" /> </br>
<input type="text" placeholder="Tytuł gry..." name="add_tyt" class="add" id="add_tyt" ></input><br>
<input type="text" placeholder="Podaj rok wydania gry..." name="add_rok" class="add" id="add_tyt" ></input><br><br>
<textarea name="add_cont" form="dodaj" id="add_cont" placeholder="Opisz dodawaną grę..."></textarea><br>
<input type="hidden" name="id_autora" value="'.$_SESSION['ID_GRACZ'].'"></input>
<input type="hidden" name="mod" value="'.$_SESSION['MOD'].'"></input>

<div id="addbtn" align="right">
<input type="submit" value="Wyślij" name="ok" class="btnlog"></input>
</form>';} else {
echo 'zaloguj się, aby móc dodawać gry';
}
?>
</div>

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
