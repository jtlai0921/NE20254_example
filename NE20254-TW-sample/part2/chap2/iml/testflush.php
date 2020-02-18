<?php
echo "<pre>";
var_dump( ob_get_status() );
echo "</pre>";

ob_end_flush ();

//begin code
$i = 0;

echo str_pad(" ", 256);

while($i < 10)
{
   sleep(1);
   echo $i."<br />";
   flush();
   $i++;
}
//end code
?>
