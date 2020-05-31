<?php
include '../connection.php';

$user_name=$_SESSION['user_name'];
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
                
                $name = "";
                if(isset($Row[2])) {
                    $name = mysqli_real_escape_string($conn,$Row[2]);
                }
                
                if ((!empty($name) || !empty($roll_no))&&$roll_no!="Roll. No.") {
                     $pass = sha1(sha1(strtolower($roll_no)).sha1("mySalt@$#(%"));
                    $v=0;
                    $query = "insert into student(roll_no,name,password,is_visited) values('$roll_no','$name','$pass','$v')";
                    $result = $conn->query($query);
                 if($result==false)
                        die($conn->error);
                    if (! empty($result)) {
                        date_default_timezone_set('Asia/Calcutta'); 

                        $date = date('Y-m-d H:i:s');
                        $v=true;
                        $query = "update admins set due_updated='$date',uploaded='$v' where user_name='$user_name'";
                        $result = $conn->query($query);
                    
                       if($result==false)
                        die($conn->error);
                        $type = "success";
                        $message = "Students List Uploaded Successfully";
                    } else {
                        $type = "error";
                        $message = "Problem in Importing Excel Data";
                           }
                
                 }
        
            }
        }
   }
  else
  { 
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
  }
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
		<div class="content">
			<div class="top-grids">
                            
                         <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

			         <div class="signin-form subscribe">	
						<h3>Upload Student List</h3>
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
                         <a  href="student_form.xlsx" class="buttonDownload" download="DuesForm">Download Student Form</a>
			</div>
		</div>
		
	</div>	
        
       
    </section>
   
    
   
        
       
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
    