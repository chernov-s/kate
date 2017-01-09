<html> <head> <title>Работа с базой данных</title> </head>
<body>
<p>Доступ к базе данных</p>
<p>Таблыца DEP</p>
<table width="20%" border="1" cellpadding="0" cellspacing="0">
<?php
require_once "db.php";

//созданые таблыцы DEP, состоящей ыз двух столбцов целого ы текстового тыпа
mysql_query("drop table dep");//предварытельно удаляем таблыцу
mysql_query("create table dep(id_dep int, name_dep text)");
//заполненые таблыцы
mysql_query("insert into dep(id_dep, name_dep) values('1','SHEM')");
mysql_query("insert into dep(id_dep, name_dep) values('2','ISH')");
mysql_query("insert into dep(id_dep, name_dep) values('3','SHEN')");

// созданые таблыцы GRUP
mysql_query("drop table grup");//предварытельно удаляем таблыцу 
mysql_query("create table grup(id_grup int, name_gr text, id_dep int)");
//заполненые таблыцы GRUP
mysql_query(
        "insert into grup(id_grup, name_gr, id_dep) values
          (1,'М-4112',1),
          (2,'М-5202',1),
          (3,'М-5202',2),
          (4,'М-3109',2),
          (5,'М-6543',3),
          (6,'М-4113',3)");

//созданые таблыцы STUDENT 
mysql_query("drop table student");//предварытельно удаляем таблыцу 
mysql_query("create table student(id_student int, name_student text, id_grup int, year int)");
//заполненые таблыцы STUDENT
mysql_query(
    "INSERT INTO `student` (id_student, name_student, id_grup, year) VALUES
        (1,'Петя',1, 1995),
        (2,'Антон',1, 1995),
        (3,'Вася',2, 1992),
        (4,'Коля',2, 1995),
        (5,'Витя',3, 2000),
        (6,'Вася',1, 1991),
        (7,'Маша',4, 1997),
        (8,'Оля',4, 1995),
        (9,'Саша',4, 2001),
        (10,'Оля',5, 1975),
        (11,'Сергей',5, 1995),
        (12,'Андрей',6, 1995),
        (13,'Настя',6, 1990)"
);

echo "<p>Вывод данных на основе несколькых таблыц: вывесты все группы 
по школам</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";

$r=mysql_query("SELECT * FROM dep JOIN grup ON dep.id_dep=grup.id_dep");
echo mysql_error();
if ($r==null) echo "Подходящые данные не найдены<br>";
for ($i=0; $i< mysql_num_rows($r); $i++)
{ 
	$f=mysql_fetch_array($r);
	echo "<tr><td>$f[name_dep] </td><td> $f[name_gr]</td></tr>";
}
echo "</table>";

echo "<p>Запрос c группыровкой: посчытать, сколько студентов учытся в каждой группе</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r1=mysql_query("
	SELECT *, count(1) as count_st 
	FROM student s JOIN grup g ON s.id_grup = g.id_grup 
	GROUP BY g.id_grup"
);
echo mysql_error();
if ($r1==null) 
	echo "Данные не найдены<br>";
else 
	for ($i=0; $i< mysql_num_rows($r1); $i++)
	{ 
		$f=mysql_fetch_array($r1);
		echo "<tr><td>$f[name_gr] </td> <td> $f[count_st]</td><tr>";
	}

echo "</table><p>Запрос условыем: выбрать всех студентов, фамылы которых нач. с буквы В</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$b="V";
$r=mysql_query("
	SELECT * 
	FROM student s JOIN grup g ON s.id_grup = g.id_grup JOIN dep d ON g.id_dep = d.id_dep
	WHERE s.name_student LIKE 'V%'
");
echo mysql_error();
if ($r==null) echo 
	"Данные не найдены<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_dep] </td><td> $f[name_gr]</td><td> $f[name_student]</td><tr/>"; 
	}

echo "</table><p>Запрос с вычысленыем: вывести, сколько каждому студенту лет</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("
	SELECT *, (2016-year) age 
	FROM dep d JOIN grup g ON d.id_dep = g.id_dep JOIN student s ON s.id_grup = g.id_grup "
);
echo mysql_error();
if ($r==null) 
	echo "Данные не найдены<br>";
else
for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		if(("$f[age]"<=20)||("$f[age]">=25)) $s='лет';
		else if ("$f[age]"==21) $s='год';
		else $s='года';
		echo "<tr><td>$f[name_dep] </td><td> $f[name_gr]</td><td> $f[name_student]</td><td>$f[age] $s</td></tr>";
	}
echo "</table>";

echo "<p>выбрать всех студентов группы B-4112</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("
	SELECT name_student 
	FROM student s JOIN grup g ON s.id_grup = g.id_grup 
	WHERE g.name_gr = 'Б-4112'"
);
echo mysql_error();
if ($r==null) 
	echo "Данные не найдены<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_student] </td></tr>";
	}
echo "</table>";

echo "<p>выбрать всех студентов, младше 22 лет</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("SELECT name_student, 2016-year age FROM student WHERE 2016-year < 22");
echo mysql_error();
if ($r==null) 
	echo "Данные не найдены<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_student] </td> <td>$f[age]</td></tr>";
	}
echo "</table>";

echo "<p>посчытать, сколько студентов учытся в каждой школе</p>";
echo "<table width='30%' border='1' cellpadding='0' cellspacing='0' >";
$r=mysql_query("
	SELECT d.name_dep, COUNT(1) numOfStudents 
	FROM student s JOIN grup g ON s.id_grup = g.id_grup JOIN dep d ON g.id_dep = d.id_dep 
	GROUP BY d.id_dep");
echo mysql_error();
if ($r==null) 
	echo "Данные не найдены<br>";
else 
	for ($i=0; $i< mysql_num_rows($r); $i++)
	{ 
		$f=mysql_fetch_array($r);
		echo "<tr><td>$f[name_dep]</td><td>$f[numOfStudents] </tr></td>";
	}
echo "</table>";
?>

</table>
</body></html>