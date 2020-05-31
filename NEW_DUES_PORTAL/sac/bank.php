<?php
include '../connection.php';

$user_name=$_SESSION['hostel'];
$message="";
$msg="";

if($_SESSION['status']!="Active")
{
    header("location:index.php");
}

    $sql="select * from department where dp_name='$user_name'";
       $res=$conn->query($sql);
       if($res==false)
         die($conn->error);
       $row=$res->fetch_array();
       $last_updated_date=$row['bill_updated'];

require_once('../spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
require_once('../spreadsheet-reader-master/SpreadsheetReader.php');
if (isset( $_POST['import']))
{

   
    $_SESSION['dis']=1;
     
     if(check_rollno($conn)){      
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
                
                $amount_paid;
                if(isset($Row[3])) {
                    $amount_paid = mysqli_real_escape_string($conn,$Row[3]);
                }
                
                
                
              if ((!empty($roll_no) || !empty($amount_paid))&&($roll_no!="Roll. No."))
                    {
                        
                   
                      
                   
                        $val=0;
                        $query="select * from stu_dpt_dues where roll_no='$roll_no' and dp_name='$user_name'";
                        $result = $conn->query($query);
                        
                      if($result==false)
                        die("".$conn->error);
                                          
                        while($row=$result->fetch_array())
                             $dues=$row['dues'];
                       
                        $dues=$dues-$amount_paid;
                        $query = "update stu_dpt_dues set dues='$dues' where roll_no='$roll_no' and dp_name='$user_name' ";
                        $result = $conn->query($query);
                     
                       if($result==false)
                        die($conn->error);
                    
                    
                }
             }
        
         }
         if (! empty($result)) {
                        date_default_timezone_set('Asia/Calcutta'); 

                        $date = date('Y-m-d H:i:s');

                        $query = "update department set bill_updated='$date' where dp_name='$user_name'";
                        $result = $conn->query($query);
                    
                       if($result==false)
                        die($conn->error);
                        $type = "success";
                        $message = "Bank Bill Uploaded Successfully";
                    } else {
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
                <li><a class="homer" href="bank.php"><i class="fa fa-upload"></i> Upload Bank Bills</a></li>
                <li><a  href="approve.php"><i class="fa fa-edit"></i> Update Manually</a></li>
                <li><a  href="change_password.php"><i class="fa fa-lock"></i> Change Password</a> 
                </li>
                <li><a  href="?logout"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
    </nav>
        
   <section id="upload_dues" > 
     
       
       <div class="main-agile">
		<div class="content">
			<div class="top-grids">
                            
                         <div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>

			         <div class="signin-form subscribe">	
						<h3>Upload Bank Bill</h3>
                                                <h4 style="color:white">Updated on : <?php echo $last_updated_date;?> </h4><br>
			               <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                                           <div class="file-upload">
                                           <div class="file-select">
                                           <div class="file-select-button" id="fileName">Choose File</div>
                                           <div class="file-select-name" id="noFile">No file chosen...</div> 
                                                <input type="file"  name="file" id="file" onchange="showname()" accept=".xls,.xlsx" required>
                                          </div>
                                           </div>
                                        <input type="submit" name="import" value="Upload">
                                      </form>
				 </div>
                         <a  href="bank_form.xlsx" class="buttonDownload" download="DuesForm">Download Paid Amount Form</a>

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
    