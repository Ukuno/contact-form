<?php
	//message vars
	$msg='';
	$msgClass='';
	//check for submit
	if(filter_has_var(INPUT_POST, 'submit')){
		//Get form data
		$name=htmlspecialchars($_POST['name']);
		$email=htmlspecialchars($_POST['email']);
		$message=htmlspecialchars($_POST['message']);

		//check required field
		if(!empty($email) && !empty($name) && !empty($message)){
			//passed
			//checked email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				//falied
				$msg='Please fill in valid Email';
				$msgClass='alert-danger';	
			}
			else{
				//passed
				$toEmail='';
				$subject='contact Request From'.$name;
				$body = '<h2> Contact Request</h2>
				<h4>Name</h4><p>'.$name.'</p>
				<h4>Email</h4><p>'.$email.'</p>
				<h4>Message</h4><p>'.$message.'</p>';

				//Email headers
				$headers="MIME-Version: 1.0" ."\r\n";
				$headers.="Content-Type:text/html;charset=UTF-8" . "\r\n";

				//additional headers
				if(mail($toEmail, $subject, $body, $headers)){
					//Email sent
					$msg = 'Your Email is sent ';
					$msgClass = 'alert-success';
				}
				else{
					//Failed
					$msg = 'Your email is not sent ';
					$msgClass = 'alert-danger';

				}
			}
		}
		else
		{
			//failed
			$msg='Please fill in all the fields';
			$msgClass='alert-danger';
		}
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>contact us</title>
	<link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">My website</a>
		</div>
	</div>
</nav>
<div class="container">
	<?php if($msg != ''):?>
		<div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
	<?php endif; ?>	
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	 <div class="form-group">
	 	<label>
	 		Name
	 	</label>
	 	<input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
	 </div>
	 <div class="form-group">
	 	<label>
	 		Email
	 	</label>
	 	<input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
	 </div>
	 <div>
	 	<label>
	 		Message
	 	</label>
	 	<textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
	 </div>
	 <br>
	 <button type="submit" name="submit" class="btn btn-primary">submit</button>
</form> 
</div>

</body>
</html>