<?php
$dbh = new PDO("pgsql:dbname=test","","");
$sql = "INSERT INTO guestbook (name, comment) VALUES (:name, :comment)";
$stmt = $dbh->prepare($sql);
// �ѿ��Х����
$stmt->bindParam(':name', $name, PDO_PARAM_STR, 32);
$stmt->bindParam(':comment', $comment, PDO_PARAM_STR, 128);
// �ƥ���������1
$name = 'jiro'; $comment = 'test comment 1.';
$stmt->execute();
// �ƥ���������2
$name = 'saburo'; $comment = 'test comment 2.';
$stmt->execute();
?>
