<html>
<body>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
 a:<input type="text" name="a">
 b:<input type="text" name="b">
 <input type="submit">
</form>
<hr />
<?php
 if (isset($_POST['a'])){
   $calc = new Java('Calc');
   $calc->set($_POST['a'],$_POST['b']);
   echo "a+b= " . $calc->add() . "<br />\n";
   echo "a-b= " . $calc->sub();
 } 
?>
</body></html>
