<body>


	<p>Choose data </p>
	<form action="insert_table.php" method="post" >
		Dep: <br>
		ID: <input size='15' name='did' type='text' value=''>
		Name: <input size='15' name='dname' type='text' value=''>
		<input type="submit" name="submit" value="Send" />
	</form>
	<form action="insert_table.php" method="post" >
		Grup: <br>
		ID: <input size='15' name='gid' type='text' value=''>
		Name: <input size='15' name='gname' type='text' value=''>
		DepId: <input size='15' name='gdep' type='text' value=''>
		<input type="submit" name="submit" value="Send" />
	</form>
	<form action="insert_table.php" method="post" >
		Student: <br>
		ID: <input size='15' name='sid' type='text' value=''>
		Name: <input size='15' name='sname' type='text' value=''>
		Year: <input size='15' name='syear' type='text' value=''>
		GrupId: <input size='15' name='sgrup' type='text' value=''>
		<input type="submit" name="submit" value="Send" />
	</form>
	<?php

        require_once "db.php";
		//проверяем, был ли передан параметр методом POST
		if (isset($_POST['did']))
		{ 
			$did=$_POST["did"];
			$dname=$_POST["dname"];
			
			$r=mysql_query("INSERT INTO dep (id_dep, name_dep) VALUES ($did, '$dname')");
			if (mysql_error()) echo mysql_error();
			else echo "Added";

		}

		if (isset($_POST['gid']))
		{ 
			$gid=$_POST["gid"];
			$gname=$_POST["gname"];
			$gdep=$_POST["gdep"];
			
			$r=mysql_query("INSERT INTO grup (id_grup, name_gr, id_dep) VALUES ($gid, '$gname', $gdep)");
			if (mysql_error()) echo mysql_error();
			else echo "Added";
		}

		if (isset($_POST['sid']))
		{ 
			$sid=$_POST["sid"];
			$sname=$_POST["sname"];
			$sgrup=$_POST["sgrup"];
			$syear=$_POST["syear"];
			
			$r=mysql_query("INSERT INTO student (id_student, name_student, id_grup, year) VALUES ($sid, '$sname', $sgrup, $syear)");
			
			$r=mysql_query("SELECT * FROM grup JOIN student ON grup.id_grup=student.id_grup WHERE name_gr = '$s1'");
			if (mysql_error()) echo mysql_error();
			else echo "Added";
		}
	?>
</body>