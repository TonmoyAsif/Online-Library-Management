<?php	
	session_start();
	include ("connection.php");
	


$conn = OCILogon($user, $pass, $db);
	
	if (!$conn){
		echo "Invalid" . var_dump ( OCIError() );
		die();
	}
	/*else
	{
		echo"Insert Success";
	}
	
	$var1 = $_POST["user"];
	$var2 = $_POST["pass"];
	
	$query = OCIParse($conn, "insert into TUTORIAL values (:dato1, :dato2)");
	OCIBindByName($query, ":dato1", $var1);
	OCIBindByName($query, ":dato2", $var2);
	OCIExecute($query, OCI_DEFAULT);
	
	OCICommit($conn);
	OCILogoff($conn);
*/
	$book_id = $_POST["book_id"];
	$user_id = $_POST["user_id"];
	$return_date = $_POST["return_date"];


	$query_get_book = OCIParse($conn, "select * from book_table where ID=:dato1");
	OCIBindByName($query_get_book, ":dato1", $book_id);
	OCIExecute($query_get_book, OCI_DEFAULT);

	if (OCIFetch($query_get_book).length>0)
	{
	
	//$book_name = ociresult($query_get_book,"NAME");
	//$book_author = ociresult($query_get_book,"AUTHOR");
	$_SESSION['book_name']=ociresult($query_get_book,"NAME");
	$_SESSION['book_author']=ociresult($query_get_book,"AUTHOR");
	$_SESSION['book_quantity']=ociresult($query_get_book,"QUANTITY");

	
}

	
	
	$query = OCIParse($conn, "insert into book_lend values (:dato1, :dato2, :dato3, :dato4, SYSDATE, :dato6, 'borrowed')");
	OCIBindByName($query, ":dato1", $book_id);
	OCIBindByName($query, ":dato2", $_SESSION['book_name']);
	OCIBindByName($query, ":dato3", $_SESSION['book_author']);
	OCIBindByName($query, ":dato4", $user_id);
	OCIBindByName($query, ":dato6", $return_date);
	OCIExecute($query, OCI_DEFAULT);

			$quantity = $_SESSION['book_quantity']-1;
			$query_del = OCIParse($conn, "UPDATE book_table SET QUANTITY=:dato1 WHERE ID=:dato2");
			 OCIBindByName($query_del, ":dato1", $quantity);
			 OCIBindByName($query_del, ":dato2", $book_id);
			 if(OCIExecute($query_del, OCI_DEFAULT))
			 {
				header("location:admin_home.php");
			 }
	
	OCICommit($conn);
	OCILogoff($conn);

	

?>