<?php
include "connect.php";

$result = $link->query("SELECT * FROM `info`");
$myrow = mysqli_fetch_array($result);

echo $myrow['text'];
?>