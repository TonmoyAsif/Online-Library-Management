<?php
session_start();
	if( isset($_POST['submit']) )
	{
			require "connection.php";
	       $conn = OCILogon($user, $pass, $db);

		$name = $_POST['name'];
		$author = $_POST['author'];
		$category = $_POST['category'];
		$quantity = $_POST['quantity'];
		$id= $_POST['id'];
		if($name == "" || $author == "" || $category == "" || $quantity == "" )
		{
			 $_SESSION['book_edit_error']='error';
			header('location: book_edit.php?edit='.$id);
		}
		else
		 {
			 /*$query = OCIParse($conn, "UPDATE book_table SET NAME=:dato1,AUTHOR=:dato2,CATEGORY=:dato3,QUANTITY=:dato5 WHERE ID=:dato4");
			 OCIBindByName($query, ":dato1", $name);
			 OCIBindByName($query, ":dato2", $author);
			 OCIBindByName($query, ":dato3", $category);
			 OCIBindByName($query, ":dato4", $id);
			 OCIBindByName($query, ":dato5", $quantity);
			 if(OCIExecute($query, OCI_DEFAULT))
			 {
				 header("location: book_list.php");
			 }
*/
			$sql = 'BEGIN procedure_edit_book(:dato1, :dato2, :dato3 , :dato5 , :dato4); END;';
			$query = OCIParse($conn,$sql);
			OCIBindByName($query, ":dato1", $name,32);
			OCIBindByName($query, ":dato2", $author,32);
			OCIBindByName($query, ":dato3", $category,32);
			OCIBindByName($query, ":dato5", $quantity,32);
			OCIBindByName($query, ":dato4", $id,32);

			if(OCIExecute($query, OCI_DEFAULT))
			 {
				 header("location: book_list.php");
			 }

		 }
		
	}
	OCICommit($conn);
	OCILogoff($conn);
?>