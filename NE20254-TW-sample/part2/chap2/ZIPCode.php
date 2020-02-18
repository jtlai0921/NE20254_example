<?php
define("DBSRC","c:/temp/adrs.db");

class ZIPCode {
  function getInfoByZIP($num) {
    $db = new SQLiteDatabase(DBSRC);
    $row = $db->arrayQuery("select pref,city,address from yubin where pid=$num");
    if (!$row) {
      //throw new SoapFault("Server","Unknown address");      
      return null;
    }
    $adrs = $row[0]['pref'].$row[0]['city'].$row[0]['address'];
    return $adrs;
  }
}
?>
