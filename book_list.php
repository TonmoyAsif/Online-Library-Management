<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>

<html>
<head>
	<title>Book List</title>
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
	$query = OCIParse($conn, "select * from view_book_table");
	OCIExecute($query, OCI_DEFAULT);
	?>
	<table width="600" border="1" cellpadding="1" cellspacinf="1" id="customers">
	             <tr>
				    <th>Id</th>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Category</th>
					<th>Quantity</th>
					<th>Action</th>
                </tr>
<?php
	while (OCIFetch($query)){
		echo"<tr>";
		echo"<td>".ociresult($query, "ID")."</td>";
		echo"<td>".ociresult($query, "NAME")."</td>";
		echo"<td>".ociresult($query, "AUTHOR")."</td>";
		echo"<td>".ociresult($query, "CATEGORY")."</td>";
		echo"<td>".ociresult($query, "QUANTITY")."</td>";
		?>
		<td><a href="book_delete.php?del=<?php echo ociresult($query, "ID");?>">Delete</a> &nbsp <a href="book_edit.php?edit=<?php echo ociresult($query, "ID");?>">Edit</a> </td>
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