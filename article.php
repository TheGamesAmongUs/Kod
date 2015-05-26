<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');
$article_id = $_REQUEST['id'];
$accept_code = md5($article_id);
$site_adr=$_SERVER['SCRIPT_NAME']."?id=".$article_id;


$kpp = 5;


?>
</head>
<body>

<div id="site">
<?php






require('site/bhead.php');
$user_id = $_SESSION['ID_GRACZ'];

if($_REQUEST['id']==null){
$article_id = 0;
} else {
$article_id = $_REQUEST['id'];
}

baza();

//Wczytanie z bazy kilku parametrów dotyczących artykułu ilości wyświetleń, czy gra została zaakceptowana

$zapytanie = "Select VIEWED FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($wyswietlen)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select ACCEPT FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($akcept)=mysql_fetch_array (mysql_query($zapytanie));


$zapytanie = "Select VIEWED FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($viewed)=mysql_fetch_array (mysql_query($zapytanie));
$viewed++;
$zapytanie = "UPDATE ARTYKULY SET VIEWED='$viewed' WHERE ID_ARTYKUL = '$article_id'"; 
mysql_query($zapytanie);

//warunek dzięki któremu jeśli wejdzie się w link aktywacyjny gra zostanie zaakceptowana

 if(isset($_REQUEST['accept_code']))
     {
if($_REQUEST['accept_code']==md5($article_id)){

   $ins = @mysql_query("UPDATE ARTYKULY SET ACCEPT=1 WHERE ID_ARTYKUL='$article_id' AND ACCEPT=0 "); 
   
						}

	}

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
<artykul>
<gra style="background-image: url(/img/article/<?php echo 'bg'.$article_id; ?>.jpg);background-repeat: no-repeat;
background-position: center; 
background-color: black;">

<?php
//pobranie id autora artykułu
$zapytanie = "Select AUTOR_ART_ID FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($autor_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select COVER FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($cov)=mysql_fetch_array (mysql_query($zapytanie));


if($akcept==0 and $_SESSION['MOD']!=1)
{
$article_id = 0;
}

echo '<div id="aa">';
echo '<div id="a1">';
if($_SESSION['ID_GRACZ']==$autor_id or $_SESSION['MOD']==1 or $_SESSION['ADMIN']==1){
echo '<h4 align="left"><a href="edit_game.php?id='.$article_id.'">Edytuj grę</a></h4>';
}
echo '<img width="150px" height="211" src="img/article/'.$cov.'"></img>
  
Wyświetleń: '.$wyswietlen.'<br>';

if($akcept==0 and $_SESSION['MOD']==1)
{
echo '<a href="?id='.$article_id.'&accept_code='.md5($article_id).'">Akceptuj</a>';
}

echo '</div>

<div id="a2" align="left">';





















$zapytanie = "Select TYTUL_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tytul)=mysql_fetch_array (mysql_query($zapytanie));



//pobranie kilku kolejnych kilku parametrów dotyczących gry, ID, rok wydania, treść artykułu

//$zapytanie = "select ROK_GRY from GRY where ID_ARTYKUL = '$article_id'( select ROK_GRY from GRY where ID_GRY = '$article_id')";

$zapytanie = "Select ID_GRY FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($game_id)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select ROK_GRY FROM GRY WHERE ID_GRY = '$game_id'";
list($rok_gry)=mysql_fetch_array (mysql_query($zapytanie));



$zapytanie = "Select LOGIN FROM GRACZ WHERE ID_GRACZ = '$autor_id'";
list($autor)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select TRESC_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$article_id'";
list($tresc)=mysql_fetch_array (mysql_query($zapytanie));



//$updt = @mysql_query("UPDATE OCENA_ART SET OCENA_ART= '$wo' WHERE ID_GRACZ = '$autor_id'");

//mysql_query($query);


echo $tytul." (".$rok_gry.")";
echo "</br></br>";
echo "Autor: ",$autor;
echo "</br></br><hr>";
?>
<table>
<tr><td><?php echo $tresc; ?></td></tr>
</table>


</div>

<div id="a3">

<?php
//$zapytanie = "Select OCENA_GRY FROM GRY WHERE ID_GRY = '$game_id'";




$ty = $_SESSION['ID_GRACZ'];
$ocenka = $_POST['ocena'];
$play_val = $_POST['zagraj'];

