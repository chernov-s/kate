<html>
<head>
    <title>Работа с базой данных</title>
</head>
<body>
<p>Доступ к базе данных</p>
<p>Таблица DEP</p>
<table width="20%" border="1" cellpadding="0" cellspacing="0">
<?php
require_once "db.php";

//создание таблицы DEP, состоящей из двух столбцов целого и текстового типа
mysql_query("drop table dep");//предварительно удаляем таблицу
mysql_query("create table dep(id_dep int, name_dep text)");
//заполнение таблицы
mysql_query(
    "INSERT INTO `dep` (id_dep, name_dep) VALUES
        (1,'ШЭМ'),
        (2,'ЫШ'),
        (3,'ШЕН')"
);

// создание таблицы GRUP
mysql_query("drop table grup");//предварительно удаляем таблицу 
mysql_query("create table grup(id_grup int, name_gr text, id_dep int)");
//заполнение таблицы GRUP
mysql_query(
    "INSERT INTO `grup` (id_grup, name_gr, id_dep) VALUES
        (1,'Б-4112',1),
        (2,'Б-5202',1),
        (3,'Б-3109',2),
        (4,'Б-1234',3),
        (5,'Б-6543',3),
        (6,'Б-8787',1)"
);

//создание таблицы STUDENT 
mysql_query("drop table student");//предварительно удаляем таблицу 
mysql_query("create table student(id_student int, name_student text, id_grup int)");
//заполнение таблицы STUDENT
mysql_query(
    "INSERT INTO `category` (id_student, name_student, id_grup) VALUES
        (1,'Петя',1),
        (2,'Антон',1),
        (3,'Вася',2),
        (4,'Коля',2),
        (5,'Витя',3),
        (6,'Вася',1),
        (7,'Маша',4),
        (8,'Оля',4),
        (9,'Саша',4),
        (10,'Оля',5),
        (11,'Сергей',5),
        (12,'Андрей',6),
        (13,'Настя',6)"
);

$r=mysql_query("select * from dep");
if ($r==null) 
	echo "Данных в таблице нет<br>";
else
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_dep] </td><td> $f[id_dep]</td></tr>";
	}

echo "</table><p>Таблица GRUP</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("select * from grup");
if ($r==null) 
	echo "Данных в таблице нет<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_gr] </td> <td> $f[id_dep]</td><td> $f[id_grup]</td></tr>";
	}

echo "</table><p>Таблица STUDENT</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("select * from student");
if ($r==null) 
	echo "Данных в таблице нет<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_student] </td> <td> $f[id_student]</td><td> $f[id_grup]</td></tr>";
	}
?>

</table>
</body>
</html>