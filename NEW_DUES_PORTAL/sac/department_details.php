
<?php
include '../connection.php';

$user_name=$_SESSION['user_name'];
//$user_name="sac";

$message="";
$msg="";

if($_SESSION['status']!="Active")
{
    header("location:index.php");
}



if (isset($_GET['logout'])) 
{
  //  unset($_SESSION['user_name']);
    $_SESSION['status']="NotActive";
        header("location:index.php");

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload Student List</title>
    <?php include 'head.php';?>
</head>

<body>
    
    <header class="header">
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">ACADEMIC OFFICE</h1>
    </header> 
  
    <nav>
            <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu</a> 
            
            <ul class="menu">
                <li><a class="homer" href="home.php"><i class="fa fa-home"></i>Home</a></li>
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
                <li><a id="prof" href="#"><i class="fa fa-user"></i>Account-Settings</a>                
                <ul class="sub-menu">
                <li><a href="change_password.php"><i class="fa fa-lock"></i>Change Password</a></li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
                </li>
            </ul>
    </nav>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script  src="../dist/script.js"></script>
    
 

<section id="upload_dues" > 
     
       
       <div class="main-agile"> 
		<div class="content" >
			<div class="top-grids">
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

			         <div class="signin-form subscribe">	
						<h3>Department Status</h3>

                                             <table >
                                            <tr>
                                              <th>Department-Id</th>                                              
                                              <th>Department-Name</th>
                                              <th> Uploaded On</th>
                                            </tr>
                                            
                                            <?php
                                            $query="select * from department";
                                            $result=$conn->query($query);
                                            while($row=$result->fetch_array())
                                            {
                                            
                                             $name=$row['full_name'];
                                             $dp_id=$row['dp_name'];
                                             $dp_status=$row['uploaded'];
                                             $dues_uploaded_on=$row['due_updated'];
                                             if($dues_uploaded_on==NULL)
                                              $dues_uploaded_on="---------";

                                             echo "<tr>
                                             <td>". $dp_id ."</td>
                                             <td>".$name."</td>
                                              <td>". $dues_uploaded_on ."</td>
                                            </tr>";
                                            }
                                             ?>
                                            
                                            
                                             </table>

                                           
                                                        
                                           
				 </div>
			</div>
		</div>
		
	</div>	
        
       
    </section>    
    
   
    
</body>
<script type="text/javascript">
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
    
    function showname () {
      var name = document.getElementById('file'); 
     
      document.getElementById('noFile').innerHTML=name.files.item(0).name;
    };

    </script>
