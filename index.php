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
<?php require('site/head_top.php'); 


?>


</header>
<searchpan>
<?php
require('site/search.php');
?>
</searchpan>
<main>
<a href="/article.php?id=56"><main-top data-stellar-ratio="2">
<table>
<tr>
<td>
<div class="naglowek"><h2>Hit czy kit? Światowa premiera WATCH_DOGS</h2><h3>Sprawdź przedpremierową recenzję. Tylko u nas!</h3><read>Przeczytaj</read></div>

</tr></td></table>




</main-top></a>
<div class="popular" align="center">
<h4 align="left">Najpopularniejsze</h4>

<?php

$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1 and ACCEPT=1 ORDER BY VIEWED DESC");
$i=1;

while($wiersz = mysql_fetch_array($wynik))
  {
$tablica[$i] ='<a href="article.php?id='.$wiersz['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$wiersz['COVER'].'"></img></div><div id="tit_arti">'.$wiersz['TYTUL_ART'].'</div></div></a>';
$i++;

  }



echo '<table align="center" >';

echo '<tr>';

for($i=0; $i<=3; $i++){
if($i>0){
echo "<td width='150px' align='center'>$tablica[$i]</td>";

}
}
echo '</tr>';



echo '</table>';





?>


</div>








<?php require('site/gamelist.php'); ?>
<?php// require('site/trailers.php'); ?>


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
