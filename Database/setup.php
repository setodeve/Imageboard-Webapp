<?php
use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

$insert =  "
INSERT INTO books (title, isbn) VALUES ('山田太郎', '000000');
";

$select =  "
select * from books where title = '';
";

$result = $mysqli->query("

");

if($result === false) throw new Exception('Could not execute query.');
else print("Successfully ran all SQL setup queries.".PHP_EOL);
