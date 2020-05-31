<?php
include '../connection.php';
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

$val=true;
$message="";

  //  $user_name=$_SESSION['user_name'];
$user_name="sac";

if(isset($_POST['change_password']))
{

    
     $old_password=sha1(sha1($_POST['old_password']).sha1("mySalt@$#(%"));
   
    $new_password=sha1(sha1($_POST['new_password1']).sha1("mySalt@$#(%"));
    
    $s1="select * from admins where user_name='$user_name'";   
    
    $res1=$conn->query($s1);
      
    
    $row=$res1->fetch_array();
    
  
    $original_password=$row['password'];
    
    if($old_password!=$original_password)
    {
        $message="Your Old Password is Incorrect";
        
    }
    else
    {
             $s2="update admins set password='$new_password' where user_name='$user_name'";
                 
                 $res3=$conn->query($s2);

                 if($res3==false)
                 die ("error in changing password".$conn->error);
             

    if($res3==true)
    {
        
        $message='Password Updated Successfully';
                   
    }
    
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
<title>Change Password</title>
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
                <li><a  href="delete.php"><i class="fa fa-trash-o"></i> Reset</a></li>
                <li><a class="homer" id="prof" href="#"><i class="fa fa-user"></i>Account-Settings</a>                
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
			                         <form action="" method="post" onsubmit="return password_validate()">	
				                            <p style="float:red;color: red"><?php echo $message;?></h3>

									<input  type="password" placeholder="old password" name="old_password" data-type="password" required="">
									<input  type="password" placeholder="new password" id="pwd1"  name="new_password1" data-type="password" required="">
									<input  type="password"  id="pwd2" placeholder="retype new password"   name="new_password2" data-type="password" required="">

							                <input type="submit" class="send" value="Update Password" name="change_password">
						 </form>
					</div>
					
			
			</div>
		</div>
		
	</div>	
	<!-- //main --> 
</body>
</html>
<script>
    function password_validate()
    {
        if(document.getElementById('pwd1').value!=document.getElementById('pwd2').value)
        {
               alert("Passwords does not match");
            return false;
        }
        
        return true;
    }
    
     if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    </script>