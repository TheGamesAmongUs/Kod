
sas
<?php
// rozpoczęcie buforowania (jest to potrzebne by nie mieć błędów typu headers already sent)
ob_start();
// start sesji
session_start();

// nagłówek
echo '<h2>Wylogowywanie</h2>';

// jeśli user jest zalogowany
if($_SESSION['logged'])
{

     // to go wylogowujemy i usuwamy jego dane z sesji
     $_SESSION['logged'] = false;
     $_SESSION['ID_GRACZ'] = '';
                $_SESSION['LOGIN'] = '';
		$_SESSION['AVATAR'] =  '';
                $_SESSION['ADMIN'] =  '';
		$_SESSION['MOD'] = '';
		$_SESSION['IMIE'] = '';
		$_SESSION['NAZWISKO'] = '';
		$_SESSION['REG_DATE'] = '';


     echo 'Zostałes poprawnie wylogowany! <a href="index.php">wróć</a>';



     }
      
     // jeśli nie jest zalogowany
      else
     {



          
     }

header('Location: '.$_SERVER['HTTP_REFERER']);

//echo 'http://thegamesamongus.000a.biz'.$_SERVER['HTTP_REFERER'];

 // koniec buforowania
ob_end_flush();
?>
