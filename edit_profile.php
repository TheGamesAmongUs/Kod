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
<topper>
<div class="login-panel" data-stellar-ratio="2">

<div id="regscr">
<?php

$nick = $_POST['login'];

 if(isset($_POST['haslo']))
{
$haslo = $_POST['haslo'];
}
$mail = $_POST['mail']; 
$sex = $_POST['sex'];
$name = $_POST['name'];
$lname = $_POST['lname'];
$uro = $_POST['bday'];
$sent =$_POST['send'];
$rules = $_POST['rules'];

$user_id =  $_SESSION['ID_GRACZ'];


if ($sent == 1){






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





$haslo = md5($haslo);


     
    // dodajemy rekord do bazy 


/*
 if(isset($_POST['plik']))
{

echo "miesjce na obrazek wypełnione";

} else {
echo "miesjce na obrazzek puste";
}

*/







    $ins = @mysql_query("UPDATE GRACZ SET LOGIN='$nick' , EMAIL='$mail', PLEC='$sex', IMIE='$name', NAZWISKO='$lname' WHERE ID_GRACZ='$user_id' "); 
     

 if($_POST['haslo']!=null)
{
   $ins = @mysql_query("UPDATE GRACZ SET LOGIN='$nick' , EMAIL='$mail', PLEC='$sex', IMIE='$name', NAZWISKO='$lname', HASLO='$haslo'  WHERE ID_GRACZ='$user_id' "); 
   
  }

if($_POST['bday']!=null){
$ins = @mysql_query("UPDATE GRACZ SET DATA_UR='$uro' WHERE ID_GRACZ='$user_id' "); 
 
}



    if($ins) {echo "Rekord został dodany poprawnie";} 
    else {echo "Błąd nie udało się dodać nowego rekordu";} 
     




$idid = $_SESSION['ID_GRACZ'];


// początek uploadu

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


$fn =$folder.''.$p_nazwa_zm;

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



if($p_type!='image')
{
echo 'Przesłany plik nie jest obrazkiem';
exit;
}


if(is_uploaded_file($p_tmp)) { 
	unlink($fn);
     move_uploaded_file($p_tmp, "$folder$p_nazwa_zm"); 





require('miniaturka.php');
$m_mode=1;

miniaturka($fn, 1);

$zapytanie = "UPDATE GRACZ SET AVATAR='$p_nazwa_zm' WHERE ID_GRACZ='$idid'"; // info awatarze zapis w bazie


} 


// koniec uploadu

$idzapytania = mysql_query($zapytanie);
}










    mysql_close($connection);
	

//miejsce na } else {echo 'info na temat mejla i potwierdzenia mejla';}
//}else{echo 'Błędny adres email';}
									
} 




?>


</div>




<?php   



$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($uavatar)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select IMIE FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($uimie)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select NAZWISKO FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($unazwisko)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select LOGIN FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($ulogin)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select PLEC FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($usex)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select REG_DATE FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($uregdate)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select EMAIL FROM GRACZ WHERE ID_GRACZ = '$user_id'";
list($umail)=mysql_fetch_array (mysql_query($zapytanie));



if($_SESSION['logged']){ 
echo '
<div id="register">
<l2head>

</l2head>

<form action="edit_profile.php" method="POST" enctype="multipart/form-data">

<input type="hidden" name="MAX_FILE_SIZE" value="500000" /> </br>
Avatar: <div id="avatar" style="background-image: url(img/avatar/'.$uavatar.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div>

<input name="plik" type="file" /> </br>
<input type="text" placeholder="Twój adres email..." name="mail" class="logbar_d" value="'.$umail.'" ></input></br>

<input type="text" placeholder="Wpisz swój nick..." name="login" class="logbar_k" value="'.$ulogin.'" ></input></br>
<input type="password" placeholder="Wpisz swoje hasło..." name="haslo" class="logbar_k" ></input>
</br>
<hr id="hrreg">
<div class="register">
<input type="text" placeholder="Nazwisko..." name="lname" class="logbar_d" value="'.$unazwisko.'" ></input><div id="demo"></div></br>

<input type="text" placeholder="Imię..." name="name" class="logbar_d" value="'.$uimie.'" ></input></br></br></br>
Wybierz płeć';

if($usex==1){
echo '<input type="radio" name="sex" value="0">kobieta</input>

<input type="radio" name="sex" value="1" checked>mężczyzna</input></br></br>';
} else if($usex==0){
echo '<input type="radio" name="sex" value="0" checked>kobieta</input>

<input type="radio" name="sex" value="1">mężczyzna</input></br></br>';
}

echo 'Data urodzenia 
  <input type="date" name="bday" max="2000-01-02" placeholder="MM-DD-RRRR" value="09-05-1991"><br>



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



</topper>
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
