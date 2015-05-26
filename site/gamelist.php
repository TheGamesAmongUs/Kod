<?php
echo '<div class="gry" align="center">
<h4 align="left">Lista Gier</h4>';
$wynik = mysql_query("SELECT * FROM ARTYKULY WHERE RODZAJ = 1 AND ACCEPT=1 ORDER BY ID_ARTYKUL DESC");
$i=1;
while($wiersz2 = mysql_fetch_array($wynik))
  {
	

$tablica2[$i] ='<a href="article.php?id='.$wiersz2['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$wiersz2['COVER'].'"></img></div><div id="tit_arti">'.$wiersz2['TYTUL_ART'].'</div></div></a>';

$i++;

  }



echo '<table align="center" >';

echo '<tr>';

for($i=0; $i<7; $i++){
if($i>0){
echo "<td width='150px' align='center'>$tablica2[$i]</td>";
if($i%3==0 and $i!=0){
echo'</tr><tr>';
}


}
}
echo '</tr>';



echo '</table>
<a href="gamelist.php">Więcej</a>
</div>';

?>
