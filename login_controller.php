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
	$var1 = $_POST["user"];
	$var2 = $_POST["pass"];

	$query = OCIParse($conn, "select * from admin_table where username=:dato1 and password=:dato2");
	OCIBindByName($query, ":dato1", $var1);
	OCIBindByName($query, ":dato2", $var2);
	OCIExecute($query, OCI_DEFAULT);


/*$sql = 'BEGIN procedure_login(:dato1, :dato2); END;';

$query2 = OCIParse($conn,$sql);

OCIBindByName($query2, ":dato1", $var1,32);
OCIBindByName($query2, ":dato2", $var2,32);

OCIExecute($query2);*/



	/*while (OCIFetch($query)){
		echo "USERNAME ---->".ociresult($query, "USERNAME").
		"<br>PASSWORD->".ociresult($query, "PASSWORD").
		"<br><br>";
	}*/
if (OCIFetch($query).length>0)
	{
	$type = ociresult($query,"TYPE");

	if($type == 'admin'){
	$_SESSION['type']='admin';
	header("location:admin_home.php");}
	else if($type == 'user'){
		$_SESSION['type']='user';
		$username1 = ociresult($query,"USERNAME");
		$_SESSION['username']=$username1;
	header("location:user_home.php");
	}
}
else
{

$_SESSION['wrong']='wrong';
header("location:index.php");

}




	?>
	