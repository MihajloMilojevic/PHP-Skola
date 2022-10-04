<?php 
	session_start();
?>

<!DOCTYPE html>
<html lang="sr-RS">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="./LOGO.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<title>Zadatak 7</title>
</head>
<body>
	<?php 
		$to_email = "milojevicm374@gmail.com";
		$subject = "Test email to send from XAMPP";
		$body = "Hi, This is test mail to check how to send mail from Localhost Using Gmail ";
		//$headers = "From: sender email";
		 
		if (mail($to_email, $subject, $body))
		 
		{
			echo "Email successfully sent to $to_email...";
		}
		 
		else
		 
		{
			echo "Email sending failed!";
		}
	?>
</body>
	
</html>