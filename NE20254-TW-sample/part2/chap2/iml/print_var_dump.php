<?php
//   Variables($_GET, $_POST, $_REQUEST, $_SERVER) are printed out
// if include this.
echo "<b>_GET:</b><br>\n";
echo var_dump($_GET)."<br><br>\n";
echo "<b>_POST:</b><br>\n";
echo var_dump($_POST)."<br><br>\n";
echo "<b>_REQUEST:</b>\n<pre>";
echo nl2br(print_r(var_dump($_REQUEST)))."\n</pre>";
echo "<b>_SERVER:</b>\n<pre>";
echo nl2br(print_r(var_dump($_SERVER)))."\n</pre>";
?>
