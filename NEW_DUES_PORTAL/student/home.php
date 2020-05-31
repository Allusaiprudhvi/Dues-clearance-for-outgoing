<?php
include '../connection.php';


if($_SESSION['status']!="Active")
{
    header("location:index.php");
}
  
$roll_no = $_SESSION["roll_no"];


$sql="select * from department where dp_name='hostel' ";
$res = $conn->query($sql);
 if($res == false)
    die($conn->error );
$row = $res->fetch_array();
$hostel_dues_updated_on=$row['bill_updated'];



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
<title>Student home</title>
<?php include 'head.php';?>
</head>

<body>
    
    <header class="header">
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">No Dues Portal</h1>
    </header> 
  
    <nav>
      <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu</a> 
           
            <ul class="menu">
                <li><a class="homer" href="home.php"><i class="fa fa-home"></i> HOME</a>
                <li><a  href="change_password.php"><i class="fa fa-lock"></i> Change Password</a> 
                </li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
    </nav>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script  src="../dist/script.js"></script>
    
   <section id="upload_dues" > 
     
       
       <div class="main-agile"> 
		<div class="content">
			<div class="top-grids">
                        <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

			         <div class="signin-form subscribe">	
						<h3>Student Dues</h3>
                                                <p style="color: red">Hostel dues updated on : <?php echo $hostel_dues_updated_on ?></p>

                                             <table >
                                            <tr>
                                              <th>DEPARTMENT</th>
                                              <th>Dues</th>
                                            </tr>
                                            
                                            <?php
                                            $query="select * from department";
                                            $result=$conn->query($query);
                                            while($row=$result->fetch_array())
                                            {
                                             $name=$row['full_name'];
                                             $dp_id=$row['dp_name'];
                                             $sql="select * from stu_dpt_dues where dp_name='$dp_id' and roll_no= '$roll_no' ";
                                             $res = $conn->query($sql);
                                             $dp_due=0;
                                             $due_status=0;
                                             if($res->num_rows!=0)
                                             {
                                                 $row1=$res->fetch_array();
                                                 $dp_due=$row1['dues'];
                                                 $due_status=$row1['approve'];
                                             }
                                             if($dp_due!=0 && $due_status==0)
                                             echo "<tr>
                                              <td>".$name."</td>
                                              <td>". $dp_due ."</td>
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
    
   function openNav() {
  document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.width = "0%";
}
  
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
  
    </script>
    