<?php 
session_start();
 ?>

<html>
	<head>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
	    <link rel="stylesheet" href="assets/css/bdtourinfo_login_form_v1.css">
		<title>
			Library Management System
		</title>
	</head>
	<body>
<!-- 		<form action="login.php" method="POST">
			User Name: <br/> <input type="text" name="user"><br/>
			Password: <br/> <input type="password" name="pass"><br/>
			<input type="submit" value="Login">
		</form>
		<br><br><br>		
		
		<a href="userlist.php">See User</a> -->


		                <div class="register-photo">
		               		 <div class="form-container" style="max-width: 500px;">
		                    	<form action="login_controller.php" method="post">
				                        <h2 class="text-center"><strong>Login </strong>into account.</h2>


				                        <?php 
									session_start();

										if(isset($_SESSION['wrong'])=='wrong')
										{  echo '<p style="color:red; margin-left:80px;">'.'Invalid Username or Password!!'.'</p>';
										session_destroy();
										 }
										 ?>

				                        <div class="form-group"><input class="form-control" type="text" name="user" required="" placeholder="ID" autofocus=""></div>
				                        <div class="form-group"><input class="form-control" type="password" name="pass" required="" placeholder="Password" maxlength="20" minlength="4" pattern="[A-Za-z,0-9]{4,20}"></div>
				                        <div class="form-group">
				                            <div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox">Remember me</label></div>
				                        </div>
				                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(7,55,108);">Login</button></div><a href="#" class="already">Forget Your Password? Click Here</a>
		                    	</form>
               				 </div>
           			 </div>
		
	</body>
</html>