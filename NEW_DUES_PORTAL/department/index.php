<?php
include '../connection.php';
$v=false;
$message="";
$_SESSION['status']="NotActive";
$_SESSION['dis']=1;

if (isset($_GET['forgot_password'])) 
{
   require '../PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->SMTPDebug = 4;                              // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'allusaiprudhvi111@gmail.com';                 // SMTP username
$mail->Password = 'Omshiridisai@99';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('allusaiprudhvi111@gmail.com', 'Allu Sai Prudhvi');
$mail->addAddress('allusai_b160865cs@nitc.ac.in');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('allusaiprudhvi111@gmail.com');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
}
if(isset($_POST['sign_in']))
{

    $user_name=$_POST['user_name'];
    $pass=$_POST['password'];
    $password = sha1(sha1($_POST['password']).sha1("mySalt@$#(%"));
        $_SESSION['dp_name']=$user_name;
    $s1="select * from department where dp_name='$user_name' and full_name!='Hostel Office'"; 
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
<title>Department Login</title>
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
							<h2>Department Log-In</h2>
                                                         
							<form id="signin" action="" method="post">
								                            <p style="float:left;color:red"><?php echo $message;?></p>

								<input type="text" name="user_name" placeholder="User Name" required="">
								<input type="password" name="password" placeholder="Password" required="">	 
								<input type="checkbox" id="brand" value="">
								<input type="submit" name="sign_in" value="LOG IN">
								<div class="signin-agileits-bottom"> 
									<p><a href="?forgot_password">Forgot Password ?</a></p>    
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