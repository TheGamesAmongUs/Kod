<?php
require('config.php');

baza();


$mail_n = $_POST['newslet']; 

    $mail_n = trim($mail_n);

	  $mail_n = strip_tags( mysql_real_escape_string( HTMLSpecialChars($mail_n)));

$result = mysql_query("SELECT * FROM NEWSLETTER WHERE EMAIL='$mail_n'") ;
 
        // jeśli już istnieje
        if(mysql_num_rows($result)!=0) echo 'Mamy już taki email w bazie';
        // jeśli nie...
        else
        { 
    $ins = @mysql_query("INSERT INTO NEWSLETTER SET EMAIL='$mail_n'"); 


    if($ins) {
echo "Rekord został dodany poprawnie"; 

// the message
$msg = "Witaj\nZostałeś zapisany do newslettera w naszym serwisie.\nPozdrawiamy, ekipa TheGamesAmongUs.";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail($mail_n,"TheGamesAmongUs",$msg);


	
}

    else echo "Błąd nie udało się dodać nowego rekordu"; 
     }
// rozłączenie z bazą danych
mysql_close();
header('Location: '.$_SERVER['HTTP_REFERER']);


?>
