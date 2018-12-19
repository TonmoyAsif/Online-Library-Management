<?php 
session_start();
if(isset($_SESSION['type'])!='user')
{  
   header("location:index.php");
}
?>

        <html>
    <head>
    	<title>Issued Books</title>
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
	$username=$_SESSION['username'];
	$query = OCIParse($conn, "select * from view_issued_book where USER_NAME=:dato1");
	OCIBindByName($query, ":dato1", $username);
	OCIExecute($query, OCI_DEFAULT);
	?>
	<table width="600" border="1" cellpadding="1" cellspacinf="1" id="customers">
	             <tr>
                    <th>Book Name</th>
                    <th>Book Author</th>
                    <th>Borrow</th>
					<th>Return</th>
					<th>Status</th>
                </tr>
<?php
	while (OCIFetch($query)){
		echo"<tr>";
		echo"<td>".ociresult($query, "BOOK_NAME")."</td>";
		echo"<td>".ociresult($query, "BOOK_AUTHOR")."</td>";
		echo"<td>".ociresult($query, "BORROW")."</td>";
		echo"<td>".ociresult($query, "RETURN")."</td>";
		echo"<td>".ociresult($query, "STATUS")."</td>";
	}
	?>
	</table>
	<div><a href="user_home.php" class="already">Back</a></div>
<?php
	OCICommit($conn);
	OCILogoff($conn);
?>
</body>
</html>