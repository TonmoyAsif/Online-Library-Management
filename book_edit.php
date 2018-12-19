<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>

<html>
<head>
    <title>Edit Book</title>
<style>
body{
    margin: 0;
    padding: 0;
    background: url(post.jpg);
	background-color:rgb(255, 255, 204);
    background-size: cover;
    background-position: center;
    font-family: sans-serif;
}
.login-box{
    width: 520px;
    height: 500px;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;
}
.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top: -50px;
    left: calc(50% - 50px);
}
h1{
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
    font-size: 22px;
}
.login-box p{
    margin: 0;
    padding: 0;
    font-weight: bold;
}
.login-box input{
    width: 100%;
    margin-bottom: 20px;
}
.login-box input[type="text"], input[type="password"],[type="email"]
{
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}
.login-box input[type="submit"]
{
    border: none;
    outline: none;
    height: 40px;
    background: #1c8adb;
    color: #fff;
    font-size: 18px;
    border-radius: 20px;
}
.login-box input[type="submit"]:hover
{
    cursor: pointer;
    background: #39dc79;
    color: #000;
}

.login-box a{
    text-decoration: none;
    font-size: 14px;
    color: #fff;
}
.login-box a:hover
{
    color: #39dc79;
}
</style>
</head>
<body>
<?php
	if(isset($_GET['status'])){
		$status = $_GET['status'];
		/*if($status == "error"){
			//echo "Error update!!Fill up all fields!";
            $_SESSION['book_edit_error']='error';
		}*/
	}
	require "connection.php";
	$conn = OCILogon($user, $pass, $db);
	$id=$_GET['edit'];
	$query = OCIParse($conn, "select * from book_table where ID=:dato1");
	OCIBindByName($query, ":dato1", $id);
	OCIExecute($query, OCI_DEFAULT);
	while(OCIFetch($query))
	{
		//echo ociresult($query, "AUTHOR");
		?>
      <!DOCTYPE html>
     <html>
     <head>
	<title>Edit</title>
	
     </head>
     <body>
                
      <form method="post" action="book_edit_controller.php" class="login-box">
        <?php 
                session_start();

                if(isset($_SESSION['book_edit_error'])=='error')
                {  echo '<p style="margin-left:80px;">'.'Please Fill out all the Blanks!!'.'</p>';
                    //header('location: index.php');
                    unset($_SESSION['book_edit_error']);
                 }
                ?>
	  <input type="hidden" name="id" value ="<?php echo ociresult($query, "ID")?>"/>
	<p>Name</p>
	<input type="text" name="name" value="<?php echo ociresult($query, "NAME")?>" required="">
	<p>Author</p>
	<input type="text" name="author" value="<?php echo ociresult($query, "AUTHOR")?>" required="">
	<p>Category</p>
	<input type="text" name="category" value="<?php echo ociresult($query, "CATEGORY")?>" required="">
	<p>Quantity</p>
	<input type="text" name="quantity" value="<?php echo ociresult($query, "QUANTITY")?>" required="">
	<br/> <br/>
	<input type="submit" name="submit" value="Update">
    <center><a href="book_list.php" class="already">Back</a></center>
     </form>
    </body>
   </html>
<?php		
	}
	OCICommit($conn);
	OCILogoff($conn);
?>

</body>
</html>