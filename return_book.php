<?php session_start(); ?>

<html>
	<head>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
	    <link rel="stylesheet" href="assets/css/bdtourinfo_login_form_v2.css">
		<title>
			Return Book
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
		               		 <div class="form-container" style="max-width: 1100px;">
		                    	<form action="return_book_controller.php" method="post">
				                        <h2 class="text-center"><strong>Return </strong>Book.</h2>

				                        <?php 
						                session_start();

						                if(isset($_SESSION['book_return_error'])=='error')
						                {  echo '<p style="margin-left:80px;">'.'Wrong USER Name'.'</p>';
						                    //header('location: index.php');
						                    unset($_SESSION['book_return_error']);
						                 }
						                ?>

				                        <div class="form-group"><input class="form-control2" type="text" name="username" required="" placeholder="User Name" autofocus=""> <button class="what btn btn-primary" type="submit" style="background-color: rgb(7,55,108);">Search</button></div>
				                        
	<?php
	include ("connection.php");
	$conn = OCILogon($user, $pass, $db);

if (!$conn){
		echo "Invalid" . var_dump ( OCIError() );
		die();
	}



	$username = $_SESSION['username'];
	$query = OCIParse($conn, "select * from admin_table where USERNAME=:dato1");
	OCIBindByName($query, ":dato1", $username);
	OCIExecute($query, OCI_DEFAULT);
	while (OCIFetch($query)){
		echo "Name: ".ociresult($query, "NAME")."<br/>"; 
		echo "Email: ".ociresult($query, "EMAIL");
		//echo"<td>".ociresult($query, "QUANTITY")."</td>";
	}
	OCICommit($conn);
	OCILogoff($conn);


	?>
	
	
				                        <a href="admin_home.php" class="already"></a>
		                    	</form>
                                <?php if(isset($_SESSION['username'])){ ?>
		                    	<form method="post">
				                        <h2 class="text-center"><strong>Details</strong></h2>
				                        <a href="admin_home.php" class="already">Back</a>
				                  <?php 
				                  	include ("connection.php");
	                                $conn = OCILogon($user, $pass, $db);
				                  $name=$_SESSION['username'];

	                                  $query = OCIParse($conn, "select * from book_lend where USER_NAME=:dato2");
	                                   OCIBindByName($query, ":dato2", $name);
	                                  OCIExecute($query, OCI_DEFAULT); 
	                                ?>
	             <table width="700" border="1" cellpadding="1" cellspacinf="1" id="customers">
	             <tr>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Borrow</th>
					<th>Return</th>
					<th>Status</th>
					<th>Action</th>
                </tr>
<?php
	       while (OCIFetch($query)){
		echo"<tr>";
		echo"<td>".ociresult($query, "BOOK_NAME")."</td>";
		$bookname= ociresult($query,"BOOK_NAME");
		$usssname = ociresult($query, "USER_NAME");
		$bookid= ociresult($query,"BOOK_ID");
		$_SESSION['bookname']=$bookname;
		//echo $bookname;
		echo"<td>".ociresult($query, "BOOK_AUTHOR")."</td>";
		echo"<td>".ociresult($query, "BORROW")."</td>";
		echo"<td>".ociresult($query, "RETURN")."</td>";
		echo"<td>".ociresult($query, "STATUS")."</td>"; ?>
		<td><a href="return_delete.php?del=<?php echo $usssname;?>&bookid=<?php echo $bookid;?>">Delete</a> </td>

		<?php
	}
	?>
	</table>
<?php
	OCICommit($conn);
	OCILogoff($conn);
}
?>
		                    	</form>
               				 </div>
           			 </div>
		
	</body>
</html>

<?php
unset ($_SESSION["username"]);
?>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
.already {
  display: block;
  text-align: center;
  font-size: 12px;
  color: #6f7a85;
  opacity: 0.9;
  text-decoration: none;
  padding-top: 20px;
  font-size: 18px;
}
</style>