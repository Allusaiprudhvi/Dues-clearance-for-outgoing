<?php
include '../connection.php';
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

$val=0;
$message="";

$user_name=$_SESSION['user_name'];
if(isset($_POST['delete']))
{
            $password = sha1(sha1($_POST['password']).sha1("mySalt@$#(%"));
            $sql="select * from admins where user_name='$user_name' and password='$password'";
            $result= $conn->query($sql);
            
        if($result->num_rows!=0){
            $query = "delete from student";
            $result = $conn->query($query); 
              if($result==false)
              die($conn->error);     
           
            $query = "update department set uploaded='$val'";
            $result = $conn->query($query); 
              if($result==false)
              die($conn->error);     
           
              $message='deleted data Successfully';
            }
        else{
                $message='Password is Incorrect';
            }
                
}


if (isset($_GET['logout'])) 
{
   // unset($_SESSION['user_name']);
    $_SESSION['status']="NotActive";
        header("location:index.php");

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Data</title>
<?php include 'head.php';?>
</head>

<body>
    
    <header class="header">
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">Academic Office</h1>
    </header> 
  
    <nav>
            <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu</a> 
            
            <ul class="menu">
                <li><a  href="home.php"><i class="fa fa-home"></i>Home</a></li>
                <li><a  href="#"><i class="fa fa-refresh"></i>Reset-Password</a>
                <ul class="sub-menu">
                <li><a href="reset_stu_password.php">student</a></li>
                <li><a href="reset_dept_password.php">Department</a></li>
                </ul>
                </li>
                <li><a  href="#"><i class="fa fa-cog"></i>Department-Settings</a>
                <ul class="sub-menu">
                <li><a href="add_department.php">Add Department</a></li>
                <li><a href="department_details.php">Department's status</a></li>
                </ul>
                </li>
                <li><a  class="homer" href="delete.php"><i class="fa fa-trash-o"></i> Reset</a></li>
                <li><a id="prof" href="#"><i class="fa fa-user"></i>Account-Settings</a>                
                <ul class="sub-menu">
                <li><a href="change_password.php"><i class="fa fa-lock"></i>Change Password</a></li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
                </li>
            </ul>
    </nav>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script  src="../dist/script.js"></script>

	<!-- main -->
	 
	<div class="main-agile">
		<div class="content">
			<div class="top-grids">
						
					<div class="signin-form reset-password">
						<h3>Re-enter the password</h3>
			                         <form action="" method="post">	
				                  <p style="float:red;color: red"><?php echo $message;?></h3>
						  <input type="password" name="password" placeholder="Password" required="">	 
                                                  <input type="submit" class="send" value="Delete" name="delete">
						 </form>
					</div>
					
			
			</div>
		</div>
		
	</div>	
	<!-- //main --> 
</body>
</html>
<script>
   
    
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>