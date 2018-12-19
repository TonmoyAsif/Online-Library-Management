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
	$var2 = $_POST["password"];
	$var3 = $_POST["name"];
	$var4 = $_POST["email"];
	$var5 = 'user';
    
	$query_find=OCIParse($conn, "select * from admin_table where username=:datox");
	OCIBindByName($query_find, ":datox", $var1);
	OCIExecute($query_find, OCI_DEFAULT);
	if (OCIFetch($query_find).length>0)
	{
		$_SESSION['user_exist']='exist';
		header("location:add_user.php");
	}
	else{
	/*$query = OCIParse($conn, "insert into admin_table values (seq_admin.nextval,:dato1, :dato2, :dato3, :dato4, :dato5)");
	OCIBindByName($query, ":dato1", $var1);
	OCIBindByName($query, ":dato2", $var2);
	OCIBindByName($query, ":dato3", $var3);
	OCIBindByName($query, ":dato4", $var4);
	OCIBindByName($query, ":dato5", $var5);
	OCIExecute($query, OCI_DEFAULT);
	
	OCICommit($conn);
	OCILogoff($conn);*/

$sql = 'BEGIN procedure_add_user(:dato2, :dato3, :dato4, :dato5,:dato6, :output); END;';

$query = OCIParse($conn,$sql);

//  Bind the input parameter
OCIBindByName($query, ":dato2", $var1,32);
OCIBindByName($query, ":dato3", $var2,32);
OCIBindByName($query, ":dato4", $var3,32);
OCIBindByName($query, ":dato5", $var4,32);
OCIBindByName($query, ":dato6", $var5,32);
// Bind the output parameter
OCIBindByName($query,':output',$message,32);

// Assign a value to the input 


OCIExecute($query);

	/*while (OCIFetch($query)){
		echo "USERNAME ---->".ociresult($query, "USERNAME").
		"<br>PASSWORD->".ociresult($query, "PASSWORD").
		"<br><br>";
	}*/

	header("location:admin_home.php");
}

?>