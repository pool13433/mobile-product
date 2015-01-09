<?php

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "db_mobile");
$conn = mysql_connect(HOST, USERNAME, PASSWORD) or die(mysql_error());
if (!empty($conn)) {
    mysql_select_db(DATABASE);
    mysql_query("SET NAMES UTF8");
} else {
    mysql_error();
}
