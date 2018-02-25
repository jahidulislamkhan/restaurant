<?php
define("DB_SERVER","localhost");
define("DB_USER","root");
define("DB_PASS","1234");
define("DB_NAME","app");

function db_connect(){
$connection = mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
return $connection; 
}
?> 
