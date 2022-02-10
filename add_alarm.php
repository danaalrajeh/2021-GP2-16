<?php
session_start();
include ("connection.php");
if (isset($_SESSION['id']))
{ 
  $id = $_SESSION['id'];
  $p_id = $_GET['id'];
  $ids = $_SESSION['id'];
  $sqls = "select * from users where id = ?";
  $stmts = $conn->prepare($sqls);
  $stmts->execute([$ids]);
  $users = $stmts->fetch();
  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$p_id]);
  $patient = $stmt1->fetch();
  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Alarm</title>
  <link rel="stylesheet" href="btn.css">
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
.myBox {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 200px;
height: 200px;

border-radius: 20px;
}
.myBox_medic {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 90%;
height: 100vh ;

}
.alram {
border: none;
padding: 5px;
font: 24px/36px sans-serif;
width: 100%;
height: 200px;
border-radius: 10px;
}
#add_alarm{
  width: 100%;
  height: 10%;
  padding: 12px 0px;
  font-size: 1vw;
  border-bottom-style: solid;
  border-bottom-color:  #cccccc;
  border-top-style: hidden;
   border-right-style: hidden;
  border-left-style: hidden;
  background-color: #ffffff;
}
#btn_add_alarm{
  margin-left: 35%;
  margin-top: 2%;
  font-size: 1.5vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 2%;
  border-color:#e6e6ff;
  width: 15.5vw;
}
#btn_add_alarm:hover{
 font-size: 2vw;
}
#med_textarea{
  resize: none;
  margin-left: 2%;
  margin-right: 5%;
  background-color:#ffffff;
  font-size: 1.3vw;
  padding: 1%;
  border-style: double;
  text-align: justify;
  border-radius: 20px;
}
#med_form{
  width: 50%;
  
  font-size: 1vw;
  padding: 1%;
  margin-left: 2%;
  border-bottom-style: solid;
  border-bottom-color:  black;
  border-top-style: hidden;
   border-right-style: hidden;
  border-left-style: hidden;
  background-color: #e6f2ff;
  border-radius: 10px;
}
 .required:after {
     content:" *";
     color: red;
 }
 .required{
     margin-left: 20%;
 }
</style>


</head>
<body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
<img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>   
   <div class="myBox" style="width: 70%; height: 65vh; margin-left: 15%;background-color:  #e6f2ff;font-size: 20px;">
    <?php  
    $query = "SELECT * FROM alarm WHERE p_id = ? ";
        $stmt = $conn->prepare($query);
        $stmt->execute([$p_id]);
        $user = $stmt->fetch();

        $query1 = "SELECT * FROM alarm WHERE p_id = ? AND symptom = ? ";
        $stmt1 = $conn->prepare($query1);
        $stmt1->execute([$p_id,"--"]);
        $user1 = $stmt1->fetch();

        $count = $stmt->rowCount();
        $count1 = $stmt1->rowCount();
        if ($count == 0 || $count1 > 0) {?>
        
        
         <form action="add_alarm_in.php" method="post">
        <input type="hidden" name="p_id" value="<?= !empty($p_id) ? $p_id : '' ?>">
        <h3 align="center">Add Symptom</h3>
        <label style="color:#191970;margin-left:2%" class="required">Symptom: </label> <textarea id="med_textarea" name="symptom" rows="3" cols="80" placeholder="Add Symptom . . ." required></textarea>
        <button type="submit" id="btn_add_alarm">Add symptom</button>
        </form>
        <?php
        }
        else{
          ?>
          <form action="add_alarm_in.php" method="post">
        <input type="hidden" name="p_id" value="<?= !empty($p_id) ? $p_id : '' ?>">
        <h3 align="center">Add Symptom</h3>
        <label style="color:#191970;margin-left:2%" class="required">Symptom: </label> <textarea id="med_textarea" name="symptom" rows="3" cols="80" placeholder="Add Symptom . . ." required></textarea>
        <button type="submit" id="btn_add_alarm">Add symptom</button>
        </form>
        <?php } ?>



   
      
  
</div>

<script src="check_required.js"></script>
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