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
  $sql = "select * from appointment where p_id= ?";
  $stmt = $conn ->prepare($sql);
  $stmt->execute([$p_id]);
  $ap = $stmt->fetchAll();

  $sql1 = "select * from patients where id = ?";
  $stmt1 = $conn ->prepare($sql1);
  $stmt1->execute([$p_id]);
  $patient = $stmt1->fetch();




  ?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit appointment</title>
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
overflow-y: scroll;
}

/* Scrollbar styles */
::-webkit-scrollbar {
width: 12px;
height: 12px;

}

::-webkit-scrollbar-track {
border: 1px solid yellowgreen;
border-radius: 10px;
border :0;
}

::-webkit-scrollbar-thumb {
background: #cccccc;  
border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
background: #cccccc;  
}

#p_span_info{
   display: inline-block;
   width: 30%;
   height: 100%;

}
#btn_p_info{
  margin-left: 30%;
  margin-top: 40%;
  font-size: 1.5vw;
  border-radius: 10px;
  background-color:  #e6e6ff;
  padding: 4%;
  border-color:#e6e6ff;
  width: 15.5vw;
}
.app_manage{
   display: inline-block;
   width: 40%;
   margin-left: 5%;
   font-size: 1vw;
   height: 5%
}
.app_manage_time{
   display: inline-block;
   width: 20%;
   margin-left: 5%;
   font-size: 1vw;
   height: 5%
}
#rem_btn{
  padding: 12px 50px;
  font-size: 1vw;
  background-color:  #e6ffe6;
  border-radius: 10px;
  border-color :#e6ffe6;
  height: 40px;
  margin-top: 2%;
}
#btn_add_app{
  margin-left: 37%;
  margin-top: 18%;
  padding: 10px 40px;
  font-size: 1vw;
  border-radius: 10px;
  background-color:  #e6e6ff;

  border-color:#e6e6ff;
  width: 15.5vw;
  color: black;
  text-align: center;
}
#btn_add_app:hover{
  background-color: white;
}
</style>


</head>




  <body style="background-color: #ffffff;margin-top: 0;margin-bottom: 0;">
<img id="p_img" src="img\logo_f.png"  ALIGN="center"> <p id="doc_name">&nbsp;&nbsp;Dr. <?php echo $users['fname'];  ?></p>
  <a class="home_b" href="physician_home.php">Home</a><a class="logout_b"  href="logout.php">Logout</a>
   <h3 style="margin-left: 15%;font-size: 1.5vw;"><?php echo $patient['fname']; ?></h3>  
   
   <div class="myBox"  style="width: 70%; height: 65vh; margin-left: 15%;background-color: #e6f2ff;font-size: 20px;">
      <div class="myBox_medic" style="background-color: #ffffff;margin: 3%;height: 45vh;border-radius: 10px;">
 <?php 
$i=1;
 foreach ($ap as $a) {

  echo '<div class="app_manage">
          <p>Appointemnt : '.$i.'</p>
        </div>
        <div class="app_manage" align="right" >
          <a id="rem_btn" href="#" style="color : black;" class="remind">Reminder</a>
          <a href="edit_appointment.php?a_id='.$a['id'].'&p_id='.$a['p_id'].'" style="margin-left: 5%;"><img src="img\edit.png" width="30" height="30"></a>
          <a href="delete_appointment.php?a_id='.$a['id'].'&p_id='.$a['p_id'].'" style="margin-left: 5%;" class="confirmation"><img src="img\delete.png" width="30" height="30"></a>
        </div>
        <div class="app_manage_time">
          <p>'.$a['a_date'].'</p>
        </div>
        <div class="app_manage_time">
          <p>'.$a['a_time'].'</p>
        </div>
        <hr>';
        $i++;
          } 

         // echo '<a id="btn_add_app"  href="add_appointment.php?p_id='.$p_id.'">schedule new Appoitement</a>';
        ?>


        
   </div><?php echo '<a id="btn_add_app"  href="add_appointment.php?p_id='.$p_id.'">schedule new Appoitement</a>'; ?></div>
         <div style="color:red">
            <?php
                if(isset($_GET['msg']) && !empty($_GET['msg'])){
                  if ($_GET['msg'] == 'edit') echo '<script>alert("Appointment edited successfully")</script>';
                  elseif ($_GET['msg'] == 'delete') echo '<script>alert("Appointment deleted successfully")</script>';
                  elseif ($_GET['msg'] == 'successful') echo '<script>alert("Appointment added successfully")</script>';
                  
                }
            ?>
        </div>
<script type="text/javascript">
    var elems = document.getElementsByClassName('confirmation');
    var elems1 = document.getElementsByClassName('remind');
    var confirmIt = function (e) {
        if (!confirm('Are you sure?')) e.preventDefault();
    };
        var reminder = function (e) {
        if (!confirm('Send Reminder ?')) e.preventDefault();
    };
    for (var i = 0, l = elems.length; i < l; i++) {
        elems[i].addEventListener('click', confirmIt, false);
    }
        for (var i = 0, l = elems1.length; i < l; i++) {
        elems1[i].addEventListener('click', reminder, false);
    }
</script>  

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