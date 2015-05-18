<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');




?>

<script src="jquery-2.0.2.js"></script>
<script src="jquery.stellar.min.js"></script>
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
<topper  data-stellar-ratio="2">
<div id="contact" align="center">

<h3 >Masz pytania? Chcesz zgłosić propozycje lub uwagi dotyczące serwisu?</h3><H4>Napisz do nas!</h4>

<?php


 if(isset($_POST['contact_s']))
     {
//pobranie danych z formularza i odpowiednie zabezpieczenie ich przed SQL injections

	$name = trim($_POST['name_c']);
	$mail = trim($_POST['mail_c']);
	$cont = trim($_POST['contarea']);

	$cont = strip_tags( mysql_real_escape_string( HTMLSpecialChars($cont)));
	$mail = strip_tags( mysql_real_escape_string( HTMLSpecialChars($mail)));
	$name = strip_tags( mysql_real_escape_string( HTMLSpecialChars($name)));


if(empty($name) or empty($mail)){
echo '<h2><b>Wypełnij obowiązkowe pola</b></h2>';
} else {

if(empty($cont)){
echo "<h2><b>Nie można wysłać pustej wiadomości</b></h2>";
		}else 
	echo '<h2><b>Wiadomość zosała wysłana</b></h2>';

}



}

?>

<form action="contact.php" method="POST">

<input type="text" class="contbar" name="name_c" placeholder="Imię i nazwisko..."></textarea><input type="label" readonly class="reqbar" value="Pole wyamagane"></input><br>
<input type="text" class="contbar" name="mail_c" placeholder="Twój adres email..."></textarea><input type="label" readonly class="reqbar" value="Pole wyamagane"></input><br>
<textarea class="contarea" name="contarea" placeholder="Treść twojej wiadomości..."></textarea><br>
<input type="submit" name="contact_s" value="Wyślij!" class="btn"></input>
</form>

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
<script>
	$('#main').stellar();
</script>


</html>
