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
	    <link rel="stylesheet" href="assets/css/bdtourinfo_login_form_v2.css">
		<title>
			Issue Book
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
		               		 <div class="form-container" style="max-width: 900px;">
		                    	<form action="issue_book_controller.php" method="post">
				                        <h2 class="text-center"><strong>Issue </strong>Book.</h2>

				                        <?php 
						                session_start();

						                if(isset($_SESSION['book_id_error'])=='error')
						                {  echo '<p style="margin-left:80px;">'.'Wrong Book ID'.'</p>';
						                    //header('location: index.php');
						                    unset($_SESSION['book_id_error']);
						                 }
						                ?>

				                        <div class="form-group"><input class="form-control2" type="text" name="book_id" required="" placeholder="Book ID" autofocus=""> <button class="what btn btn-primary" type="submit" style="background-color: rgb(7,55,108);">Search</button></div>
				                        
	<?php
	include ("connection.php");
	$conn = OCILogon($user, $pass, $db);

if (!$conn){
		echo "Invalid" . var_dump ( OCIError() );
		die();
	}


	if(isset($_SESSION['book_id']))
{  
	$book_id2 = $_SESSION['book_id'];
	$query = OCIParse($conn, "select * from book_table where ID=:dato1");
	OCIBindByName($query, ":dato1", $book_id2);
	OCIExecute($query, OCI_DEFAULT);
	while (OCIFetch($query)){
		echo "Name: ".ociresult($query, "NAME")."<br/>"; 
		echo "Author: ".ociresult($query, "AUTHOR")."<br/>";
		echo "Category: ".ociresult($query, "CATEGORY")."<br/>";
		echo "Quantity: ".ociresult($query, "QUANTITY")."<br/>";
		//echo"<td>".ociresult($query, "QUANTITY")."</td>";
	}
	OCICommit($conn);
	OCILogoff($conn);
}


	?>
	
	
				                        <a href="admin_home.php" class="already"></a>
		                    	</form>

		                    	<form action="issue_book_lend_controller.php" method="post">
				                        <h2 class="text-center"><strong>Details</strong></h2>
				                        <div class="form-group"><input class="form-control" type="text" name="book_id" required="" placeholder="Book ID" value="<?php if(isset($_SESSION['book_id'])) {  echo $_SESSION['book_id']; } ?> " autofocus=""></div>
				                        <div class="form-group"><input class="form-control" type="text" name="user_id" required="" placeholder="User ID" ></div>
				                        <div class="form-group"><input class="form-control" type="text" name="return_date" required="" placeholder="Return Date" ></div>
				                        
				                        
				                     
				                        <div class="form-group"><button class="btn btn-primary btn-block" type="submit" style="background-color: rgb(7,55,108);">Issue</button></div><a href="admin_home.php" class="already">Back</a>
		                    	</form>
               				 </div>
           			 </div>
		
	</body>
</html>

<?php
unset ($_SESSION["book_id"]);
?>
