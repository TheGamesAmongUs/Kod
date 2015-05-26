<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');




?>
</head>
<body>

<div id="site">
<?php
require('site/bhead.php');
if($_REQUEST['id']==null){
if($_SESSION['logged']){
$user_id = $_SESSION['ID_GRACZ'];
			}
} else {
$user_id = $_REQUEST['id'];
}

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
<div id="profile">
<?php


$user_id_log = $_SESSION['ID_GRACZ'];

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




echo '<table><tr><td valign="top">';

echo $ulogin;
if($user_id==$_SESSION['ID_GRACZ']){
echo ' - <a href="edit_profile.php">Edytuj profil</a>';
				    }

echo ' - <a href="ulub.php?fav=1&id='.$user_id.'">Ulubione</a>';

if($user_id==$_SESSION['ID_GRACZ']){
if($_SESSION['MOD']==1 or $_SESSION['ADMIN']==1){
echo ' - <a href="admin.php?games=1">Panel administracyjny</a>';
						}				    
				   }

echo '<br>'.$uimie.' '.$unazwisko;
echo '<div id="avatar" style="background-image: url(img/avatar/'.$uavatar.'); background-repeat: no-repeat; background-size:100px, 100px;
background-position: center; width:100px; height:100px; border-style: solid; border-width:1px; border-radius: 100px;"></div>';
echo 'Zarejestrowany od:<br>'.$uregdate.'

</td>
<td>';

$wynik = mysql_query("select * from OCENA_ART, ARTYKULY where OCENA_ART.ID_ART=ARTYKULY.ID_ARTYKUL and OCENA_ART.ID_GRACZ='$user_id' and ARTYKULY.RODZAJ='1' and ARTYKULY.ACCEPT='1' ORDER BY OCENA_ART.OCENA_ART DESC");
$i=1;

while($voted = mysql_fetch_array($wynik))
  {
$tablica[$i] ='<a href="article.php?id='.$voted['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$voted['COVER'].'"></img></div><div id="tit_arti">'.$voted['TYTUL_ART'].'<br>Ocena: '.$voted['OCENA_ART'].'</div></div></a>';
$i++;

  }


echo'<h4>Najwyżej ocenione</h4>';
echo '<table align="center" >';

echo '<tr>';

for($i=0; $i<=3; $i++){
if($i>0){
echo "<td width='150px' align='center'>$tablica[$i]</td>";

}
}
echo '</tr>';



echo '</table><br>';



echo'<h4>Ostatnio komentowane</h4>';
$wynik2 = mysql_query("select DISTINCT KOMENTARZE_ART.ID_ARTYKUL, ARTYKULY.COVER, ARTYKULY.TYTUL_ART from KOMENTARZE_ART, ARTYKULY where KOMENTARZE_ART.ID_ARTYKUL=ARTYKULY.ID_ARTYKUL and KOMENTARZE_ART.ID_GRACZ='$user_id' and ARTYKULY.RODZAJ='1' and ARTYKULY.ACCEPT='1' ORDER BY KOMENTARZE_ART.DATE DESC");
$i=1;

while($coms = mysql_fetch_array($wynik2))
  {
$tablica2[$i] ='<a href="article.php?id='.$coms['ID_ARTYKUL'].'"><div class="arti"><div id="cov_arti"><img width="65" height="92" src="img/article/'.$coms['COVER'].'"></img></div><div id="tit_arti">'.$coms['TYTUL_ART'].'</div></div></a>';
$i++;

  }



echo '<table align="center" >';

echo '<tr>';

for($i=0; $i<=3; $i++){
if($i>0){
echo "<td width='150px' align='center'>$tablica2[$i]</td>";

}
}
echo '</tr>';



echo '</table>';

echo '</td></tr>
</table>';


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
