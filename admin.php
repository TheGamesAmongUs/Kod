<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>


<?php
require('site/head.php');

if($_REQUEST['page']==null){
$page = 1;
} else
$page = $_REQUEST['page'];

$alfa = $_REQUEST['alfa'];
$lit =  $_REQUEST['lit'];
$ungames =  $_REQUEST['games'];
$rights =  $_REQUEST['rights'];

$wpp = 28+1;
?>
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
<?php



echo '<div class="gry-szukaj">';

if($ungames==1){

echo '<h4 align="left">Lista gier do aktywacji</a></h4>';



$zapytanie = "SELECT COUNT(*) FROM ARTYKULY WHERE RODZAJ = 1 AND ACCEPT = 0 ";
list($ile_gier)=mysql_fetch_array (mysql_query($zapytanie));



$zapytanie = "SELECT COUNT(*) FROM ARTYKULY WHERE RODZAJ = 1 and TYTUL_ART LIKE '$lit%' AND ACCEPT = 0 ";
list($ile_gier_lit)=mysql_fetch_array (mysql_query($zapytanie));




//echo $ile_gier_lit;

/*
for($i = 1; $i <= $ile_gier; $i++){
$zapytanie = "Select TYTUL_ART FROM ARTYKULY WHERE ID_ARTYKUL = '$i' and RODZAJ = 1 AND ACCEPT = 0 ";
list($tytul)=mysql_fetch_array (mysql_query($zapytanie));

echo $i.' ';
echo '<a href="article.php?id='.$i.'">'.$tytul.'</a></br>';
}


*/



echo '<div id="abc">';

for($i=97; $i<123; $i++){


if($lit==chr($i) or strtoupper($lit)==chr($i-32)){
echo chr($i-32).' - ';
}else{
if($i<122)
echo '<a href=admin.php?games=1&alfa=1&lit='.chr($i).'>'.chr($i-32).'</a> - ';
else if ($i==122)
echo '<a href=admin.php?games=1&alfa=1&lit='.chr($i).'>'.chr($i-32).'</a> - <a href="admin.php?games=1">Wszystkie</a>';
}



}
echo '</div>';
echo '</br>';






echo '<table align="center" >';

echo '<tr>';

for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<=$ile_gier; $i++, $j++){
if($i>0){
echo "<td width='150px' align='center'>$tablica[$i]</td>";
if($i%7==0 and $i!=0){
echo'</tr><tr>';
}


}
}
echo '</tr>';



echo '</table>';






if($alfa==1) {
$ile_stron = ceil($ile_gier_lit/$wpp);
$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1  and TYTUL_ART LIKE '$lit%' AND ACCEPT = 0  ORDER BY TYTUL_ART ASC");
$i=1;
echo strtoupper($lit).'</br>';
while($wiersz = mysql_fetch_array($wynik))
  {
	

$tablica[$i] ='<a href="article.php?id='.$wiersz['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$wiersz['COVER'].'"></img></div><div id="tit_arti">'.$wiersz['TYTUL_ART'].'</div></div></a>';

$i++;

  }



echo '<table align="center" >';

echo '<tr>';

for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<=$ile_gier; $i++, $j++){
if($i>0){
echo "<td width='150px' align='center'>$tablica[$i]</td>";
if($i%7==0 and $i!=0){
echo'</tr><tr>';
}


}
}
echo '</tr>';



echo '</table>';



//Poprzednia strona 123(4)56789 Następna strona || Dla alfabetycznej listy

echo '<br><div id="list_nav">';

if($page>1){
echo '<a href=admin.php?games=1&alfa=1&lit='.$lit.'&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href=admin.php?games=1&alfa=1&lit='.$lit.'&page='.$i.'>'.$i.'</a> ';
}

}

if($page<$ile_stron){
echo '<a href=admin.php?games=1&alfa=1&lit='.$lit.'&page='.($page+1).'>Następna Strona</a> ';
}else {
echo 'Następna Strona';
}




//Wszystkie
} else{
$ile_stron = ceil($ile_gier/$wpp);
$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1 AND ACCEPT = 0  ORDER BY TYTUL_ART ASC");
$i=1;

while($wiersz = mysql_fetch_array($wynik))
  {
$tablica[$i] ='<a href="article.php?id='.$wiersz['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$wiersz['COVER'].'"></img></div><div id="tit_arti">'.$wiersz['TYTUL_ART'].'</div></div></a>';
$i++;

  }

/*
for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<=$ile_gier; $i++, $j++){

echo $tablica[$i].'</br>';

		 
}
*/



echo '<table align="center" >';

echo '<tr>';

for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<=$ile_gier; $i++, $j++){
if($i>0){
echo "<td width='150px' align='center'>$tablica[$i]</td>";
if($i%7==0 and $i!=0){
echo'</tr><tr>';
}


}
}
echo '</tr>';



echo '</table>';





//Poprzednia strona 123(4)56789 Następna strona || dla wszystkich

echo '<br><div id="list_nav">';
if($page>1){
echo '<a href=admin.php?games=1&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href=admin.php?games=1&page='.$i.'>'.$i.'</a> ';
}

}
if($page<$ile_stron){
echo '<a href=admin.php?games=1&page='.($page+1).'>Następna Strona</a> ';
}else {
echo 'Następna Strona';
}

}

echo '</div>';

/*
while($wiersz = mysql_fetch_array($wynik))
  {
	
  echo $i;
  echo ' <a href="article.php?id='.$wiersz['ID_ARTYKUL'].'">'.$wiersz['TYTUL_ART'].'</a>';
  echo "<br>";
  }
*/




}



if($rights==1){


echo '<h4 align="left">Wyniki Wyszukiwania</h4>


<div>';

$zapytanie = "SELECT COUNT(*) FROM GRACZ";
list($ile_wynik)=mysql_fetch_array (mysql_query($zapytanie));

echo 'Odnalezionych użytkowników: '.$ile_wynik.'<br>';


echo '</br>';


$ile_stron = ceil($ile_wynik/$wpp);
$wynik = mysql_query("SELECT * FROM GRACZ ORDER BY ID_GRACZ ASC");
$i=0;

while($wiersz = mysql_fetch_array($wynik))
  {
	
//$tablica[$i] ='<a href="article.php?id='.$wiersz['ID_ARTYKUL'].'">'.$wiersz['TYTUL_ART'].'</a>';
$tablica[$i] = $wiersz['LOGIN'].' '.$wiersz['REG_DATE'].' Mod: ';

if($wiersz['MOD']==1){
$tablica[$i].='Tak';

} else {
$tablica[$i].='Nie';

}
$tablica[$i].=' <a href="rights.php?id='.$wiersz['ID_GRACZ'].'">Zmień</a>';


$i++;

  }


for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<$ile_wynik; $i++, $j++){ //Wyświetlanie odpowieniedniej ilości rekordów na podtronie

echo $j.' '.$tablica[$i].'</br>';
		 
}

echo '</div>';

//Poprzednia strona 123(4)56789 Następna strona || Dla alfabetycznej listy

echo '<br><div id="list_nav">';
if($page>1){
echo '<a href=admin.php?rights=1&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href=admin.php?rights=1&page='.$i.'>'.$i.'</a> ';
}

}
if($page<$ile_stron){
echo '<a href=admin.php?rights=1&page='.($page+1).'>Następna Strona</a> ';
}else {
echo 'Następna Strona';
}

}




echo '</div>';

?>



<?php //require('site/trailers.php'); ?>



</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
