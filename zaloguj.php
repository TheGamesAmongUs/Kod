<?php
// rozpoczęcie buforowania (jest to potrzebne by nie mieć błędów typu headers already sent)
ob_start();

// start sesji
session_start();
require('config.php');
baza();

if($_SESSION['logged']) echo 'Już jestes zalogowany!';

 if(isset($_POST['ok']))
     {
        $nick = trim($_POST['login']);
        $haslo = trim($_POST['haslo']);
      
        // sprawdzamy czy wszystkie dane zostały podane
        if(empty($nick) || empty($haslo)) echo 'Wpisz wszystkie pola!';
       
         // jeśli tak...
  // filtrujemy dane
           $nick = strip_tags( mysql_real_escape_string( HTMLSpecialChars($nick)));
           $haslo = strip_tags( mysql_real_escape_string( HTMLSpecialChars($haslo)));
           
             // kodujemy hasło
            $haslo = md5($haslo);
            
            // sprawdzamy czy istnieje użytkownik z takim loginem i hasłem
            $result = mysql_query("SELECT * FROM GRACZ WHERE LOGIN='$nick' AND HASLO='$haslo'");
           
             // jeśli nie istnieje
            if(mysql_num_rows($result)==0) echo 'Niestety podałes niepoprawne dane!';
         
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
               
                 // wyświetlenie komunikatu oznaczającego poprawne logowanie
                echo 'Zostałes poprawnie zalogowany! Możesz teraz przejsć na <a href="index.php">stronę główna</a>';
                }
            }

// rozłączenie z bazą danych
mysql_close();
header('Location: '.$_SERVER['HTTP_REFERER']);
// koniec buforowania
ob_end_flush();

?>
