<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>


<?php
	require "connection.php";
	$conn = OCILogon($user, $pass, $db);
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$query = OCIParse($conn, "DELETE from book_table where ID = (:dato1)");
        OCIBindByName($query, ":dato1", $id);
		OCIExecute($query, OCI_DEFAULT);
	    OCICommit($conn);
	    OCILogoff($conn);
		echo "<meta http-equiv='refresh' content='0;url=book_list.php'>";
	}
?>