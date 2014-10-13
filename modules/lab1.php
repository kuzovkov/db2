<?php
require_once('db.func.php');

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset']) && isset($_POST['dump']))
{
	dbCreate($_POST['dump'],true);
}

$error = '';
//print_r($tables);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Лабораторная работа №1 по БД</title>
	<link rel="stylesheet" href="../css/style.lab1.css"/>
</head>
<body>

<h1><a href="../">На главную</a></h1>
<div class="query">
	<form action="" method="post" >
		<label>SQL: </label>
		<textarea name="query" cols="60" rows="4"><?=(isset($_POST['query']))? $_POST['query'] : '' ?></textarea>
		<input type="hidden" name="sql" value="1"/>
		<button>Ok</button>
	</form>

</div>
<hr/>

<h1>Результаты запроса: <span><?=(isset($_POST['query']))? $_POST['query'] : '' ?></span></h1>

<div class="results">
	<?php 
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query']) && isset($_POST['sql']))
		{
			$res = dbGetQueryResult($_POST['query']);
			
			if ( $res === true )
			{
				echo 'Успешно';
			}
			elseif( $res === false )
			{
				echo 'Ошибка';
				$error = mysql_error();
			}
			else
			{
				?>
				<table>
				<?php $first = true;?>
				<?php foreach( $res as $row ):?>
				<?php if($first): $first = false;?>
					<tr>
					<?php foreach($row as $col_name => $col_val ):?>
						<th><?=$col_name?></th>
					<?php endforeach;?>
					</tr>
				<?php endif;?>
				<tr>
					<?php foreach($row as $col):?>
						<td><?=$col?></td>
					
					<?php endforeach;?>
				</tr>
				<?php endforeach;?>
				</table>
				<?php
			
			}
			
		}
	?>
</div>
<hr/>
<h1>Ошибки: </h1>
<div class="error">
<?=$error?>
</div>
<hr/>
<h1>Таблицы в БД: </h1>
<div class="tables">
<?php
$tables = dbGetTables(dbGetTablesList());
foreach( $tables as $table ):
?>
	
	<div class="table">
	<h1><?=$table['name']?></h1>
	<table>
		<tr>
			<?php foreach( $table['header'] as $header ):?>
				<th><?=$header?></th>
			<?php endforeach;?>
		</tr>
		<?php foreach( $table['data'] as $row ):?>
		<tr>
			<?php foreach( $row as $col ):?>
				<td><?=$col?></td>
			<?php endforeach;?>
		</tr>	
		<?php endforeach;?>
	</table>
	</div>
	
<?php endforeach;?>
</div>
<div class="cls"></div>
<hr/>
<h1>Воссоздание БД из дампа</h1>
<div class="reset">
	<form action="" method="post">
	<label>Выберите файл дампа:</label><br/>
	<select name="dump">
		<?php $list = getDumpfilesList(); foreach($list as $file):?>
			<option value="<?=$file?>"><?=$file?></option>
		<?php endforeach;?>
	</select>
	<input type="hidden" name="reset" value="1"/>
	<button>Ok</button>
	<form>

</div>
<hr/>
<h1><a href="../">На главную</a></h1>
</body>
</html>

