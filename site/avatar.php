<?php

$idgracza = $_SESSION['ID_GRACZ'];

$zapytanie = "Select AVATAR FROM GRACZ WHERE ID_GRACZ = '$idgracza'";
list($uavatar)=mysql_fetch_array (mysql_query($zapytanie));

$avek = 'img/avatar/'.$uavatar;

echo '<a href="profile.php?id='.$idgracza.'"><div id="avatar" style="background-image: url('.$avek.'); background-repeat: no-repeat; background-size:50px, 50px;
background-position: center; width:50px; height:50px; border-style: solid; border-width:1px; border-radius: 100px;"></div></a>';

?>
