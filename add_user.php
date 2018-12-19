<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>


<html>
	<head>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
	    <link rel="stylesheet" href="assets/css/bdtourinfo_login_form_v1.css">
		<title>
			Add User
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
		                    	<form action="add_user_controller.php" method="post">
				                        <h2 class="text-center"><strong>Add </strong>User.</h2>
				                        <?php
				                        if(isset($_SESSION['user_exist'])=='error')
						                {  echo '<p style="margin-left:80px;">'.'Username already Exist'.'</p>';
						                   
						                    unset($_SESSION['user_exist']);
						                 }
						                ?>
				                        <div class="form-group"><input class="form-control" type="text" name="username" required="" placeholder="User Name" autofocus=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="password" required="" placeholder="Password" ></div>
				                        <div class="form-group"><input class="form-control" type="text" name="name" required="" placeholder="Name" ></div>
				                        <div class="form-group"><input class="form-control" type="email" name="email" required="" placeholder="Email"></div>
				                     
				                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(7,55,108);">Add</button></div><a href="admin_home.php" class="already">Back</a>
		                    	</form>
               				 </div>
           			 </div>
		
	</body>
</html>