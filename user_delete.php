<?php
	require "connection.php";
	$conn = OCILogon($user, $pass, $db);
 
	if( isset($_GET['del']) )
	{
		$id = $_GET['del'];
		$query = OCIParse($conn, "DELETE from admin_table where USERNAME = (:dato1)");
        OCIBindByName($query, ":dato1", $id);
		OCIExecute($query, OCI_DEFAULT);
	    OCICommit($conn);
	    OCILogoff($conn);
		echo "<meta http-equiv='refresh' content='0;url=user_list.php'>";
	}
?>