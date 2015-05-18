<?php
require('config.php');
baza();

//pobraniee danych z formularza z pliku add_game i zabezpieczenie ich przed sql injection


$tytul = $_POST['add_tyt'];
$tresc = $_POST['add_cont'];
$rok = $_POST['add_rok'];
$id_autora = $_POST['id_autora'];
$mod = $_POST['mod'];

    $tytul = trim($tytul);
    $tresc = trim($tresc);
    $rok = trim($rok);

   $tytul = strip_tags( mysql_real_escape_string( HTMLSpecialChars($tytul)));
   $tresc = strip_tags( mysql_real_escape_string( HTMLSpecialChars($tresc)));
   $rok = strip_tags( mysql_real_escape_string( HTMLSpecialChars($rok)));




//wpisanie tytulu i roku do tabeli GRY

	$ins = @mysql_query("INSERT INTO GRY SET NAZWA_GRY='$tytul', ROK_GRY='$rok'"); 
	
		if($ins) {
			echo "Rekord został dodany poprawnie ";
			 }
    else echo "Błąd nie udało się dodać nowego rekordu"; 

$idgry=mysql_insert_id();

if($ins){

//następnie poprzednio dodane rekordy są powiązane z aktualnie dodawanymi danymi dotyczącymi artykułu

$result = mysql_query("SELECT * FROM ARTYKULY WHERE TYTUL_ART='$tytul'") ;
 
        // jeśli już istnieje
        if(mysql_num_rows($result)!=0) echo 'Już istnieje konto z takim loginem!';
else
        {


    	$ins = @mysql_query("INSERT INTO ARTYKULY SET TYTUL_ART='$tytul', TRESC_ART='$tresc' , RODZAJ='1', AUTOR_ART_ID='$id_autora', ACCEPT=0, ID_GRY='$idgry'"); 
    	
$idid=mysql_insert_id();

if($mod==1)
{

$zapytanie = "UPDATE ARTYKULY SET ACCEPT=1 WHERE ID_ARTYKUL='$idid'"; // info awatarze zapis w bazie
$idzapytania = mysql_query($zapytanie);  	
}


// początek uploadu Okładki gry

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


$p_nazwa_zm = "cov_$idid.".$p_ext;




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
    echo "Plik: <strong>$p_nazwa</strong> o rozmiarze 
    <strong>$plik_rozmiar bajtów</strong> został przesłany na serwer!";


$fn =$folder.''.$p_nazwa_zm;

require('miniaturka.php');
$m_mode=1;

miniaturka($fn, 1);

$zapytanie = "UPDATE ARTYKULY SET COVER='$p_nazwa_zm' WHERE ID_ARTYKUL='$idid'"; // info awatarze zapis w bazie


} 


// koniec uploadu

$idzapytania = mysql_query($zapytanie);
}
}




     
//header('Location: '.$_SERVER['HTTP_REFERER']);
header('Location: /gamelist.php');
    mysql_close($connection);
}

?>
