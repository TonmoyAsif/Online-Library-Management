<?php session_start();
	require "connection.php";
	$conn = OCILogon($user, $pass, $db);
 
	if( isset($_GET['del']) )
	{
		//$bookname=$_SESSION['bookname'];
		//echo $bookname;
		$id = $_GET['del'];
		//$name=$_SESSION['bookname'];
		$book_id = $_GET['bookid'];

		$query = OCIParse($conn, "DELETE from book_lend where USER_NAME =(:dato1) and BOOK_ID=(:dato2)");
        OCIBindByName($query, ":dato1", $id);
        OCIBindByName($query, ":dato2", $book_id);
		OCIExecute($query, OCI_DEFAULT);
	    


	$queryx = OCIParse($conn, "select * from book_table where ID=$book_id");
	OCIExecute($queryx, OCI_DEFAULT);
	while (OCIFetch($queryx)){
	 $_SESSION['book_quantity']=ociresult($queryx, "QUANTITY");

			$quantity = $_SESSION['book_quantity']+1;
			$query_del = OCIParse($conn, "UPDATE book_table SET QUANTITY=:dato1 WHERE ID=:dato2");
			 OCIBindByName($query_del, ":dato1", $quantity);
			 OCIBindByName($query_del, ":dato2", $book_id);
			 if(OCIExecute($query_del, OCI_DEFAULT))
			 {
				echo "<meta http-equiv='refresh' content='0;url=return_book.php'>";
			 }



	    OCICommit($conn);
	    OCILogoff($conn);
		//unset ($_SESSION["username"]);
		//unset ($_SESSION["bookname"]);
		//unset ($_SESSION["username"]);
		

	}
}
?>