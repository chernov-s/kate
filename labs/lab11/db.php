<?php
define("HostName","localhost");
define("UserName","root");
define("Password","");
$link=mysql_connect(HostName, UserName, Password);
mysql_query("set names 'utf-8'", $link);
mysql_SELECT_db("stud") or die(mysql_error());