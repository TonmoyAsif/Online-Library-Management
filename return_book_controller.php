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
	$var1 = $_POST["username"];

	$query = OCIParse($conn, "select * from admin_table where USERNAME=:dato1");
	OCIBindByName($query, ":dato1", $var1);
	OCIExecute($query, OCI_DEFAULT);
	/*while (OCIFetch($query)){
		echo "USERNAME ---->".ociresult($query, "USERNAME").
		"<br>PASSWORD->".ociresult($query, "PASSWORD").
		"<br><br>";
	}*/
if (OCIFetch($query).length>0)
	{
	$username = ociresult($query,"USERNAME");
	$_SESSION['username']= $username;

	header("location:return_book.php");
	}
	else
	{	$_SESSION['book_return_error']='error';
		header("location:return_book.php");
	}

	?>
	