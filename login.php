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
require('site/bheadl.php');
?>

<header name="top">
<?php require('site/head_top.php'); 

baza();?>


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


$prev =  $_SESSION['PREV'];	

 if(isset($_POST['ok']))
     {


        $nick = trim($_POST['login']);
        $haslo = trim($_POST['haslo']);
      
        // sprawdzamy czy wszystkie dane zostały podane
        if(empty($nick) || empty($haslo)) {
echo 'Wpisz wszystkie pola!<br>';

}else{
         // jeśli tak...
  // filtrujemy dane
           $nick = strip_tags( mysql_real_escape_string( HTMLSpecialChars($nick)));
           $haslo = strip_tags( mysql_real_escape_string( HTMLSpecialChars($haslo)));
           
             // kodujemy hasło
            $haslo = md5($haslo);
            
            // sprawdzamy czy istnieje użytkownik z takim loginem i hasłem
            $result = mysql_query("SELECT * FROM GRACZ WHERE LOGIN='$nick' AND HASLO='$haslo' AND ACTIVE='1'");
           
             // jeśli nie istnieje
            if(mysql_num_rows($result)==0) echo 'Niestety podałes niepoprawne dane!<br>';
         
             // jeśli tak...
            else
            {
                // dodajemy wynik zapytania do tablicy
                $row = mysql_fetch_array($result);
           
                 // ustawianie sesji że użytkownik jest zalogowany
                $_SESSION['logged'] = true;

                // dodawanie do sesji id użytkownika, login
                $_SESSION['ID_GRACZ'] = $row['ID_GRACZ'];
                $_SESSION['LOGIN'] = $row['LOGIN'];
		$_SESSION['AVATAR'] = $row['AVATAR'];
                $_SESSION['ADMIN'] = $row['ADMIN'];
		$_SESSION['MOD'] = $row['MOD'];
		$_SESSION['IMIE'] = $row['NAZWISKO'];
		$_SESSION['NAZWISKO'] = $row['IMIE'];
		$_SESSION['REG_DATE'] = $row['REG_DATE'];






/*
                 // wyświetlenie komunikatu oznaczającego poprawne logowanie
                echo 'Zostałes poprawnie zalogowany! Możesz teraz przejsć na <a href="index.php">stronę główna</a>';

*/
           header('Location: /login.php');

   }


}
            }



if($_SESSION['logged']){ echo 'Już jestes zalogowany!';

echo '<br><a href="'.$prev.'">Wróć</a>';
}
else{
echo '
Nie masz konta?<a href="register.php"> Zarejestruj się.</a></br>
<form  action="login.php"  method="POST">
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


</topper>

<?php //require('site/gamelist.php'); ?>
<?php //require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
