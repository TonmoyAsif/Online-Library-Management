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
			Add Book
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
		                    	<form action="add_book_controller.php" method="post">
				                        <h2 class="text-center"><strong>Add </strong>Book.</h2>
				                        <?php 
						                session_start();

						                if(isset($_SESSION['book_add_error'])=='error')
						                {  echo '<p style="margin-left:80px;">'.'Please Fill out all the Blanks!!'.'</p>';
						                    //header('location: index.php');
						                    unset($_SESSION['book_add_error']);
						                 }
						                ?>
				                        <div class="form-group"><input class="form-control" type="hidden" name="id"  placeholder="Book ID" autofocus="" required=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="name"  placeholder="Book Name" required=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="author"  placeholder="Book Author" required=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="category"  placeholder="Book Category" required=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="quantity"  placeholder="Book Quantity" required=""></div>
				                     
				                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(7,55,108);">Add</button></div><a href="admin_home.php" class="already">Back</a>
		                    	</form>
               				 </div>
           			 </div>
		
	</body>
</html>