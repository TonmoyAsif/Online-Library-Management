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
	$var1 = $_POST["id"];
	$var2 = $_POST["name"];
	$var3 = $_POST["author"];
	$var4 = $_POST["category"];
	$var5 = $_POST["quantity"];

	if( $var2 == "" || $var3 == "" || $var4 == "" || $var5 == "" )
		{
			 $_SESSION['book_add_error']='error';
			header('location: add_book.php');
		}
	else
		 {

	
	/*$query = OCIParse($conn, "insert into book_table values (seq_book.nextval, :dato2, :dato3, :dato4, :dato5)");
	//OCIBindByName($query, ":dato1", $var1);
	OCIBindByName($query, ":dato2", $var2);
	OCIBindByName($query, ":dato3", $var3);
	OCIBindByName($query, ":dato4", $var4);
	OCIBindByName($query, ":dato5", $var5);
	OCIExecute($query, OCI_DEFAULT);
	
	OCICommit($conn);
	OCILogoff($conn);*/



$sql = 'BEGIN procedure_add_book(:dato2, :dato3, :dato4, :dato5, :output); END;';

$query = OCIParse($conn,$sql);

//  Bind the input parameter
OCIBindByName($query, ":dato2", $var2,32);
OCIBindByName($query, ":dato3", $var3,32);
OCIBindByName($query, ":dato4", $var4,32);
OCIBindByName($query, ":dato5", $var5,32);

// Bind the output parameter
OCIBindByName($query,':output',$message,32);

// Assign a value to the input 


OCIExecute($query);

// $message is now populated with the output value
 //print "$message\n";







	/*while (OCIFetch($query)){
		echo "USERNAME ---->".ociresult($query, "USERNAME").
		"<br>PASSWORD->".ociresult($query, "PASSWORD").
		"<br><br>";
	}*/

	header("location:admin_home.php");
}

?>