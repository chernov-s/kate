<body>
	<p>Choose data </p>
	<form action="view_grup.php" method="post" >
		Grup: <input size='15' name='p1' type='text' value=''>
	</form>
	<?php
        require_once "db.php";

		//проверяем, был ли передан параметр методом POST
		if (isset($_POST['p1']))
		{ 
			$s1=$_POST["p1"];//заносим значение параметра в переменную
			
			$r=mysql_query("SELECT * FROM grup JOIN student ON grup.id_grup=student.id_grup WHERE name_gr = '$s1'");
			echo mysql_error();
			if ($r==null) 
				echo "Data not found<br>";
			else {
				echo $s1;
				echo "<table border='1'>";
				for ($i=0; $i< mysql_num_rows($r); $i++)
				{ 
					$f=mysql_fetch_array($r);
					echo "<tr><td> $f[name_gr]</td><td> $f[name_student]</td><tr/>";
				}
				echo "</table>";
			}
		}
	?>
</body>