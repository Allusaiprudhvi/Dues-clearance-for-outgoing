<html>
<?php
$v=false;
include '../connection.php';
$_SESSION['status']="NotActive";


if(isset($_POST['sign_in']))
{

    $roll_no=$_POST['roll_no'];
    $pass=$_POST['password'];
    $password = sha1(sha1($_POST['password']).sha1("mySalt@$#(%"));

        $_SESSION['roll_no']=$roll_no;

    $s1="select * from student where roll_no='$roll_no'"; 
    $res1=$conn->query($s1);
    
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
          /* if($row['is_visited']==true)
           {
          
        header("Location:./home.php");
           $_SESSION['status']="Active";
           }
           
           else{
                   $_SESSION['status']="Active";
                  header("Location:form1.php");
                  
           }*/
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
<title>Student Login</title>
    <?php include 'head.php';?>
</head>

<body style="background-image: url('../images/background.jpg')">
	<!-- main -->
	 
			
	<div class="main-agile">
            <div style="width:15%;margin: 0 auto; margin-top:1%">   <img src="../images/nitc_logo.png" ></div> 

		<div class="content1">
			<div class="top-grids">
					<div class="signin-form-grid">
						<div class="signin-form">
							<h2>Student Log-in</h2>
							<form id="signin" action="" method="post">
							        <p style="float:left;color:red"><?php echo $message;?></p>
								<input type="text" name="roll_no" placeholder="User Name" required="">
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