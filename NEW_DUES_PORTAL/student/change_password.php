<?php
session_start();
if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

$servername="localhost";
$username="root";
$password="omshiridisai";
$database="dues_portal";
$port=3300;
$val=true;
$message="";

    $roll_no=$_SESSION['roll_no'];

$conn=new mysqli($servername,$username,$password,$database,$port);
if(!$conn)
{
die("connectioin not established".$conn->error);
}

if(isset($_POST['change_password']))
{
     $old_password=sha1(sha1($_POST['old_password']).sha1("mySalt@$#(%"));
   
    $new_password=sha1(sha1($_POST['new_password1']).sha1("mySalt@$#(%"));
    
    $s1="select * from student where roll_no='$roll_no'";   
    
    $res1=$conn->query($s1);
    
    $row=$res1->fetch_array();
  
    $original_password=$row['password'];
    
    if($old_password!=$original_password)
    {
        $message="Your Old Password is Incorrect";
        
    }
    else
    {
             $s2="update student set password='$new_password' where roll_no='$roll_no'";
             
             
             $s3="update student set changed_pass='$val' where roll_no='$roll_no'";

    
    $res3=$conn->query($s2);
        
    $conn->query($s3);

    if($res3==true)
    {
        
        echo "<script>alert('Password Updated Successfully');</script>";
       //header("Location:./home.php");
    }
    
    } 
    
}



if (isset($_GET['logout'])) 
{
    unset($_SESSION['roll_no']);
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
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">NO DUES PORTAL</h1>
    </header> 
    
    <nav>
      <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu </a> 
            <ul class="menu">
                <li><a  href="home.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a class="homer" href="change_password.php"><i class="fa fa-lock"></i> Change Password</a></li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
    </nav>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script  src="../dist/script.js"></script>
    
	<div class="main-agile">
		<div class="content">
			<div class="top-grids">
						
					<div class="signin-form reset-password">
						<h3>Reset Password</h3>
                                              <h6 style="color:red">    <?php echo $message;?></h6>
			                         <form action="" method="post" onsubmit="return password_validate()">	

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
     function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
  if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
  

if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    function password_validate()
    {
        if(document.getElementById('pwd1').value!=document.getElementById('pwd2').value)
        {
               alert("Passwords does not match");
            return false;
        }
        
        return true;
    }
    </script>