$comtext = $_POST['comtext'];

 if(isset($_POST['ocena_s']))
     {

            // sprawdzamy czy gra została już oceniona przez gracza
            $result = mysql_query("SELECT * FROM OCENA_ART WHERE ID_GRACZ='$ty' AND ID_ART='$article_id'");
           
             // jeśli nie
            if(mysql_num_rows($result)==0){
    $ins = @mysql_query("INSERT INTO OCENA_ART SET ID_GRACZ='$ty', OCENA_ART='$ocenka', ID_ART='$article_id'"); 
					   } 
//jeśli już oceniono, ocena zostaje zaktyalizowana
else{

$zapytanie = "UPDATE OCENA_ART SET OCENA_ART='$ocenka' WHERE ID_GRACZ='$ty' AND ID_ART='$article_id'"; // info awatarze zapis w bazie

$idzapytania = mysql_query($zapytanie);

}
	}




 if(isset($_POST['play_s']))
     {

            // sprawdzamy czy gra została już oznaczona jako chcę zagrać
            $result = mysql_query("SELECT * FROM PLAY WHERE ID_GRACZ='$ty' AND ID_GRY='$game_id'");
           
             // jeśli nie
            if(mysql_num_rows($result)==0){
    $ins = @mysql_query("INSERT INTO PLAY SET ID_GRACZ='$ty', PLAY='$play_val', ID_GRY='$game_id'"); 
					   } 
//jeśli już oceniono, ocena zostaje zaktyalizowana
else{

$zapytanie = "UPDATE PLAY SET PLAY='$play_val' WHERE ID_GRACZ='$ty' AND ID_GRY='$game_id'";

$idzapytania = mysql_query($zapytanie);

}
	}




if($_SESSION['logged']) {

if(isset($_POST['com_s'])){
            $result = mysql_query("SELECT * FROM KOMENTARZE_ART WHERE ID_GRACZ='$ty' AND KOM_ART='$comtext' AND ID_ARTYKUL='$article_id'");
$com_date = date("Y-m-d");
    $com_time = date('H:i:s');       

             // jeśli nie istnieje
            if(mysql_num_rows($result)!=0){

}
else{
    $ins = @mysql_query("INSERT INTO KOMENTARZE_ART SET ID_GRACZ='$ty', KOM_ART='$comtext', ID_ARTYKUL='$article_id', DATE='$com_date', TIME='$com_time'");
 }
}
}



$zapytanie = "Select OCENA_ART FROM OCENA_ART WHERE ID_GRACZ = '$ty' and ID_ART = '$article_id'";
list($ocena_gracz)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "Select PLAY FROM PLAY WHERE ID_GRACZ = '$ty' and ID_GRY = '$game_id'";
list($play_gracz)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "SELECT avg(OCENA_ART) FROM `OCENA_ART` WHERE ID_ART = '$article_id'";
list($ocena)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "SELECT COUNT(*) FROM OCENA_ART WHERE OCENA_ART > 0 and OCENA_ART <= 10 and ID_ART = '$article_id'";
list($ile_ocen)=mysql_fetch_array (mysql_query($zapytanie));

$zapytanie = "SELECT COUNT(*) FROM KOMENTARZE_ART WHERE ID_ARTYKUL='$article_id'";
list($ile_kom)=mysql_fetch_array (mysql_query($zapytanie));

$ile_stron = ceil($ile_kom/$kpp);


if($_REQUEST['page']==null){
$page = 1;
} else {
$page = $_REQUEST['page'];
	}

/*
echo '<table><tr><td rowspan="2">';
echo '<ocena>'.$ocena.'</ocena>';
echo '</td>';
echo '<tr><td>'.$ile_ocen.' Głosów</td></tr>';
echo '<tr><td>Ulubionych</td></tr></tr>
</table>';
*/


echo'
<table>
  <tr>
    <td rowspan="3" valign="top"><ocena>'.round($ocena,1).'</ocena></td>
    <td width="33%">Głosów: '.$ile_ocen.' </td>
    <td width="33%">Twoja ocena: '.$ocena_gracz.' </td>
  </tr>
  <tr>';
// Mozliwość głosowania jest dostępna dopiero po zalogowaniu się
if($_SESSION['logged'] and $article_id!=null and $article_id!=0) {
echo '
    <td>Oceń: <form action="'.$site_adr.'" method="POST"><select name="ocena">';

for($i=1; $i<=10; $i++){
if($i==$ocena_gracz){

 echo "<option selected value='$i'>$i</option>";

} else {

 echo "<option value='$i'>$i</option>";
	}




}



echo '</select><br>
<input type="submit" name="ocena_s" value="Oceń" ></input></form>';
}


