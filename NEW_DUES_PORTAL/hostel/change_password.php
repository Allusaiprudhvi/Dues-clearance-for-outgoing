<?php
include '../connection.php';
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

$val=true;
$message="";

   $user_name=$_SESSION['hostel'];

if(isset($_POST['change_password']))
{
     $old_password=sha1(sha1($_POST['old_password']).sha1("mySalt@$#(%"));
   
    $new_password=sha1(sha1($_POST['new_password1']).sha1("mySalt@$#(%"));
    
    $s1="select * from department where dp_name='$user_name'";   
    
    $res1=$conn->query($s1);
    
    $row=$res1->fetch_array();
    $original_password=$row['password'];
    
    if($old_password!=$original_password)
    {
        $message="Your Old Password is Incorrect";
        
    }
    else
    {
             $s2="update department set password='$new_password' where dp_name='$user_name'";
             
             

    
    $res3=$conn->query($s2);

    if($res3==true)
    {
        
        $message='Password Updated Successfully';
        
    }
    
    } 
    
}


if (isset($_GET['logout'])) 
{
   unset($_SESSION['hostel']);
    $_SESSION['status']="NotActive";
        header("location:index.php");

    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>change password</title>
<?php include 'head.php';?>
</head>

<body>
    
    
    <header class="header">
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">HOSTEL OFFICE</h1>
    </header> 
  
    <nav>
      <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu</a> 
           
            <ul class="menu">
                <li><a  href="home.php"><i class="fa fa-home"></i> HOME</a>
                <li><a  href="bank.php"><i class="fa fa-upload"></i> Upload Bank Bills</a></li>
                <li><a  href="approve.php"><i class="fa fa-edit"></i> Update Manually</a></li>
                <li><a  class="homer" href="change_password.php"><i class="fa fa-lock"></i> Change Password</a> 
                </li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
    </nav>
    
	<!-- main -->
 
	<!-- main -->
	 
	<div class="main-agile">
		<div class="content">
			<div class="top-grids">
						
					<div class="signin-form reset-password">
						<h3>Reset Password</h3>
			                         <form action="" method="post" onsubmit="return password_validate()">	
				                            <p style="float:left;color:red"><?php echo $message;?></p>

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