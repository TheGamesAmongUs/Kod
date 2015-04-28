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
<div class="login-panel">


<div align="center">

<?php

if($_SESSION['logged']) echo 'Już jestes zalogowany!';
else{
echo '
Masz już konto? Zaloguj się.</br>
<hr id="hrf2">
<form  action="zaloguj.php"  method="POST">
<input type="text" placeholder="Wpisz swój login lub adres email..." name="login" class="logbar_d" ></input></br>
<input type="password" placeholder="Wpisz swoje hasło..." name="haslo" class="logbar_d"></input></br>
<div class="remember">
<input type="checkbox" name="remember" value="true">Zapamiętaj hasło</input>
</div>
<div class="remind">
<a href="#">Reset hasła</a>
</div>
<div align="center">
<input type="submit" value="Wyślij" name="ok" class="btnlog"></input>
</form>
</div>';

}
?>



</div>

</div>

<?php

$nick = $_POST['login'];
$haslo = $_POST['haslo'];
$mail = $_POST['mail']; 
$plec = $_POST['sex'];
$name = $_POST['name'];
$lname = $_POST['lname'];
$uro = $_POST['bday'];
$sent =$_POST['send'];


if ($sent == 1){

baza();


    $nick = trim($_POST['login']);
    $pass = trim($_POST['pass']);
    $mail = trim($_POST['mail']);
    $name = trim($_POST['name']);
    $lname = trim($_POST['lname']);



  // filtrujemy dane
          $nick = strip_tags( mysql_real_escape_string( HTMLSpecialChars($nick)));
          $haslo = strip_tags( mysql_real_escape_string( HTMLSpecialChars($haslo)));
	  $mail = strip_tags( mysql_real_escape_string( HTMLSpecialChars($mail)));
	  $name = strip_tags( mysql_real_escape_string( HTMLSpecialChars($name)));
	  $lname = strip_tags( mysql_real_escape_string( HTMLSpecialChars($lname)));



$result = mysql_query("SELECT * FROM GRACZ WHERE LOGIN='$nick'") ;
 
        // jeśli już istnieje
        if(mysql_num_rows($result)!=0) echo 'Już istnieje konto z takim loginem!';
        // jeśli nie...
        else
        {


$haslo = md5($haslo);

     
    // dodajemy rekord do bazy 
    $ins = @mysql_query("INSERT INTO GRACZ SET LOGIN='$nick', HASLO='$haslo' , EMAIL='$mail', PLEC='$sex', IMIE='$name', NAZWISKO='$lname', DATA_UR='$uro'"); 
     
    if($ins) echo "Rekord został dodany poprawnie"; 
    else echo "Błąd nie udało się dodać nowego rekordu"; 
     
    mysql_close($connection);
}

}


?>

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
