<?php
require_once("lib.php");
start();
$begin = $_GET['begin'];
$count = $_GET['count'];
for ($i = $begin; $i < $begin + $count && $i < count($Articles); $i++)
{
	echo array_values($Articles)[$i];
}
?>