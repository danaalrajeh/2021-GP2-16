<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $flag = 0;
$g=0;
$g1="";
  $id = $_GET['id'];
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $user = $stmts->fetch();
  $sql = "select * from patients where id = ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$id]);
  $patient = $stmt->fetch();
  $password=$patient['password'];

  $queryk = "SELECT * FROM alarm WHERE p_id = ? ";
        $stmtk = $conn->prepare($queryk);
        $stmtk->execute([$id]);
        $sy = $stmtk->fetchAll();
        foreach ($sy as $kk) {
    if ($flag == 0) {
      $g =  $kk['phone'];
      $g1 =  $kk['relative_name'];
    }
    $flag = $flag + 1;
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Patients information </title>

<style >
  .h_font:hover{
  font-size: 2.5;
}
#p_img{
  margin-left: 2%;
  display: inline-block;
  width: 12%;
  height: 17%;
  margin-top: 1px;
  border-radius: 20px;
}
#im_div{
  display: inline;
}
#doc_name{
  display: inline-block;
  font-size: 2vw;
  font-weight: bold; 
}

.logout_b{
    text-decoration: none;
  padding: 12px 50px;
  position: relative;
margin-left: 2%;
  margin-top: 2%;
  font-size: 2vw;
  background-color: #191970;
  border-radius: 10px;
  border-color: #ffffff;
  color: white;
}

.logout_b:hover{
    font-size: 2.5vw;
    color:  #ffffff;

}

.home_b{
  text-decoration: none;
  font-size: 2vw;
  margin-left: 42%;
  color: #778899;
}

.home_b:hover{
  font-size: 2.5vw;
  color: white;
  background-color: #778899;
   padding: 8px 40px;
   border-radius: 10px;
}
a{
	text-decoration: none;
}
.myBox_add_patient {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;
border-radius: 20px;

}

#p_span{
   display: inline-block;
   width: 40%;
   height: 100%;
}
#p_span_info{
   display: inline-block;
   width: 30%;
   height: 100%;
}
#p_span_info1{
   display: inline-block;
   width: 60%;
   height: 100%;
}


#btn_p_info{
  margin-left: 15%;
  margin-top: 10%;
  font-size: 0.9vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 4% 25%;
  border-color:#e6e6ff;
  width: 15.5vw;
  color: black;
}
#btn_p_info:hover{
  background-color: white;
}
p{
  font-size: 1vw;
}

</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
          <img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $user['fname'];  ?></p>
          <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h2 style="margin-left: 15%;"><?php echo $patient['fname']; ?></h2>   
   <div class="myBox_add_patient" style="width: 70%; height: 68vh;margin-left: 15%;background-color: #e6f2ff;font-size: 20px;"> 
         <div>
        <span id="p_span_info">
          <p style="padding-left: 12%;"><strong>Full Name : </strong><?php echo $patient['fname']; ?></p>
        </span>
        <span id="p_span_info">
          <p style="padding-left: 50%;"><strong>Birthday : </strong><?php echo $patient['birthday']; ?></p>
        </span>
        <span id="p_span_info">
          <?php echo '<a  href="patient_info_edit.php?id='.$patient['id'].'"><img style="float: right; margin-right:-15%; margin-top:7%;" src="img\edit.png" width="35" height="35"></a>'; ?> 
        </span>
      </div>
      <div>
        <span id="p_span_info">
          <p style="padding-left: 12%;"><strong>Username : </strong><?php echo $patient['username']; ?></p>
        </span>
        <span id="p_span_info1">
          <p style="padding-left: 25%;"><strong>Password : </strong><?php echo$password; ?></p>
        </span>

        </div>
      <div>
        <span id="p_span">
          <p style="padding-left: 10%;"><strong>Condition : </strong><?php echo $patient['cond']; ?></p>
        </span>
        <span id="p_span">
          <p style="padding-left: 12%;"><strong>Phone Number : </strong><?php echo $patient['phone']; ?></p>
        </span>
      </div>
      <div>
        <span id="p_span">
          <p style="padding-left: 10%;"><strong>Relative Name : </strong><?php echo $g1; ?></p>
        </span>
        <span id="p_span">
          <p style="padding-left: 12%;"><strong>Relative Phone Number : </strong><?php echo $g; ?></p>
        </span>
      </div><br>
      <div>
        <span id="p_span_info">
          <?php echo '<a id="btn_p_info" href="medications.php?id='.$patient['id'].'">Medications</a> ';?>
        </span>
        <span id="p_span_info">
         <?php echo ' <a style="margin-left : 25%;" id="btn_p_info" href="manage_dite.php?id='.$patient['id'].'">Diet</a>';?>
        </span> 
        <span id="p_span_info">
         <?php echo ' <a id="btn_p_info" href="physical_activity.php?id='.$patient['id'].'">Physical  Acvtivity</a>';?>
        </span> 
      </div>
      <br>
      <div>
        <span id="p_span_info" style="margin-left: 15%">
        <?php echo ' <a id="btn_p_info" href="p_appointment.php?id='.$patient['id'].'">Appointment</a>';?>
        </span>
        <span id="p_span_info" >
         <?php echo ' <a id="btn_p_info" href="alarming.php?id='.$patient['id'].'">Cirtical symptoms</a>';?>

        </span> 
        <span id="p_span_info">
          
        </span> 
      </div>
     
     </div>
        <div style="color:red">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'edit') echo '<script>alert("Changes has been saved")</script>';

                  
                }
            ?>
        </div>



</body>
</html>
<?php
}
else
{
    echo "error";
    header('Location:index.php');
}
?>