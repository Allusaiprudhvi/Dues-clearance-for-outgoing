
<?php
include '../connection.php';

$message="";
$msg="";
  
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
    $roll_no = $_SESSION["roll_no"];

$sql="select * from student where roll_no='$roll_no'";
 $result=$conn->query($sql);
    if($result==false)
      die($conn->error);
    $row=$result->fetch_array();
    $name=$row['name'];
    
    
if(isset($_POST['details']))
{
    
    $name= test_input($_POST['name']);
    $pgm= test_input($_POST['pgm']);
    $branch=test_input($_POST['branch']);
    $pg_specification=test_input($_POST['pg_spec']);
    $phone_no1=test_input($_POST['phone1']);
    $phone_no2=test_input($_POST['phone2']);
    $email=test_input($_POST['email']);
    $ref_no=test_input($_POST['ref_no']);
    $curr_addr=test_input($_POST['caddr']);
    $curr_name=test_input($_POST['cname']);
    $curr_pincode=test_input($_POST['cpin']);
    $curr_tel=test_input($_POST['ctel']);
    $pre_addr=test_input($_POST['paddr']);
    $pre_name=test_input($_POST['pname']);
    $pre_tel=test_input($_POST['ptel']);
    $pre_pincode=test_input($_POST['ppin']);

    $is_same=$_POST['check'];
    $bank=test_input($_POST['bank']);
    $bank_branch=test_input($_POST['bank_branch']);
    $account_no= test_input($_POST['account_no']);
    
    $sql="update student set name='$name',email_id='$email',pgm='$pgm',pg_specification='$pg_specification',bank_name='$bank',bank_branch='$bank_branch',branch='$branch',account_no='$account_no',ref_no='$ref_no',is_visited=true where roll_no='$roll_no'";
    $result=$conn->query($sql);
    if($result==false)
      die("error while inserting into student table".$conn->error);
    
    $sql="insert into phone_number values('$roll_no','$phone_no1')";
    $result=$conn->query($sql);
    if($result==false)
      die("error while inserting into phone number table".$conn->error);
    
    if($phone_no1!=$phone_no2 && $phone_no2!="")
    {
        $sql="insert into phone_number values('$roll_no','$phone_no2')";
    $result=$conn->query($sql);
    if($result==false)
      die("error while inserting into address table".$conn->error);
    }
    
    $sql="insert into address values('$roll_no','$curr_name','$curr_addr','$curr_pincode','$curr_tel')";
     $result=$conn->query($sql);
    if($result==false)
      die("error while inserting into address table".$conn->error);
    
    if($curr_addr!=$pre_addr || $curr_name!=$pre_name || $curr_tel!=$pre_tel || $curr_pincode!=$pre_pincode)
    {

    $sql="insert into address values('$roll_no','$pre_name','$pre_addr','$pre_pincode','$pre_tel')";
     $result=$conn->query($sql);
    if($result==false)
      die("error while inserting into address table".$conn->error);
        
    }     
    
     $_SESSION['status']="Active";

                  header("Location:./home.php");
}
?>



<!DOCTYPE HTML>
<html>
<head>
<title>Application Form</title>
<link href="../main_css/style.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/style1.css" rel="stylesheet" type="text/css" media="all"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

		
<div class="header">
        <h3 style="color: black;font-weight: bold;">Application for Provisional Degree Certificate,Consolidated Grade Card and Course Completion Certificate</h3>
