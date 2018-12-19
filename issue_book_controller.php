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
	$var1 = $_POST["book_id"];

	if($var1 == "" )
		{
			 $_SESSION['book_id_error']='error';
			header('location: issue_book.php');
		}
		else
		 {

	$query = OCIParse($conn, "select * from book_table where id=:dato1");
	OCIBindByName($query, ":dato1", $var1);
	OCIExecute($query, OCI_DEFAULT);
	/*while (OCIFetch($query)){
		echo "USERNAME ---->".ociresult($query, "USERNAME").
		"<br>PASSWORD->".ociresult($query, "PASSWORD").
		"<br><br>";
	}*/
if (OCIFetch($query).length>0)
	{
	$id = ociresult($query,"ID");
	$_SESSION['book_id']= $id;

	header("location:issue_book.php");
	}
	else
	{	$_SESSION['book_id_error']='error';
		header("location:issue_book.php");
	}
}

	?>
	