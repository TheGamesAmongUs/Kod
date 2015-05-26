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
$fav =  $_REQUEST['fav'];
$id =  $_REQUEST['id'];


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

if($fav==1){

if($_REQUEST['id']==null){
$user_id = $_SESSION['ID_GRACZ'];
} else {
$user_id = $id;
}


$zapytanie = "SELECT LOGIN FROM GRACZ WHERE ID_GRACZ=$user_id ";
list($user_name)=mysql_fetch_array (mysql_query($zapytanie));


echo '<h4 align="left">Lista ulubionych gier użytkownika: '.$user_name.'</a></h4>';




/*

$zapytanie = "SELECT COUNT(*) FROM ARTYKULY WHERE RODZAJ = 1 AND ACCEPT = 1 ";
list($ile_gier)=mysql_fetch_array (mysql_query($zapytanie));

*/


$zapytanie = "SELECT COUNT(*) FROM ULUBIONE WHERE ID_GRACZ=$user_id";
//list($ile_gier)=mysql_fetch_array (mysql_query($zapytanie));
$ile_gier=5;

/*
$zapytanie = "SELECT COUNT(*) FROM ULUBIONE WHERE ID_GRACZ='$user_id' AND RODZAJ = 1 and TYTUL_ART LIKE '$lit%' AND ACCEPT = 1 ";
list($ile_gier_lit)=mysql_fetch_array (mysql_query($zapytanie));
*/


//echo $ile_gier_lit;




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
$wynik = mysql_query("SELECT * FROM ARTYKULY, ULUBIONE WHERE RODZAJ.ARTYKULY = 1  and TYTUL_ART.ARTYKULY LIKE '$lit%' AND ACCEPT.ARTYKULY = 1  ORDER BY TYTUL_ART.ARTYKULY ASC");

//select * from tab1,tab2 where lol.tab1=lol2.tab2


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
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&alfa=1&lit='.$lit.'&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&alfa=1&lit='.$lit.'&page='.$i.'>'.$i.'</a> ';
}

}

if($page<$ile_stron){
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&alfa=1&lit='.$lit.'&page='.($page+1).'>Następna Strona</a> ';
}else {
echo 'Następna Strona';
}




//Wszystkie
} else{
$ile_stron = ceil($ile_gier/$wpp);
$wynik = mysql_query("SELECT * FROM ARTYKULY, ULUBIONE WHERE ARTYKULY.RODZAJ = 1  AND ARTYKULY.ACCEPT = 1 AND ULUBIONE.ID_GRY = ARTYKULY.ID_GRY AND ULUBIONE.ID_GRACZ=$user_id ORDER BY ARTYKULY.TYTUL_ART ASC");
//$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1 AND ACCEPT = 1  ORDER BY TYTUL_ART ASC");



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
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&page='.($page-1).'>Poprzednia Strona</a> ';
}else {
echo 'Poprzednia Strona ';
}

for($i=1; $i<=$ile_stron; $i++){
if($i==$page){
echo $page.' ';
}else{
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&page='.$i.'>'.$i.'</a> ';
}

}
if($page<$ile_stron){
echo '<a href='.$_SERVER['SCRIPT_NAME'].'?fav=1&page='.($page+1).'>Następna Strona</a> ';
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
