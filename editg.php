<?php
require('config.php');
baza();


$tytul = $_POST['add_tyt'];
$tresc = $_POST['add_cont'];
$id_autora = $_POST['id_autora'];
$article_id = $_POST['article_id'];
$game_id = $_POST['game_id'];
$rok = $_POST['add_rok'];

    $tytul = trim($tytul);
    $tresc = trim($tresc);
    $rok = trim($rok);


   $tytul = strip_tags( mysql_real_escape_string( HTMLSpecialChars($tytul)));
   $tresc = strip_tags( mysql_real_escape_string( HTMLSpecialChars($tresc)));
   $rok = strip_tags( mysql_real_escape_string( HTMLSpecialChars($rok)));




            $result = mysql_query("SELECT * FROM ARTYKULY WHERE ID_ARTYKUL='$article_id'");
           
             // jeśli nie istnieje
            if(mysql_num_rows($result)==0) echo 'Podany id artykułu jest nieprawidłowy';
         
             // jeśli tak...
            else
            {

$zapytanie = "UPDATE ARTYKULY SET TYTUL_ART='$tytul', TRESC_ART='$tresc' WHERE ID_ARTYKUL='$article_id'"; 

mysql_query($zapytanie);


$zapytanie = "UPDATE GRY SET NAZWA_GRY='$tytul', ROk_GRY='$rok' WHERE ID_GRY='$game_id'"; 

mysql_query($zapytanie);


//echo 'Twoje konto od teraz jest aktywne, możesz się zalogować';
		


// początek uploadu
if($_FILES['plik']['error']  == 0 ){

$p_tmp = $_FILES['plik']['tmp_name']; 
$p_nazwa = $_FILES['plik']['name']; 
$p_rozmiar = $_FILES['plik']['size'];

$poj_MB=round(($p_rozmiar/1048576),2).'MB';
$max_size=round(($_POST['max_file_size']/1048576),3)."MB";

$p_ext= array_pop(explode(".", $p_nazwa));



$folder="img/article/"; 

$plik = $p_tmp;
$finfo = new finfo(FILEINFO_MIME);
$type = $finfo->file($plik, FILEINFO_MIME_TYPE);

$p_type= array_shift(explode("/", $type));  // Typ pliku, np. dla obrazka image


$p_nazwa_zm = "cov_$article_id.".$p_ext;


$fn =$folder.''.$p_nazwa_zm;

unlink($folder.$p_nazwa_zm);

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
     move_uploaded_file($p_tmp, "$folder$p_nazwa_zm"); 
    echo "Plik: <strong>$p_nazwa</strong> o rozmiarze 
    <strong>$plik_rozmiar bajtów</strong> został przesłany na serwer!";




require('miniaturka.php');
$m_mode=1;

miniaturka($fn, 1);

$zapytanie = "UPDATE ARTYKULY SET COVER='$p_nazwa_zm' WHERE ID_ARTYKUL='$article_id'"; // info awatarze zapis w bazie


$idzapytania = mysql_query($zapytanie);





} 
}

// koniec uploadu




}

//header('Location: '.$_SERVER['HTTP_REFERER']);
header('Location: /gamelist.php');

    mysql_close($connection);


?>