$result = mysql_query("SELECT * FROM ULUBIONE WHERE ID_GRY='$game_id'AND ID_GRACZ='$user_id'") ;


if(mysql_num_rows($result)!=0) {
echo '<a href="fav.php?id='.$article_id.'">Lubisz tą grę</a>';
} else {
echo '<a href="fav.php?id='.$article_id.'">Nie lubisz tej gry</a>';
}

echo '</td>
  </tr>

  <tr>';
// Mozliwość głosowania jest dostępna dopiero po zalogowaniu się
if($_SESSION['logged'] and $article_id!=null and $article_id!=0) {
echo '
    <td>Chcę zagrać: <form action="'.$site_adr.'" method="POST"><select name="zagraj">';

for($i=0; $i<=3; $i++){
if($i==$play_gracz){

 echo "<option selected value='$i'>$i</option>";

} else {

 echo "<option value='$i'>$i</option>";
	}




}



echo '</select><br>
<input type="submit" name="play_s" value="Chcę zagrać" ></input></form>';
}

echo '</td>
  </tr>


</table>
';



echo "</br>";
echo "</br>";




?>
</div>
</div>
</gra>

<comment>
Komentarze (<?php echo $ile_kom; ?>)

<?php
//sekcja z komentarzami
//formularz komentarzy, także dostępny dopiero dla zalogowaych

if($_SESSION['logged'] and $article_id!=null and $article_id!=0) {
echo '<table id="asd"><tr><td><form action="'.$site_adr.'" method="post">
<textarea name="comtext" placeholder="Treść komentarza..." id="comtext"></textarea></td>
<td align="left"><input type="submit" name="com_s" value="Dodaj komenarz" class="btn"></input></td></tr>
</form></table>';
}
echo '<table>';



/*
$wynik = mysql_query("SELECT * FROM KOMENTARZE_ART WHERE ID_ARTYKUL='$article_id' ORDER BY ID_KOM_ART ASC");
*/


$wynik = mysql_query("SELECT * FROM KOMENTARZE_ART, GRACZ WHERE KOMENTARZE_ART.ID_ARTYKUL='$article_id' and KOMENTARZE_ART.ID_GRACZ=GRACZ.ID_GRACZ ORDER BY ID_KOM_ART DESC");

$i=0;
while($wiersz = mysql_fetch_array($wynik))
  {

//pobranie danych dotyczących komentarza
	
$tresc_kom[$i] = $wiersz['KOM_ART'].'';
$id_aut[$i] = $wiersz['ID_GRACZ'].'';
$log_aut[$i] = $wiersz['LOGIN'].'';
$id_kom[$i] = $wiersz['ID_KOM_ART'].'';
$data[$i] = $wiersz['DATE'].'';
$godz[$i] = $wiersz['TIME'].'';


$i++;
  }



//wyświetlenie komentarzy
for($i=(($page*$kpp)-$kpp), $j=(($page*$kpp)-$kpp+1); $i<($page*$kpp) and $i<$ile_kom; $i++, $j++){

echo'<br> <table>
<tr><td width="55px"><a href="profile.php?id='.$id_aut[$i].'"><div id="avatar-kom" style="background-image: url(img/avatar/avatar'.$id_aut[$i].'.jpg); background-repeat: no-repeat; background-size:50px, 50px;
background-position: center; width:50px; height:50px; border-style: solid; border-width:1px; border-radius: 100px;"></div></a></td><td><div id="kom-aut">Autor: <a href="profile.php?id='.$id_aut[$i].'">'.$log_aut[$i].'</a><br>Data Dodania:'.$data[$i].'<br>Czas: '.$godz[$i].'</div></td></tr>
<tr><td colspan="2"><div id="kom-tresc"><hr>'.$tresc_kom[$i].'</div></td></tr>
</table>';
  
	}
 



//Poprzednia strona 123(4)56789 Następna strona || dla wszystkich

echo '<div id="list_nav">';
if($page>1){
echo '<a href='.$site_adr.'&page='.($page-1).'>Nowsze</a> ';
}else {
echo 'Nowsze ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href='.$site_adr.'&page='.$i.'>'.$i.'</a> ';
}

}
if($page<$ile_stron){
echo '<a href='.$site_adr.'&page='.($page+1).'>Starsze</a> ';
}else {
echo 'Starsze';
}


echo '</div>';





?>



</comment>

</artykul>


</topper>

<?php //require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
