<?php 
session_start();
if(isset($_SESSION['type'])!='admin')
{  
   header("location:index.php");
}
?>


		<html>
	<head>
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
	    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
	    <link rel="stylesheet" href="assets/css/bdtourinfo_login_form_v1.css">
	    <link rel="stylesheet" href="assets/css/bdtourinfo_admin_panel_button_v1-1.css">
        <link rel="stylesheet" href="assets/css/bdtourinfo_admin_panel_button_v1.css">
		<title>
			Index|Library Management
		</title>
	</head>
	<body>
		 <div class="register-photo">
		               		 <div class="form-container" style="max-width: 500px;">
		                    	<!-- <form action="login.php" method="post">
				                        <h2 class="text-center"><strong>Employee </strong>Information.</h2>
				                        <div class="form-group"><input class="form-control" type="text" readonly name="user" value= "<?php echo('Name        '.ociresult($query, 'NAME')) ?>"></div>
				                        <div class="form-group"><input class="form-control" type="text" readonly name="user" value= "<?php echo('ID              '.ociresult($query, 'EMP_ID')) ?>"></div>
				                        <div class="form-group"><input class="form-control" type="text" readonly name="user" value= "<?php echo('Password   '.ociresult($query, 'PASSWORD')) ?>"></div>
				                        <div class="form-group"><input class="form-control" type="text" readonly name="user" value= "<?php echo('Rank          '.ociresult($query, 'RANK')) ?>"></div>
				                        <a href="index.php" class="already">Logout</a>
				                       

				                   
		                    	</form> -->

		<div class="d-flex flex-row justify-content-center" style="margin-top: 10px;margin-bottom: 10px;margin-right: 3px;margin-left: 3px;">
        <div class="row">
            <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="book_list.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Book List</span></a>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="add_book.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Add Book</span></a>
                </div>
            </div>
             <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="issue_book.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Issue Book</span></a>
                </div>
            </div>
              <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="add_user.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Register User</span></a>
                </div>
            </div>
             <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="user_list.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">User List</span></a>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="return_book.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Return Book</span></a>
                </div>
            </div>
            <div class="col-12 d-flex justify-content-center col-sm-12 col-md-4">
                <div class="d-flex justify-content-center align-items-center cls_admin_button_div">
                    <a class="btn btn-primary btn-block d-flex flex-column justify-content-center align-items-center icon-button" role="button" href="logout.php" data-bs-hover-animate="pulse" style="background-color: rgb(14,58,105);margin-top: 0px;"><i class="fa fa-eye d-flex" style="font-size: 26px;"></i><span class="d-flex">Logout</span></a>
                </div>
            </div>
        </div>
    </div>


               				 </div>
           			 </div>

      </body>
</html>

