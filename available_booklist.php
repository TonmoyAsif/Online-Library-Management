<?php 
session_start();
if(isset($_SESSION['type'])!='user')
{  
   header("location:index.php");
}
?>

        <html>
    <head>
    	<title>Available Books</title>
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
	<?php
	}
	?>
	</table>
<?php
	OCICommit($conn);
	OCILogoff($conn);
?>
</body>
</html>