<?php

require('site/menu.php');




echo '<logpan>';
if($_SESSION['logged'])
{
echo '<av>';
require("site/avatar.php");
echo '</av>';
}
?>
<?php
require('site/logpan.php');
?>
</logpan>
