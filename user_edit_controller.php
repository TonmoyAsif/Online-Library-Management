<?php
session_start();
	if( isset($_POST['submit']) )
	{
			require "connection.php";
	       $conn = OCILogon($user, $pass, $db);

		$name = $_POST['name'];
		$email = $_POST['email'];
		$username= $_POST['username'];
		if($name == "" || $email == "")
		{
			$_SESSION['user_edit_error']='error';
			header('location: user_edit.php?edit='.$username);
		}
		else
		 {
			 /*$query = OCIParse($conn, "UPDATE admin_table SET NAME=:dato1,EMAIL=:dato2 WHERE USERNAME=:dato3");
			 OCIBindByName($query, ":dato1", $name);
			 OCIBindByName($query, ":dato2", $email);
			 OCIBindByName($query, ":dato3", $username);
			 if(OCIExecute($query, OCI_DEFAULT))
			 {
				 header("location: user_list.php");
			 }*/

			 $sql = 'BEGIN procedure_edit_user(:dato1, :dato2, :dato3); END;';

				$query = OCIParse($conn,$sql);

				//  Bind the input parameter
				OCIBindByName($query, ":dato1", $name,32);
				OCIBindByName($query, ":dato2", $email,32);
				OCIBindByName($query, ":dato3", $username,32);
			

				// Bind the output parameter
				

				// Assign a value to the input 

				if(OCIExecute($query))
			 {
				 header("location: user_list.php");
			 }
				

		 }
		
	}
	OCICommit($conn);
	OCILogoff($conn);
?>