</div>
    <div class="main-content">
        <div class="contact-w3">

            <form action="" method="post">
                
                        <section id="a">
                              
                            <div class="row">
                             <label>Roll No.</label>
                             <input type="text" name="roll_no" value="<?php echo $roll_no; ?>" required>
                             </div>
                             
                             <div class="row">
                             <label>Name</label>
                             <input type="text" name="name" value="<?php echo $name; ?>" required>
                            </div>
                             <label>Programme</label>
                             <input type="text" name="pgm"  list="pgm" required>
                             <datalist  id="pgm" style="width: 50px">
                             <option value="UG"></option>    
                             <option value="PG"></option>
                             <option value="MCA"></option>
                             <option value="M.Sc.(Tech)"></option>
                             <option value="Ph.D"></option>
                             </datalist>
                            <div class="row">
                             <label>PG Specification</label>
                             <input type="text" name="pg_spec"  required>
                            </div>

                            <div class="row">
                             <label>Branch</label>
                             <input type="text" list="branches" name = "branch" >
                             <datalist  id="branches" style="width: 50px;">
                             <option value = "Computer Science and Engineering">Computer Science and Engineering</option>
                             <option value = "Electronics and Engineering">Electronics and Engineering</option>
                             <option value = "Electrical and Electronics Engineering">Electrical and Electronics Engineering</option>
                             <option value = "Mechanical Engineering">Mechanical Engineering</option>
                             <option value = "Civil Engineering">Civil Engineering</option>
                             <option value = "Chemical Engineering">Chemical Engineering</option>
                             <option value = "Bio Technology">Bio Technology</option>
                             <option value = "Architecture">Architecture</option>
                             </datalist>                      
                            </div>

                            <div class="row">
                             <label>Email</label>
                             <input type="text" name="email"  required>
                            </div>
                      
                            <div class="row">
                                <label>Reference no. (Reference no. in receipt paid for certificates (Rs.300) )</label>
                             <input type="text" name="ref_no"  required>
                            </div>
                             
                            <div class="row"> 
                             <label>Tel: LL</label>
                             <input type="text" name="phone1" required>
                            </div>
                             
                            
                            <div class="row">
                             <label>Mobile </label>
                             <input type="text" name="phone2" required>
                            </div>
                             <br>
                        </section>
                    
                     <section id="b">
                             <u><label>Address to which Certificates to be sent :</label><br></u> 
                            <div class="row1" style="border:2px solid lightblue;padding:5%"> 
                            
                               <label >Current Address:</label>
                            
                            <div class="row">
                             <label>Name</label> 
                             <input type="text" name="cname" id="cname"  required>
                            </div>
                             
                            <div class="row">
                             <label>Address</label>
                             <textarea name="caddr" rows="10" cols="30" id="caddr"></textarea>           
                            </div>
                             
                            <div class="row">
                             <label>Tel:</label>
                             <input type="text" name="ctel"  id="ctel" required>
                            </div>
                             
                            <div class="row">
                             <label>Pincode</label>
                             <input type="text" name="cpin"  id="cpin" required>
                            </div>
                   
                            </div>
                            
                             
                             <div class="row">
                                <label style="font-size:5px"> <input type="checkbox" name="check" id="brand" onclick="copy_address()">Click Here if your Permanent Address is same as Current Address</label>
                             </div> 
                             
                            <div class="row1" style="border:2px solid lightblue;padding:5%"> 
                            
                             <label >Permanent Address:</label>
                            
                            <div class="row">
                             <label>Name</label> 
                             <input type="text" name="pname" id="pname" required>
                            </div>
                             
                            <div class="row">
                             <label>Address</label>
                             <textarea name="paddr" rows="10" cols="30" id="paddr"></textarea>           
                            </div>
                             
                            <div class="row">
                             <label>Tel:</label>
                             <input type="text" name="ptel" id="ptel"  required>
                            </div>
                             
                            <div class="row">
                             <label>Pincode</label>
                             <input type="text" name="ppin" id="ppin" required>
                            </div>                          
                             
                            </div>
                             
                     </section>
                  <section id="c">
                            <div class="header">
                            <h3 style="color: black;font-weight: bold;">BANK ACCCOUNT DETAILS</h3><p>Savings Bank Account to which any sum which may be due to be credited</p>
                            </div>
                     
                             <div class="row1" style="border:2px solid lightblue;padding:5%"> 
                                   
                            <div class="row">
                             <label>Name of the Bank</label>
                             <input type="text" name="bank"  required>
                            </div>
                           
                            <div class="row">
                             <label>Branch </label>
                             <input type="text" name="bank_branch" required>
                            </div>
                                 
                             <div class="row">
                             <label>Account No. </label>
                             <input type="text" name="account_no" required>
                            </div>
                                 
                             </div>
                            
                            <div class="row">
                                <label style="font-size:5px"> <input type="checkbox" required>I hereby declare that I have received all Semester wise Grade Cards upto the final semester. I declare that I have no objection in adjusting my Caution Deposit towards the Convocation fee to be paid by me.  </label>
                            </div> 
                      
                      <div class="row">
                             <input type="submit" name="details" value="submit" >
                       </div>
                      </section>
                
                           
            </form>
        </div>
    </div>
		
</body>
</html>

<script >
    
    
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
    
 
 function copy_address()
 {
         var checkBox = document.getElementById("brand");

  if (checkBox.checked == true){

  document.getElementById("pname").value=document.getElementById("cname").value;
    document.getElementById("paddr").value=document.getElementById("caddr").value;
  document.getElementById("ptel").value=document.getElementById("ctel").value;
  document.getElementById("ppin").value=document.getElementById("cpin").value;

  }
 }
 </script>