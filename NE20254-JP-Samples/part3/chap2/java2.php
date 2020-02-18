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
   try {
     $calc = new Java('Calc');
     $calc->set($_POST['a'],$_POST['b']);
     echo "a+b= " . $calc->add() . "<br />\n";
     echo "a-b= " . $calc->sub();
   } catch (Java_Exception $e) {
     echo "Exception: ".$e->toString()."<br />";
     echo "Code: ".$e->getCode()."<br />";
     echo "File: ".$e->getFile()."<br />";
     echo "Line: ".$e->getLine()."<br />";
     echo "Trace :".nl2br($e->getTraceAsString())."<br />";
   } 
 } 
?>
</body></html>
