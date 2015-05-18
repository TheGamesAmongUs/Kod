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
<div class="login-panel" data-stellar-ratio="2">

<div id="regscr">
<?php

$nick = $_POST['login'];
$haslo = $_POST['haslo'];
$mail = $_POST['mail']; 
$sex = $_POST['sex'];
$name = $_POST['name'];
$lname = $_POST['lname'];
$uro = $_POST['bday'];
$sent =$_POST['send'];
$rules = $_POST['rules'];




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


function  checkEmail($mail) {
 if (!preg_match("/^( [a-zA-Z0-9] )+( [a-zA-Z0-9\._-] )*@( [a-zA-Z0-9_-] )+( [a-zA-Z0-9\._-] +)+$/" , $mail)) {
  return false;
 }
 return true;
}


//if(checkEmail($mail)==true){
// miejsce na ifa sprawdzającego dwa mejle

	  if(!empty($nick) and !empty($haslo) and !empty($rules) and !empty($mail)){



$result = mysql_query("SELECT * FROM GRACZ WHERE LOGIN='$nick'") ;
 


        // jeśli już istnieje
        if(mysql_num_rows($result)!=0) {echo '<h2>Już istnieje konto z takim loginem!</h2>';}
        // jeśli nie...
        else
        {


$haslo = md5($haslo);

$act_code = md5(rand(1,100));

$reg_date = date("Y-m-d");

     
    // dodajemy rekord do bazy 
    $ins = @mysql_query("INSERT INTO GRACZ SET LOGIN='$nick', HASLO='$haslo' , EMAIL='$mail', PLEC='$sex', IMIE='$name', NAZWISKO='$lname', DATA_UR='$uro', AVATAR='av.jpg', ACTIVE='1', REG_DATE='$reg_date', ACT_CODE='$act_code'"); 
     
    if($ins) {echo '<h2>Konto zostało utworzone poprawnie, możesz się <a href="login.php">zalogować</a></h2>';} 
    else {echo "<h2>Nie udało się utworzyć konta, spróbuj ponownie.</h2>";} 
     




$idid=mysql_insert_id();


// początek uploadu avatara

if($_FILES['plik']['error']  == 0 ){

$p_tmp = $_FILES['plik']['tmp_name']; 
$p_nazwa = $_FILES['plik']['name']; 
$p_rozmiar = $_FILES['plik']['size'];

$poj_MB=round(($p_rozmiar/1048576),2).'MB';
$max_size=round(($_POST['max_file_size']/1048576),3)."MB";

$p_ext= array_pop(explode(".", $p_nazwa));



$folder="img/avatar/"; 

$plik = $p_tmp;
$finfo = new finfo(FILEINFO_MIME);
$type = $finfo->file($plik, FILEINFO_MIME_TYPE);

$p_type= array_shift(explode("/", $type));  // Typ pliku, np. dla obrazka image


$p_nazwa_zm = "avatar$idid.".$p_ext;




if ($p_rozmiar <= 0)
  {
echo 'Plik pusty, albo o 0 rozmiarze';


    exit;
  }
if ($poj_MB > $max_size)
  {
echo  'Obrazek posiada rozmiar '.$poj_MB.' MB, maxymalny dostępny wynosi '.$max_size.' MB';

       exit;
  }

if (file_exists($folder.$p_nazwa_zm))
  {
echo 'obrazek o tej nazwie już jest.';

    exit;
  }

if($p_type!='image')
{
echo 'Przesłany plik nie jest obrazkiem';
exit;
}


if(is_uploaded_file($p_tmp)) { 
     move_uploaded_file($p_tmp, "$folder$p_nazwa_zm"); 



$fn =$folder.''.$p_nazwa_zm;

require('miniaturka.php');
$m_mode=1;

miniaturka($fn, 1);

$zapytanie = "UPDATE GRACZ SET AVATAR='$p_nazwa_zm' WHERE ID_GRACZ='$idid'"; // info awatarze zapis w bazie


} 


// koniec uploadu

$idzapytania = mysql_query($zapytanie);
}










    mysql_close($connection);
	}

}else{echo '<h2>Uzupełnij obowiązkowe pola!</h2>';}
//miejsce na } else {echo 'info na temat mejla i potwierdzenia mejla';}
//}else{echo 'Błędny adres email';}
									
} 




?>


</div>




<?php
   

if($_SESSION['logged']) echo '<div>Już jestes zalogowany!</div>';
else{
echo '
<div id="register">
<l2head>Masz już konto? <a href="login.php">Zaloguj się.</a></br>

</l2head>

<form action="register.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> </br>
Dodaj avatar: <input name="plik" type="file" /> </br>
<input type="text" placeholder="Twój adres email..." name="mail" class="logbar_d" ><req>*</req></input></br>

<input type="text" placeholder="Wpisz swój nick..." name="login" class="logbar_k" ><req>*</req></input></br>
<input type="password" placeholder="Wpisz swoje hasło..." name="haslo" class="logbar_k" ><req>*</req></input>
</br>
<hr id="hrreg">
<div class="register">
<input type="text" placeholder="Nazwisko..." name="lname" class="logbar_d" ></input><div id="demo"></div></br>

<input type="text" placeholder="Imię..." name="name" class="logbar_d" ></input></br></br></br>
Wybierz płeć
<input type="radio" name="sex" value="0">kobieta</input>

<input type="radio" name="sex" value="1">mężczyzna</input></br></br>
Data urodzenia 
  <input type="date" name="bday" max="2000-01-02" placeholder="DD-MM-RRRR" "><br>

<hr id="hrreg">
</br>
<input type="checkbox" name="rules" value="1">Zapoznałem się i akceptuję regulamin <req>*</req></input></br></br>
<req>*</req>Pola wymagane

<div >
<input type="submit" value="Wyślij" class="btnlog"></input>

<input type=hidden value="1" name="send">
</div>

</form>';
}
?>

</div>

</div>

</div>



<?//php require('site/gamelist.php'); ?>
<?//php require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
<script>
	$('#main').stellar();
</script>
</body>


</html>
