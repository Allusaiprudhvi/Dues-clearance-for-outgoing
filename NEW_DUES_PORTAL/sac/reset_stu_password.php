<?php
include '../connection.php';
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

$val=true;
$message="";

if(isset($_POST['reset_password']))
{  
    $roll_no=$_POST['roll_no'];
    $s1="select * from student where roll_no='$roll_no'";   
    
    $res1=$conn->query($s1);
    if($res1->num_rows!=0){
            $new_password=sha1(sha1(strtolower($roll_no)).sha1("mySalt@$#(%"));
        $s2="update student set password='$new_password' where roll_no='$roll_no'";
                 $res3=$conn->query($s2);
                 if($res3==false)
                 die ("error in reseting password".$conn->error);
             
    if($res3==true)
    {   
        echo "<script>alert('Password Updated Successfully');</script>";
    }
    }
 else {
                $message="Roll No is Invalid";

 }
}


if (isset($_GET['logout'])) 
{
    unset($_SESSION['user_name']);
    $_SESSION['status']="NotActive";
        header("location:index.php");

    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Reset Student Password</title>
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
                <li><a  class="homer" href="#"><i class="fa fa-refresh"></i>Reset-Password</a>
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
                <li><a   href="delete.php"><i class="fa fa-trash-o"></i> Reset</a></li>
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
						<h3>Reset Password</h3>
			                         <form action="" method="post" >	
				                            <p style="float:red;color: red"><?php echo $message;?></h3>

									<input  type="text" placeholder="Enter Roll No" name="roll_no"  required="">
							                <input type="submit" class="send" value="Reset Password" name="reset_password">
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