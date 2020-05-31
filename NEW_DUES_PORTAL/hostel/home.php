<?php
include '../connection.php';

$user_name=$_SESSION['hostel'];
$message="";
$msg="";

if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

require_once('../spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require_once('../spreadsheet-reader-master/SpreadsheetReader.php');
if (isset( $_POST['import']))
{

   
    $_SESSION['dis']=1;
       $s4="select * from department where dp_name='$user_name' and full_name='Hostel Office'";
       $res4=$conn->query($s4);
       if($res4==false)
         die($conn->error);
       while($row=$res4->fetch_array())
       {
           $dues_uploaded=$row['uploaded'];
       }
               
       if($dues_uploaded==true)
       {
           echo "<script>alert('List was already uploaded ')</script>";
       }
 elseif(check_rollno($conn)) {
           echo $_FILES["file"]["type"];
  $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
   $result;
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = '../uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
              $roll_no = "";
                if(isset($Row[1])) {
                    $roll_no = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                $dues = 0;
                if(isset($Row[3])) {
                    $dues = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                
                
              if ((!empty($roll_no) || !empty($dues))&&($roll_no!="Roll. No."))
                    {
                        
                    $s1="select * from stu_dpt_dues where roll_no='$roll_no' and dp_name='$user_name'";
                    $res=$conn->query($s1);
                    
                      if($res==false)
                        die($conn->error);
                      
                    if($res->num_rows==0)
                    {
                        $val=0;
                        $query = "insert into stu_dpt_dues(roll_no,dp_name,dues,approve) values('$roll_no','$user_name','$dues','$val')";
                        $result = $conn->query($query);
                        
                      if($result==false)
                        die($conn->error);
                     
                     
                    
                    }
                    else
                    {
                        $val=0;
                         while($row=$res->fetch_array())
                             $pre_dues=$row['dues'];
                        
                        $dues=$dues+$pre_dues;  
                        $query = "update stu_dpt_dues set dues='$dues',approve='$val' where roll_no='$roll_no' and dp_name='$user_name'";
                        $result = $conn->query($query);
                     
                       if($result==false)
                        die($conn->error);
                    }
                    
                }
             }
        
         }
         if (! empty($result)){
                        date_default_timezone_set('Asia/Calcutta'); 
                        $date = date('Y-m-d H:i:s');
                        $v=true;
                        $query = "update department set due_updated='$date',uploaded='$v' where dp_name='$user_name'";
                        $result = $conn->query($query);
                        if($result==false)
                        die($conn->error);
                        $type = "success";
                        $message = "Students list Uploaded Successfully".$_FILES["file"]["type"];
                        } 
                        else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                        }
  }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
 }
}



function check_rollno($conn)
{
    
    $allowedFileType = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  
  if(in_array($_FILES["file"]["type"],$allowedFileType)){

        $targetPath = '../uploads/'.$_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);
        
        $Reader = new SpreadsheetReader($targetPath);
        
        $sheetCount = count($Reader->sheets());
        
        for($i=0;$i<$sheetCount;$i++)
        {
            $Reader->ChangeSheet($i);
            
            foreach ($Reader as $Row)
            {
          
              $roll_no = "";
                if(isset($Row[1])) {
                    $roll_no = mysqli_real_escape_string($conn,$Row[1]);
                }
                
                $dues = "";
                if(isset($Row[3])) {
                    $dues = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                $sql="select * from student where roll_no='$roll_no'";
                $result=$conn->query($sql);
                
                if($result->num_rows==0&&($roll_no!="Roll. No.")&&($roll_no!=""))
                {

                    $GLOBALS['msg']="Student with Roll No. ".$roll_no." does not exist,Please enter exact Roll No";

                    return  false;
                }
            }
        }    
                     return true;   

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
    <title>Upload Dues</title>
 <?php include 'head.php';?>
</head>

<body>
    
    <header class="header">
      <span><img src="../images/nitc_logo 2.png" style="width:8%"></span><h1 class="logo">HOSTEL OFFICE</h1>
    </header> 
  
    <nav>
      <a id="resp-menu" class="responsive-menu" href="#"  ><i class="fa fa-reorder"></i> Menu</a> 
           
            <ul class="menu">
                <li><a class="homer" href="home.php"><i class="fa fa-home"></i> HOME</a>
                <li><a  href="bank.php"><i class="fa fa-upload"></i> Upload Bank Bills</a></li>
                <li><a  href="approve.php"><i class="fa fa-edit"></i> Update Manually</a></li>
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
						<h3>Upload Dues List</h3>
                                                <p style="color:red">    <?php echo $msg;?></p>
			               <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                           <div class="file-upload">
                                           <div class="file-select">
                                           <div class="file-select-button" id="fileName">Choose File</div>
                                           <div class="file-select-name" id="noFile">No file chosen...</div> 
                                                <input type="file"  name="file" id="file" onchange="showname()" accept=".xls,.xlsx">
                                          </div>
                                           </div>
                                        <input type="submit" name="import" value="Upload">
                                      </form>
				 </div>
                         <a  href="hostel_form.xlsx" class="buttonDownload" download="DuesForm">Download Hostel Dues Form</a>
			</div>
		</div>
		
	</div>	
        
       
    </section>
   
    
   
        
       
    </section>
    
    
   
    
</body>
<script type="text/javascript">
    
  
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
    
    
    function showname () {
      var name = document.getElementById('file'); 
     
      document.getElementById('noFile').innerHTML=name.files.item(0).name;
    };

    </script>
    