<?php
include_once "db.php";

$total=$Total->find(1);
$Total['total']=$_POST['total'];
$Total->save($total);
to("../back.php?do=total");
?>