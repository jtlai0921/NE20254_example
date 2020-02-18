<?php
require_once 'Auth/Auth.php';

class Perm extends Auth {

  function checkPerm($area_id) {
    $sSQL = sprintf("SELECT p.group_id FROM users_group p, area r  
                     WHERE p.user_id=%d AND p.group_id=r.group_id AND r.area_id=%d",
		    $this->getAuthData('user_id'), $area_id);
    $result = $this->storage->query($sSQL);
    if (DB::isError($result)) {
      return false;      
    }
    return $result->numRows() > 0 ? true: false;
  }

  function getGroup() {
    $sSQL = sprintf("SELECT pn.name FROM users_group p
                     INNER JOIN group_name pn ON p.group_id=pn.group_id
                     WHERE p.user_id=%d", $this->getAuthData('user_id'));
    $result = $this->storage->db->getOne($sSQL);
    if (DB::isError($result)) {
      return false;      
    }
    return $result;
  }

  function getAreaName($area_id) {
    $sSQL = sprintf("SELECT name FROM area_name WHERE area_id=%d", $area_id);
    $result = $this->storage->db->getOne($sSQL);
    if (DB::isError($result)) {
      return false;      
    }
    return $result;
  }
}
?>
