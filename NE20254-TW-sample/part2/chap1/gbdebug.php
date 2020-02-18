<?php
echo "<b>argc</b>=".$_SERVER['argc']."<br>\n";
echo "<b>argv:</b><br>\n";
foreach ($_SERVER['argv'] as $idx => $value) {
  echo "<q>$idx = $value<br>\n";
}
echo "<b>_GET:</b><br>\n";
echo var_dump($_GET)."<br>\n";
echo "<b>_POST:</b><br>\n";
echo var_dump($_POST)."<br>\n";
//echo "<b>_SERVER:</b><br>\n";
//echo nl2br(print_r(var_dump($_SERVER)))."<br>\n";
?>
 