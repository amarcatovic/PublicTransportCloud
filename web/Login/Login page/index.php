<!DOCTYPE html>
<html>
<head>
	<title>Login - ATPT</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/blue.png">
	<div class="container">
		<div class="img">
			<img src="img/man.svg">
		</div>
		<div class="login-content">
			<form id="login-form" action="web_login.php" method="post">
				<img src="img/logo.svg">
				<h2 class="title">Zdravo</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Email</h5>
           		   		<input id="email-input" type="email" class="input" name="email">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input id="password-input" type="password" class="input" name="password">
            	   </div>
            	</div>
				<button class="btn" onclick="login()">PRIJAVI SE</button>
				<p id="error"></p>
            </form>
        </div>
    </div>
	<script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</body>
</html>
