<body>
	<p>DB work</p>
	<form action=view_table.php method="post" >
	Enter table name: <input size='15' name='p1' type='text' value=''>
	</form>
	<?php
        require_once "db.php";

		//проверяем, был ли передан параметр методом POST
		if (isset($_POST['p1']))
		{ 
			$s1=$_POST["p1"];//заносим значение параметра в переменную
			
			echo "<p>Table $s1</p>";
			//выбираем данные из таблицы в переменную r
			$r=mysql_query("select * from $s1 ");
			if ($r==null) {
				echo "Error: table doesn't exist<br>"; 
				exit;
			}
			
			echo "<table width='50%' border='1' cellpadding='0' cellspacing='0'>";
			$nf=mysql_num_fields($r);//количество полей в запросе
			echo "<tr align='center'>";
			for ($j=0; $j<$nf;$j++)
			{ 
				$a=mysql_field_name($r,$j);//выводим имена столбцов
				echo "<td>$a</td>";
			}
			echo "</tr>";
			//вывод осуществляется построчно
			for ($i=0; $i< mysql_num_rows($r); $i++)
			{
				echo "<tr align='center'>";
				$f=mysql_fetch_array($r);//данные из одной строки заносятся в переменную f
				for ($j=0; $j<$nf;$j++)
				{
					$a=mysql_field_name($r,$j);//значение поля заносится в переменную а
					echo "<td>$f[$a]</td>";
				}
				echo "</tr>";
			}
		}
	?>
</body>