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
$name="";
$dues="";

$conn=new mysqli($servername,$username,$password,$database,$port);
if(!$conn)
{
die("connectioin not established".$conn->error);
}
   $user_name=$_SESSION['hostel'];


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
<title>Update Student Dues</title>
<head>
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
                <li><a  class="homer" href="approve.php"><i class="fa fa-edit"></i> Update Manually</a></li>
                <li><a  href="change_password.php"><i class="fa fa-lock"></i> Change Password</a> 
                </li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
    </nav>
    
	<!-- main -->
 
        <div class="main-agile">
		<div class="content">
			<div class="top-grids">
					
                                       
			                <div class="signin-form subscribe" id="check_dues">	
						<h3>Check Dues</h3>
						<form action="#" method="post">
                                                        <input type="text" name="roll_no" id="roll_no" placeholder="Enter Student Roll No" required>
							<input type="submit" name="check_dues" value="Check Dues" >
						</form>
					</div>
                            
                                    <?php
                                      if(isset($_POST['check_dues']))
                                        {
                                            
                                            $roll_no=$_POST['roll_no'];
                                            $_SESSION['roll_no']=$roll_no;
                                            $query="select name,dues,approve from student left join (select * from stu_dpt_dues where dp_name='$user_name') as t1 on student.roll_no=t1.roll_no where student.roll_no='$roll_no' ";
    
                                            $result=$conn->query($query);
    
                                           if($result==false)
                                            die("error in checking dues".$conn->error);
       
                                            $name="UNKNOWN";
                                             $dues="";
                                               $approve=2;
                                                $status="";
                                                $error="";
                                          while($row=$result->fetch_array())
                                             {
                                              $name=$row['name'];
                                              $dues=$row['dues'];
                                              $approve=$row['approve'];

                                             }
                                             if($name=="UNKNOWN")
                                                     $error="Roll No is Invalid";
       
                                             if($dues=="")
                                                 $dues=0;
                                              if($approve=="")
                                                 $status="Approved";
                                             if($approve==0 || $dues>0)
                                                 $status="Not Approved";
                                             if($approve==1 || $dues<=0) {
                                                 $status="Approved";
                                                  }
                                                    
                            	          
                                            echo '<div class="signin-form subscribe" id="update_dues" >	
                                             <p style="color:red">'.$error.'</p>';
                                           if($error!="Roll No is Invalid")
                                             echo ' <h3>Name: '.$name.'</h3>
                                             <h3>Dues: '.$dues.'Rs</h3>
                                             <h3>Status: '.$status.'</h3>

                                             
                                                 <form action="#" method="post" onsubmit="return confirmation()">
                                                         <input type="text" name="roll_no" value='.$roll_no.' style="display:none">
							<input type="submit" name="approve" value="Approve ">
				                 </form>
                                            </div>';
                                        }
                                        if(isset($_POST['approve']))
                                         {
                                            $roll_no=$_POST['roll_no'];
                                            $val=1;
                                            //echo $val;
                                            $query="update stu_dpt_dues set approve='$val' where roll_no='$roll_no' and dp_name='$user_name'";
                                            $result=$conn->query($query);
                                           
                                            if($result==false)
                                            die("error in approving".$conn->error);
                                           
                                              $query="select * from stu_dpt_dues where roll_no='$roll_no' and dp_name='$user_name'";
                                              $result=$conn->query($query);
                                           
                                              if($result==false)
                                              die("error in checking whether the updated due is zero".$conn->error);
                                           
                                              while($row=$result->fetch_array())
                                               $app=$row['approve'];
                                            
                                              if($app==1)
                                              echo "<script>alert('Student is succesfully approved')</script>";
                                          else {
                                               echo "<script>alert('Student is not approved')</script>";
                                          }
                                            
                                          }
                                         ?>

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
    
    function confirmation()
    {
        
        return confirm("Are you sure of Approving?");
        
    }
    </script>