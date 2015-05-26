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
$act_code = $_REQUEST['code'];
$user_id =  $_REQUEST['id'];
baza();
?>

<header name="top">
<?php

require('site/menu.php');


?>
<logpan>

<?php
require('site/logpan.php');
?>
</logpan>
</header>
<searchpan>
<?php
require('site/search.php');
?>
</searchpan>
<main>
<topper>
<div>

<?php

            $result = mysql_query("SELECT * FROM GRACZ WHERE ACT_CODE='$act_code' aND ACTIVE='0' AND ID_GRACZ='$user_id'");
           
             // jeśli nie istnieje
            if(mysql_num_rows($result)==0) echo 'Podany kod aktywacyjny jest niepoprawny';
         
             // jeśli tak...
            else
            {

$zapytanie = "UPDATE GRACZ SET ACTIVE='1' WHERE ACT_CODE='$act_code' AND ID_GRACZ='$user_id'"; 

mysql_query($zapytanie);

echo 'Twoje konto od teraz jest aktywne, możesz się zalogować';
		}
?>
</div>




</topper>

<?php require('site/trailers.php'); ?>




</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</div>
</body>


</html>
