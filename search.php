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

$lit =  $_REQUEST['q'];

$wpp = 4;
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
<topper>
<div class="gry-szukaj">
<h4 align="left">Wyniki Wyszukiwania</h4>
<?php


echo '<div id="abc">';

if($lit!=null){
$zapytanie = "SELECT COUNT(*) FROM ARTYKULY WHERE RODZAJ = 1 and ACCEPT=1 and TYTUL_ART  LIKE '%$lit%'";
list($ile_wynik)=mysql_fetch_array (mysql_query($zapytanie));
} else {
$ile_wynik = 0;
}
echo 'Wyszukanych Gier: '.$ile_wynik.'<br>';


echo '</br>';


$ile_stron = ceil($ile_wynik/$wpp);
$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1  and TYTUL_ART LIKE '%$lit%' and ACCEPT=1 ORDER BY TYTUL_ART ASC");
$i=0;

while($wiersz = mysql_fetch_array($wynik))
  {
	
$tablica[$i] ='<a href="article.php?id='.$wiersz['ID_ARTYKUL'].'">'.$wiersz['TYTUL_ART'].'</a>';
$i++;

  }


for($i=(($page*$wpp)-$wpp), $j=(($page*$wpp)-$wpp+1); $i<($page*$wpp) and $i<$ile_wynik; $i++, $j++){ //Wyświetlanie odpowieniedniej ilości rekordów na podtronie

echo $j.' '.$tablica[$i].'</br>';
		 
}

echo '</div>';

//Poprzednia strona 123(4)56789 Następna strona || Dla alfabetycznej listy

echo '<br><div id="list_nav">';
if($page>1){
echo '<a href=search.php?q='.$lit.'&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href=search.php?q='.$lit.'&page='.$i.'>'.$i.'</a> ';
}

}
if($page<$ile_stron){
echo '<a href=search.php?&q='.$lit.'&page='.($page+1).'>Następna Strona</a> ';
}else {
echo 'Następna Strona';
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

?>



</div>




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
