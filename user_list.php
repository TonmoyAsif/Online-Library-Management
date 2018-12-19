<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>

<html>
<head>
	<title>User List</title>
<style>
#customers {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
.already {
  display: block;
  text-align: center;
  font-size: 12px;
  color: #6f7a85;
  opacity: 0.9;
  text-decoration: none;
  padding-top: 20px;
  font-size: 18px;
}
</style>
</head>
<body>


<?php
	include ("connection.php");
	
	$conn = OCILogon($user, $pass, $db);	
	if (!$conn){
		echo "Invalid Connection" . var_dump ( OCIError() );
		die();
	}
	$query = OCIParse($conn, "select * from admin_table where TYPE='user'");
	OCIExecute($query, OCI_DEFAULT);

	
	?>
	<table width="600" border="1" cellpadding="1" cellspacinf="1" id="customers">
	             <tr>
	             	<th>Serial</th>
                    <th>User Name</th>
                    <th>Name</th>
                    <th>Email</th>
					<th>Type</th>
					<th>Lend Count</th>
					<th>Action</th>
                </tr>
<?php
	while (OCIFetch($query)){
		echo"<tr>";
		echo"<td>".ociresult($query, "SERIAL")."</td>";
		echo"<td>".ociresult($query, "USERNAME")."</td>";
		echo"<td>".ociresult($query, "NAME")."</td>";
		echo"<td>".ociresult($query, "EMAIL")."</td>";

		$_SESSION['book_cnt']=0;
	$userx=ociresult($query, "USERNAME");

	$query_count = OCIParse($conn, "select * from user_borrow_count");
	OCIExecute($query_count, OCI_DEFAULT);
		while (OCIFetch($query_count)){
			if(ociresult($query_count, "USERNAME") == $userx && ociresult($query_count, "BOOK_ID") != null)
			{
				//$book_count= $book_count+1;
				$_SESSION['book_cnt']=$_SESSION['book_cnt']+1;

			}

		}



		echo"<td>".ociresult($query, "TYPE")."</td>";
		echo"<td>".$_SESSION['book_cnt']."</td>";

		?>
		<td><a href="user_delete.php?del=<?php echo ociresult($query, "USERNAME");?>">Delete</a> &nbsp <a href="user_edit.php?edit=<?php echo ociresult($query, "USERNAME");?>">Edit</a> </td>
	<?php
	}
	?>
	</table>
	<div><a href="admin_home.php" class="already">Back</a></div>
<?php
	OCICommit($conn);
	OCILogoff($conn);
?>
</body>
</html>