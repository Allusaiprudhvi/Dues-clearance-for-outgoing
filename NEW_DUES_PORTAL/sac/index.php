<?php
include '../connection.php';
$v=false;
$message="";
$_SESSION['status']="NotActive";
if(isset($_POST['sign_in']))
{   
    $user_name=$_POST['user_name'];
    $pass=$_POST['password'];
    $password = sha1(sha1($_POST['password']).sha1("mySalt@$#(%"));
    
        $_SESSION['user_name']=$user_name;
        

    $s1="select * from admins where user_name='$user_name'"; 
    $res1=$conn->query($s1);
    if($res1==false)
        die($conn->error);
    if($res1->num_rows==0)
    {
      $message= "USER DOES NOT EXIST";
                
    }
    else
    {
                   $row=$res1->fetch_array();

      if($row['password']==$password)
       {
       
           header("Location:./home.php");
           $_SESSION['status']="Active";
       
          
       }
           
       else
       {
           $message="Incorrect Password";
       }
           
    }
    
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<title>ACADEMIC Login</title>
    <?php include 'head.php';?>

</head>

<body style="background-image: url('../images/background.jpg')">
	<!-- main -->
	<div class="main-agile">
            <div style="text-align: center;margin-top: 5%">
             <span><img src="../images/nitc_logo 2.png" style="width:8%">     </span>     
            </div>

		<div class="content1">
			<div class="top-grids">
						
					<div class="signin-form-grid">
						<div class="signin-form">
							<h2>ACADEMIC Log-In</h2>
                                                         
							<form id="signin" action="" method="post">
								                            <p style="float:left;color:red"><?php echo $message;?></p>

								<input type="text" name="user_name" placeholder="User Name" required="">
								<input type="password" name="password" placeholder="Password" required="">	 
								<input type="checkbox" id="brand" value="">
								<input type="submit" name="sign_in" value="LOG IN">
								<div class="signin-agileits-bottom"> 
									<p><a href="#">Forgot Password ?</a></p>    
								</div> 
							</form>
						</div>
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