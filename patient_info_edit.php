<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  if (isset($_GET['id'])) {
          $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $users = $stmts->fetch();
 $id = $_GET['id'];
  $sql = "select * from patients where id = ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$id]);
  $p = $stmt->fetch();


 

  }
 

  ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit info </title>
  
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
    /*font-family: cursive;*/
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
  /*font-family: cursive;*/
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
   width: 40%;
   height: 100%;
   margin-bottom: 3%;

}
#p_span_info2{
   display: inline-block;
   width: 40%;
   height: 100%;
   margin-left: 5%;
   margin-bottom: 3%;
}

#btn_p_info1{
  margin-left: 30%;
  margin-top: 1%;
  font-size: 1vw;
  border-radius: 10px;
  background-color:   #e6e6ff;
  padding: 2% 4%;
  border-color: #e6e6ff;
  width: 15.5vw;
}
#btn_p_info1:hover{
  background-color: white;
}
#btn_p_info{
  margin-left: 16%;
  margin-top: 0.1%;
  font-size: 0.9vw;
  border-radius: 10px;
  background-color:  #80bfff;
  padding: 4% 25%;
  border-color:#80bfff;
  width: 15.5vw;
  color: black;
}
#btn_p_info:hover{
  background-color: white;
}
p{
  font-size: 1.5vw;
}
#info_edit_form{
  width: 100%;
  height: 8%;
  padding: 12px 0px;
  font-size: 1vw;
  background-color: #ffffff;
  border-radius: 10px;
  border-bottom-style: solid;
  border-bottom-color:  #e6f2ff;
  border-top-style: hidden;
   border-right-style: hidden;
  border-left-style: hidden;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
  
input[type=number] {
  -moz-appearance: textfield;
}

</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
<img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $p['fname']; ?></h3>  
   <div class="myBox_add_patient" style="width: 70%; height: 80vh;margin-left: 15%;background-color: #e6f2ff;font-size: 20px;"> 
    <form action="patient_info_edit_in.php" method="post">
      <div>
        <input id="info_edit_form"  type="hidden" name="id" value="<?= !empty($p['id']) ? $p['id'] : '' ?>"  placeholder="Full name" required>
        <span id="p_span_info1" style="margin-left: 5%;">
            <input id="info_edit_form"  type="text" name="fname" value="<?= !empty($p['fname']) ? $p['fname'] : '' ?>"  placeholder="Full name" required>
        </span>
        <span id="p_span_info1" style="margin-left: 9.5%;">
            <input id="info_edit_form"  type="date" name="birth" value="<?= !empty($p['birthday']) ? $p['birthday'] : '' ?>" placeholder="birthday" required>
        </span>
      </div>
      <div>
        <span id="p_span_info1" style="margin-left: 5%;">
            <input id="info_edit_form"  type="text" name="username" value="<?= !empty($p['username']) ? $p['username'] : '' ?>"  placeholder="Username" required>
        </span>
        <span id="p_span_info1" style="margin-left: 9.5%;">
            <input id="info_edit_form"  type="email" name="email" value="<?= !empty($p['email']) ? $p['email'] : '' ?>"  placeholder="New Email" required>
        </span>
      </div>
      <div>
        
        <span id="p_span_info1" style="margin-left: 5%;">
            <input id="info_edit_form"  type="password" name="password"  placeholder="New Password" required>
        </span>
      </div>
      <div>
        
      </div>
      <div>
        <span id="p_span_info2">
            <input id="info_edit_form"  type="text" name="con" value="<?= !empty($p['cond']) ? $p['cond'] : '' ?>" placeholder="Condition" required>
            
        </span>
        <span id="p_span_info2" style="margin-left: 9.5%;">
            
            <input id="info_edit_form"  type="number" name="phone" value="<?= !empty($p['phone']) ? $p['phone'] : '' ?>" placeholder="Phone Number" required>
        </span>
      </div>
      <div>
        <span id="p_span_info2">
            <input id="info_edit_form"  type="text" name="r_name" value="<?= !empty($p['relative_name']) ? $p['relative_name'] : '' ?>" placeholder="Condition" required>
            
        </span>
        <span id="p_span_info2" style="margin-left: 9.5%;">
            
            <input id="info_edit_form"  type="number" name="r_num" value="<?= !empty($p['relative_phone']) ? $p['relative_phone'] : '' ?>" placeholder="Phone Number" required>
        </span>
      </div>
<div>
        <span id="p_span_info">
          <?php echo '<a id="btn_p_info" href="medications.php?id='.$p['id'].'">Medications</a> ';?>
        </span>
        <span id="p_span_info">
         <?php echo ' <a style="margin-left : 25%;" id="btn_p_info" href="manage_dite.php?id='.$p['id'].'">Diet</a>';?>
        </span> 
        <span id="p_span_info">
         <?php echo ' <a id="btn_p_info" href="physical_activity.php?id='.$p['id'].'">Physical Acvtivity</a>';?>
        </span> 
      </div>
      <br>
      <div>
        <span id="p_span_info" style="margin-left: 15%">
        <?php echo ' <a id="btn_p_info" href="p_appointment.php?id='.$p['id'].'">Appointment</a>';?>
        </span>
        <span id="p_span_info" >
         <?php echo ' <a id="btn_p_info" href="alarming.php?id='.$p['id'].'">Cirtical Symptom</a>';?>

        </span> 
        <span id="p_span_info">
          
        </span> 
      </div>
            <div>
        <span id="p_span_info">
         
        </span>
        <span id="p_span_info">
          
        </span> 
        <span id="p_span_info">
          <button type="submit" id="btn_p_info1">Save Changes</button>
        </span> 
      </div>
     </form>
     </div>


     <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'email_error') echo '<script>aleart("Sorry This email has been used")</script>';
                }
            ?>

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