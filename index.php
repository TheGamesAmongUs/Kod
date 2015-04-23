<!DOCTYPE html>
<html>
<head>
<title>TheGamesAmongUs</title>
<?php
require('site/head.php');
?>
</head>
<body>
<?php
require('site/bhead.php');
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
<a href="#"><main-top>
<table>
<tr>
<td>
<div class="naglowek"><h2>Hit czy kit? Światowa premiera <gra>WATCH_DOGS</gra></h2><h3>Sprawdź przedpremierową recenzję. Tylko u nas!</h3><read>Przeczytaj</read></div>

</tr></td></table>
</main-top></a>
<div class="popular" align="center">
<h4 align="left">Najpopularniejsze<hr id="hrf2" align="left"></h4>
<table><tr></tr><tr><td><a href="#"><img src="img/bf4.jpg"></img></a></td><td><a href="#"><img src="img/cod.jpg"></img></a></td><td> <a href="#"><img src="img/cs.jpg"></img></a></td></tr><tr><td>Battlefield 4</td><td>Call of Duty: Ghost</td><td>Counter Strike GO</td></tr></table>
</div>
</topper>

<?php require('site/gamelist.php'); ?>
<?php require('site/trailers.php'); ?>


</main>


<footer id="f2">
<?php require('site/footer2.php'); ?>
</footer>
<footer id="f1"><?php require('site/footer.php'); ?> </footer>
</body>

</html>
