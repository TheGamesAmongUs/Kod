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
<l2head>Nie masz konta? Zarejestruj się.</br>

<hr id="hrf2h">
</l2head>

<form action="register.php" method="POST" onsubmit=" return Sprawdz();">
<input type="text" placeholder="Twój adres email..." name="mail" class="logbar_d" ><req>*</req></input></br>

<input type="text" placeholder="Wpisz swój nick..." name="login" class="logbar_k" ><req>*</req></input></br>
<input type="password" placeholder="Wpisz swoje hasło..." name="haslo" class="logbar_k" ><req>*</req></input>

<hr id="hrreg">
<div class="register">
<input type="text" placeholder="Nazwisko..." name="lname" class="logbar_d" ></input></br>

<input type="text" placeholder="Imię..." name="name" class="logbar_d" ></input></br>
Wybierz płeć
<input type="radio" name="sex" value="0">kobieta</input>

<input type="radio" name="sex" value="1">mężczyzna</input></br></br>
Data urodzenia 
  <input type="date" name="bday" max="2000-01-02""><br>

<hr id="hrreg">

<input type="checkbox" name="rules" value="1">Zapoznałem się i akceptuję regulamin <req>*</req></input>

<div align="center">
<input type="submit" value="Wyślij" class="btnlog"></input>

<input type=hidden value="1" name="send">
</div>

</form>';
}
?>

</div>

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
